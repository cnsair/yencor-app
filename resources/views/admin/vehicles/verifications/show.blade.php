@extends('layouts.app-admin')
@section('title', 'Vehicle Verification Details')
@section('content')
    <div class="app-inner-layout__wrapper">
        <div class="app-inner-layout__content">
            <div class="tab-content">
                <div class="container">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Header Section -->
                    <div class="mb-3 card">
                        <div class="card-header-tab card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                <i class="header-icon pe-7s-car icon-gradient bg-happy-green"></i>
                                Vehicle Verification Details
                            </div>
                            <div class="btn-actions-pane-right text-capitalize">
                                <a href="{{ route('admin.vehicle-verifications.index', ['pending' => true]) }}" 
                                   class="btn-wide btn-outline-2x mr-md-2 btn btn-outline-focus btn-sm">
                                    Back to Verifications
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Details Section -->
                    <div class="mb-3 card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Owner Information -->
                                <div class="col-md-6">
                                    <h5 class="card-title">Owner Information</h5>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Full Name</th>
                                                <td>
                                                    @if($vehicle->user)
                                                        {{ $vehicle->user->name }}
                                                        {{ Auth()->user()->firstname .' '.Auth()->user()->lastname }}
                                                    @else
                                                        <span class="text-danger">No owner assigned (Vehicle user_id: {{ $vehicle->user_id }})</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $vehicle->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone Number</th>
                                                <td>{{ $vehicle->user->phone ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Registration Date</th>
                                                <td>{{ $vehicle->user->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Verification Status -->
                                <div class="col-md-6">
                                    <h5 class="card-title">Verification Status</h5>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Current Status</th>
                                                <td>
                                                    @switch($vehicle->verification_status->value)
                                                        @case(\App\Enums\VerificationStatus::APPROVED->value)
                                                            <span class="badge bg-success">APPROVED</span>
                                                            @break
                                                        @case(\App\Enums\VerificationStatus::REJECTED->value)
                                                            <span class="badge bg-danger">REJECTED</span>
                                                            @break
                                                        @case(\App\Enums\VerificationStatus::CHANGES_REQUESTED->value)
                                                            <span class="badge bg-warning">CHANGES REQUESTED</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-warning">PENDING REVIEW</span>
                                                    @endswitch
                                                    
                                                    @if($vehicle->verification_status !== \App\Enums\VerificationStatus::PENDING && $vehicle->verified_at)
                                                        <span class="badge bg-info ms-2">
                                                            @if($vehicle->verification_status === \App\Enums\VerificationStatus::APPROVED)
                                                                APPROVED
                                                            @elseif($vehicle->verification_status === \App\Enums\VerificationStatus::REJECTED)
                                                                REJECTED
                                                            @elseif($vehicle->verification_status === \App\Enums\VerificationStatus::CHANGES_REQUESTED)
                                                                CHANGES REQUESTED
                                                            @endif
                                                            ON {{ $vehicle->verified_at->format('M d, Y') }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Submitted On</th>
                                                <td>{{ $vehicle->created_at->format('M d, Y H:i') }}</td>
                                            </tr>
                                            
                                            @if($vehicle->verified_at)
                                            <tr>
                                                <th>
                                                    @if($vehicle->verification_status === \App\Enums\VerificationStatus::APPROVED)
                                                        Approved On
                                                    @elseif($vehicle->verification_status === \App\Enums\VerificationStatus::REJECTED)
                                                        Rejected On
                                                    @elseif($vehicle->verification_status === \App\Enums\VerificationStatus::CHANGES_REQUESTED)
                                                        Changes Requested On
                                                    @else
                                                        Last Action On
                                                    @endif
                                                </th>
                                                <td>{{ $vehicle->verified_at->format('M d, Y H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Action By</th>
                                                <td>{{ $vehicle->verifiedBy->name ?? 'System' }}</td>
                                            </tr>
                                            @endif
                                            
                                            @if($vehicle->rejection_reason)
                                            <tr>
                                                <th>Rejection Reason</th>
                                                <td class="text-danger">{{ $vehicle->rejection_reason }}</td>
                                            </tr>
                                            @endif
                                            
                                            @if($vehicle->changes_requested)
                                            <tr>
                                                <th>Required Changes</th>
                                                <td class="text-warning-dark">{{ $vehicle->changes_requested }}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <hr>

                            <div class="row mt-4">
                                <!-- Vehicle Information -->
                                <div class="col-md-6">
                                    <h5 class="card-title">Vehicle Information</h5>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Make & Model</th>
                                                <td>{{ $vehicle->make }} {{ $vehicle->model }}</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>{{ $vehicle->year_of_manufacture }}</td>
                                            </tr>
                                            <tr>
                                                <th>VIN</th>
                                                <td>{{ $vehicle->vin }}</td>
                                            </tr>
                                            <tr>
                                                <th>License Plate</th>
                                                <td>{{ $vehicle->license_plate }}</td>
                                            </tr>
                                            <tr>
                                                <th>Color</th>
                                                <td>{{ $vehicle->color }}</td>
                                            </tr>
                                            <tr>
                                                <th>Type</th>
                                                <td>{{ ucfirst($vehicle->vehicle_type) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Seating Capacity</th>
                                                <td>{{ $vehicle->seating_capacity }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mileage</th>
                                                <td>{{ number_format($vehicle->mileage) }} km</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Insurance Information -->
                                <div class="col-md-6">
                                    <h5 class="card-title">Insurance Information</h5>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Insurance Provider</th>
                                                <td>{{ $vehicle->insurance_provider }}</td>
                                            </tr>
                                            <tr>
                                                <th>Policy Number</th>
                                                <td>{{ $vehicle->insurance_policy_number }}</td>
                                            </tr>
                                            <tr>
                                                <th>Expiration Date</th>
                                                <td>{{ $vehicle->insurance_expiration }}</td>
                                            </tr>
                                            <tr>
                                                <th>Driver's License Number</th>
                                                <td>{{ $vehicle->driver_license_number }}</td>
                                            </tr>
                                            <tr>
                                                <th>License Expiration</th>
                                                <td>{{ $vehicle->license_expiration }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <hr>

                            <!-- Document Section -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="card-title">Documents</h5>
                                    <div class="row">
                                        <!-- Vehicle Photo -->
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0">Vehicle Photo</h6>
                                                </div>
                                                <div class="card-body text-center">
                                                    @if($vehicle->vehicle_photo && Storage::disk('public')->exists($vehicle->vehicle_photo))
                                                        <a href="{{ route('admin.vehicle-verifications.view-document', ['vehicle' => $vehicle->id, 'document' => 'vehicle_photo']) }}" 
                                                        target="_blank"
                                                        class="d-block mb-2">
                                                            <img src="{{ route('admin.vehicle-verifications.view-document', ['vehicle' => $vehicle->id, 'document' => 'vehicle_photo']) }}" 
                                                                alt="Vehicle Photo" 
                                                                class="img-thumbnail document-thumbnail">
                                                        </a>
                                                        <div class="btn-group">
                                                            <a href="{{ route('admin.vehicle-verifications.view-document', ['vehicle' => $vehicle->id, 'document' => 'vehicle_photo']) }}" 
                                                            target="_blank"
                                                            class="btn btn-sm btn-primary">
                                                                <i class="fa fa-eye"></i> Preview
                                                            </a>
                                                            <a href="{{ route('admin.vehicle-verifications.view-document', ['vehicle' => $vehicle->id, 'document' => 'vehicle_photo']) }}?download=1" 
                                                            class="btn btn-sm btn-secondary">
                                                                <i class="fa fa-download"></i> Download
                                                            </a>
                                                        </div>
                                                    @else
                                                        <span class="text-danger">
                                                            @if(!$vehicle->vehicle_photo)
                                                                No photo uploaded
                                                            @else
                                                                File not found
                                                            @endif
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Insurance Document -->
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0">Insurance Document</h6>
                                                </div>
                                                <div class="card-body text-center">
                                                    @if($vehicle->insurance_document && Storage::disk('public')->exists($vehicle->insurance_document))
                                                        <a href="{{ route('admin.vehicle-verifications.view-document', ['vehicle' => $vehicle->id, 'document' => 'insurance_document']) }}" 
                                                        target="_blank"
                                                        class="d-block mb-2">
                                                            <i class="fa fa-file-pdf fa-4x text-danger mb-2"></i>
                                                        </a>
                                                        <div class="btn-group">
                                                            <a href="{{ route('admin.vehicle-verifications.view-document', ['vehicle' => $vehicle->id, 'document' => 'insurance_document']) }}" 
                                                            target="_blank"
                                                            class="btn btn-sm btn-primary">
                                                                <i class="fa fa-eye"></i> Preview
                                                            </a>
                                                            <a href="{{ route('admin.vehicle-verifications.view-document', ['vehicle' => $vehicle->id, 'document' => 'insurance_document']) }}?download=1" 
                                                            class="btn btn-sm btn-secondary">
                                                                <i class="fa fa-download"></i> Download
                                                            </a>
                                                        </div>
                                                    @else
                                                        <span class="text-danger">
                                                            @if(!$vehicle->insurance_document)
                                                                No insurance document uploaded
                                                            @else
                                                                File not found
                                                            @endif
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Registration Document -->
                                       <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0">Registration Document</h6>
                                                </div>
                                                <div class="card-body text-center">
                                                    @if($vehicle->registration_document && Storage::disk('public')->exists($vehicle->registration_document))
                                                        <a href="{{ route('admin.vehicle-verifications.view-document', ['vehicle' => $vehicle->id, 'document' => 'registration_document']) }}" 
                                                        target="_blank"
                                                        class="d-block mb-2">
                                                            <i class="fa fa-file-pdf fa-4x text-danger mb-2"></i>
                                                        </a>
                                                        <div class="btn-group">
                                                            <a href="{{ route('admin.vehicle-verifications.view-document', ['vehicle' => $vehicle->id, 'document' => 'registration_document']) }}" 
                                                            target="_blank"
                                                            class="btn btn-sm btn-primary">
                                                                <i class="fa fa-eye"></i> Preview
                                                            </a>
                                                            <a href="{{ route('admin.vehicle-verifications.view-document', ['vehicle' => $vehicle->id, 'document' => 'registration_document']) }}?download=1" 
                                                            class="btn btn-sm btn-secondary">
                                                                <i class="fa fa-download"></i> Download
                                                            </a>
                                                        </div>
                                                    @else
                                                        <span class="text-danger">
                                                            @if(!$vehicle->registration_document)
                                                                No registration document uploaded
                                                            @else
                                                                File not found
                                                            @endif
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>  

                            <!-- Action Buttons -->
                            <div class="mt-4 d-flex justify-content-end">
                                <button type="button" class="btn btn-warning me-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#requestChangesModal">
                                    <i class="fa fa-edit"></i> Request Changes
                                </button>
                                <button type="button" class="btn btn-danger me-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#rejectModal">
                                    <i class="fa fa-times"></i> Reject
                                </button>
                                <button type="button" class="btn btn-success" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#approveModal">
                                    <i class="fa fa-check"></i> Approve
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.vehicle-verifications.approve', $vehicle) }}">
                    @csrf @method('PATCH')
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Approve Vehicle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="sendApprovalEmail" name="send_email" checked>
                            <label class="form-check-label" for="sendApprovalEmail">Send approval notification to driver</label>
                        </div>
                        <div class="mb-3">
                            <label for="approvalNotes" class="form-label">Notes (included in notification)</label>
                            <textarea class="form-control" id="approvalNotes" name="comment" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check-circle me-1"></i> Approve Vehicle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.vehicle-verifications.reject', $vehicle) }}">
                    @csrf @method('PATCH')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Reject Vehicle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="sendRejectionEmail" name="send_email" checked>
                            <label class="form-check-label" for="sendRejectionEmail">Send rejection notification to driver</label>
                        </div>
                        <div class="mb-3">
                            <label for="rejectReason" class="form-label">Reason for rejection (required)</label>
                            <textarea class="form-control" id="rejectReason" name="reason" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times-circle me-1"></i> Reject Vehicle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Request Changes Modal -->
    <div class="modal fade" id="requestChangesModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.vehicle-verifications.request-changes', $vehicle) }}">
                    @csrf @method('PATCH')
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">Request Changes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="sendChangesEmail" name="send_email" checked>
                            <label class="form-check-label" for="sendChangesEmail">Send changes notification to driver</label>
                        </div>
                        <div class="mb-3">
                            <label for="changesRequested" class="form-label">Required changes (required)</label>
                            <textarea class="form-control" id="changesRequested" name="changes_requested" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Request Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all modals with proper backdrop 
    document.querySelectorAll('.modal').forEach(modalEl => {
        new bootstrap.Modal(modalEl, {
            backdrop: false,  
            keyboard: true,  
            focus: true      
        });
    });

    // Your existing form submission handling
    document.querySelectorAll('#approveModal form, #rejectModal form, #requestChangesModal form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    ${submitButton.textContent.trim()}
                `;
            }
        });
    });

    // Your existing modal initialization
    ['approveModal', 'rejectModal', 'requestChangesModal'].forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.addEventListener('shown.bs.modal', function() {
                const textarea = this.querySelector('textarea');
                if (textarea) textarea.focus();
            });
            
            // Added button reset on modal close
            modal.addEventListener('hidden.bs.modal', function() {
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton && submitButton.disabled) {
                    submitButton.disabled = false;
                    submitButton.innerHTML = submitButton.textContent;
                }
            });
        }
    });
});
</script>
@endpush
@endsection