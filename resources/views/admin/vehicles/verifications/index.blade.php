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

                    <!-- Search and Filter Section -->
                    <div class="mb-3 card">
                        <div class="card-body">
                            <div class="no-gutters row">
                                <div class="col-md-6">
                                    <form action="{{ route('admin.vehicle-verifications.index') }}" method="GET">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" 
                                                   placeholder="Search by make, model, VIN or driver..." 
                                                   value="{{ request('search') }}">
                                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.vehicle-verifications.index') }}" 
                                               class="btn btn-sm btn-outline-secondary {{ !request('status') ? 'active' : '' }}">
                                                All
                                            </a>
                                            <a href="{{ route('admin.vehicle-verifications.index', ['status' => 'pending']) }}" 
                                               class="btn btn-sm btn-outline-warning {{ request('status') === 'pending' ? 'active' : '' }}">
                                                Pending
                                            </a>
                                            <a href="{{ route('admin.vehicle-verifications.index', ['status' => 'approved']) }}" 
                                               class="btn btn-sm btn-outline-success {{ request('status') === 'approved' ? 'active' : '' }}">
                                                Approved
                                            </a>
                                            <a href="{{ route('admin.vehicle-verifications.index', ['status' => 'rejected']) }}" 
                                               class="btn btn-sm btn-outline-danger {{ request('status') === 'rejected' ? 'active' : '' }}">
                                                Rejected
                                            </a>
                                        </div>
                                    </div>
                                </div>
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
                                                <span class="badge text-bg-{{ $vehicle->vehicle_photo ? 'success' : 'danger' }}" 
                                                      data-bs-toggle="tooltip" title="Vehicle Photo">
                                                    <i class="fas fa-camera"></i>
                                                </span>
                                                <span class="badge text-bg-{{ $vehicle->insurance_document ? 'success' : 'danger' }}" 
                                                      data-bs-toggle="tooltip" title="Insurance Document">
                                                    <i class="fas fa-file-contract"></i>
                                                </span>
                                                <span class="badge text-bg-{{ $vehicle->registration_document ? 'success' : 'danger' }}" 
                                                      data-bs-toggle="tooltip" title="Registration Document">
                                                    <i class="fas fa-file-alt"></i>
                                                </span>
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

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    @endpush
@endsection