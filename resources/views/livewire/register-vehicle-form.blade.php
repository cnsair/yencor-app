<div>

    <x-validation-errors class="mb-4" />

    @if (session('status') === 'success')
        <x-success-msg>
            {{ __('Vehicle registered successfully!.') }}
        </x-success-msg>
    @elseif (session('status') === 'failed')
        <x-failed-msg>
            {{ __('Something went wrong! Please try again.') }}
        </x-failed-msg>
    @endif

   <form wire:submit.prevent="submit">

        <div class="row">

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="make">Make</label>
                    <input type="text" wire:model="make" autofocus>
                    <x-input-error for="make" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" wire:model="model">
                    <x-input-error for="model" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="year_of_manufacture">Year of Manufacture</label>
                    <input type="number" wire:model="year_of_manufacture">
                    <x-input-error for="year_of_manufacture" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="license_plate">License Plate</label>
                    <input type="text" wire:model="license_plate">
                    <x-input-error for="license_plate" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="vin">VIN</label>
                    <input type="text" wire:model="vin">
                    <x-input-error for="vin" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" wire:model="color">
                    <x-input-error for="color" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="vehicle_type">Vehicle Type</label>
                    <input type="text" wire:model="vehicle_type">
                    <x-input-error for="vehicle_type" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="insurance_provider">Insurance Provider</label>
                    <input type="text" wire:model="insurance_provider">
                    <x-input-error for="insurance_provider" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="insurance_policy_number">Insurance Policy Number</label>
                    <input type="text" wire:model="insurance_policy_number">
                    <x-input-error for="insurance_policy_number" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="insurance_expiration">Insurance Expiration</label>
                    <input type="date" wire:model="insurance_expiration">
                    <x-input-error for="insurance_expiration" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="driver_license_number">Driver License Number</label>
                    <input type="text" wire:model="driver_license_number">
                    <x-input-error for="driver_license_number" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="license_expiration">License Expiration</label>
                    <input type="date" wire:model="license_expiration">
                    <x-input-error for="license_expiration" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="seating_capacity">Seating Capacity</label>
                    <input type="number" wire:model="seating_capacity">
                    <x-input-error for="seating_capacity" class="mt-2" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="mileage">Mileage</label>
                    <input type="number" wire:model="mileage">
                    <x-input-error for="mileage" class="mt-2" />
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="vehicle_photo">Vehicle Photo</label>
                    <input type="file" wire:model="vehicle_photo">
                    <x-input-error for="vehicle_photo" class="mt-2" />
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="insurance_document">Insurance Document</label>
                    <input type="file" wire:model="insurance_document">
                    <x-input-error for="insurance_document" class="mt-2" />
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="registration_document">Registration Document</label>
                    <input type="file" wire:model="registration_document">
                    <x-input-error for="registration_document" class="mt-2" />
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="align">
                    <button type="submit" class="button button-dark">
                        {{ __('Register Vehicle') }}
                    </button>
                </div>
            </div>

            @if (session()->has('message'))
                <div>{{ session('message') }}</div>
            @endif
        </div>
   </form>
</div>
