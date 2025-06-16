<div>
    <h2 class="text-xl font-bold mb-4">Pending Vehicle Submissions</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b">Driver</th>
                    <th class="py-2 px-4 border-b">Make</th>
                    <th class="py-2 px-4 border-b">Model</th>
                    <th class="py-2 px-4 border-b">License Plate</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehicles as $vehicle)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $vehicle->user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $vehicle->make }}</td>
                        <td class="py-2 px-4 border-b">{{ $vehicle->model }}</td>
                        <td class="py-2 px-4 border-b">{{ $vehicle->license_plate }}</td>
                        <td class="py-2 px-4 border-b">
                            <button wire:click="review({{ $vehicle->id }})" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded">
                                Review
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-4 border-b text-center">No pending vehicles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Review Modal --}}
    @if ($reviewing && $selectedVehicle)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">
                        Reviewing Vehicle: {{ $selectedVehicle->make }} {{ $selectedVehicle->model }}
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <h4 class="font-semibold">Vehicle Details</h4>
                            <p>License Plate: {{ $selectedVehicle->license_plate }}</p>
                            <p>VIN: {{ $selectedVehicle->vin }}</p>
                            <p>Color: {{ $selectedVehicle->color }}</p>
                            <p>Year: {{ $selectedVehicle->year_of_manufacture }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold">Insurance Details</h4>
                            <p>Provider: {{ $selectedVehicle->insurance_provider }}</p>
                            <p>Policy #: {{ $selectedVehicle->insurance_policy_number }}</p>
                            <p>Expires: {{ $selectedVehicle->insurance_expiration->format('m/d/Y') }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold">Documents</h4>
                        <div class="flex space-x-2">
                            @if($selectedVehicle->vehicle_photo)
                                <a href="{{ route('admin.vehicle-verifications.view-document', [
                                    'vehicle' => $selectedVehicle, 
                                    'document' => 'vehicle_photo'
                                ]) }}" target="_blank" class="text-blue-500 hover:underline">
                                    Vehicle Photo
                                </a>
                            @endif
                            @if($selectedVehicle->insurance_document)
                                <a href="{{ route('admin.vehicle-verifications.view-document', [
                                    'vehicle' => $selectedVehicle, 
                                    'document' => 'insurance_document'
                                ]) }}" target="_blank" class="text-blue-500 hover:underline">
                                    Insurance
                                </a>
                            @endif
                            @if($selectedVehicle->registration_document)
                                <a href="{{ route('admin.vehicle-verifications.view-document', [
                                    'vehicle' => $selectedVehicle, 
                                    'document' => 'registration_document'
                                ]) }}" target="_blank" class="text-blue-500 hover:underline">
                                    Registration
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="rejectionReason" class="block font-medium text-gray-700">Rejection Reason (if applicable)</label>
                        <textarea wire:model="rejectionReason" id="rejectionReason" rows="3" 
                                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
                        @error('rejectionReason') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button wire:click="approve" 
                                class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
                            Approve
                        </button>
                        <button wire:click="reject" 
                                class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">
                            Reject
                        </button>
                        <button wire:click="resetReview" 
                                class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>