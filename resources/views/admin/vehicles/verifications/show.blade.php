@extends('layouts.app-admin')

@section('content')
    <div class="app-inner-layout__wrapper">
        <div class="app-inner-layout__content">
            <div class="tab-content">
                <div class="container-fluid">
                    <!-- Header Section -->
                    <div class="mb-3 card">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                <i class="header-icon pe-7s-car icon-gradient bg-happy-green"></i>
                                Vehicle Verifications
                            </div>
                            <div class="btn-actions-pane-right text-capitalize">
                                <a href="{{ route('admin.vehicle-verifications.index', ['pending' => true]) }}" 
                                   class="btn-wide btn-outline-2x mr-md-2 btn btn-outline-focus btn-sm">
                                    Pending Verifications
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="mb-3 card">
                        <div class="card-body">
                            <table style="width: 100%;" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Driver</th>
                                        <th>Vehicle</th>
                                        <th>Type</th>
                                        <th>Documents</th>
                                        <th>Submitted</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $vehicle->user->name }}</td>
                                            <td>
                                                {{ $vehicle->make }} {{ $vehicle->model }} ({{ $vehicle->year_of_manufacture }})
                                                <br><small class="text-muted">VIN: {{ $vehicle->vin }}</small>
                                            </td>
                                            <td>{{ ucfirst($vehicle->vehicle_type) }}</td>
                                            <td>
                                                @if($vehicle->vehicle_photo)
                                                    <span class="badge bg-success me-1" title="Photo uploaded">P</span>
                                                @else
                                                    <span class="badge bg-danger me-1" title="Photo missing">P</span>
                                                @endif
                                                @if($vehicle->insurance_document)
                                                    <span class="badge bg-success me-1" title="Insurance doc uploaded">I</span>
                                                @else
                                                    <span class="badge bg-danger me-1" title="Insurance doc missing">I</span>
                                                @endif
                                                @if($vehicle->registration_document)
                                                    <span class="badge bg-success me-1" title="Registration doc uploaded">R</span>
                                                @else
                                                    <span class="badge bg-danger me-1" title="Registration doc missing">R</span>
                                                @endif
                                            </td>
                                            <td>{{ $vehicle->created_at->format('M d, Y') }}</td>
                                            <td>
                                                @if($vehicle->verification_status === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($vehicle->verification_status === 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.vehicle-verifications.show', $vehicle) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    Review
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No vehicles found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="text-center d-block p-3 card-footer">
                                {{ $vehicles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection