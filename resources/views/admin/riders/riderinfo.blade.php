@extends('layouts.app-admin')

@section('content')
<div class="app-inner-layout__wrapper">
    <div class="app-inner-layout__content">
        <div class="tab-content">
            <div class="container-fluid">
                <!-- Success/Error Messages -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Rider Management Card -->
                <div class="card mb-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="metismenu-icon pe-7s-users mr-3 text-muted opacity-6"></i>
                            Rider Management
                        </div>
                        <div class="btn-actions-pane-right text-capitalize">
                            <button class="btn-wide btn-outline-2x mr-md-2 btn btn-outline-focus btn-sm">
                                View All Riders
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="riderTable" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                    <th>View Rides</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riders as $rider)
                                <tr>
                                    <td>{{ $rider->firstname }} {{ $rider->lastname }}</td>
                                    <td>{{ $rider->email }}</td>
                                    <td>
                                        @php
                                        $statusButtons = [
                                        1 => 'btn-danger', // Banned
                                        2 => 'btn-warning', // Suspended
                                        3 => 'btn-secondary', // Inactive
                                        4 => 'btn-success' // Active
                                        ];
                                        $statusText = [
                                        1 => 'Banned',
                                        2 => 'Suspended',
                                        3 => 'Inactive',
                                        4 => 'Active'
                                        ];
                                        @endphp
                                        <button class="btn btn-sm {{ $statusButtons[$rider->status] ?? 'btn-secondary' }}">
                                            {{ $statusText[$rider->status] ?? 'Unknown' }}
                                        </button>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('admin.riders.update-status', $rider->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="btn btn-sm btn-danger" {{ $rider->status == 1 ? 'disabled' : '' }} onclick="return confirm('Are you sure you want to ban this rider?');">Ban</button>
                                            </form>
                                            <form action="{{ route('admin.riders.update-status', $rider->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="2">
                                                <button type="submit" class="btn btn-sm btn-warning" {{ $rider->status == 2 ? 'disabled' : '' }} onclick="return confirm('Are you sure you want to suspend this rider?');">Suspend</button>
                                            </form>
                                            <form action="{{ route('admin.riders.update-status', $rider->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="3">
                                                <button type="submit" class="btn btn-sm btn-secondary" {{ $rider->status == 3 ? 'disabled' : '' }} onclick="return confirm('Are you sure you want to deactivate this rider?');">Deactivate</button>
                                            </form>
                                            <form action="{{ route('admin.riders.update-status', $rider->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status" value="4">
                                                <button type="submit" class="btn btn-sm btn-success" {{ $rider->status == 4 ? 'disabled' : '' }} onclick="return confirm('Are you sure you want to activate this rider?');">Activate</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.riders.show-rides', $rider->id) }}" class="btn btn-sm btn-info">View Rides</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                    <th>View Rides</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- DataTables Script -->
@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#riderTable').DataTable({
            "pageLength": 10, // Default entries per page
            "lengthMenu": [10, 25, 50, 100], // Options for "Show X entries"
            "searching": true, // Enable search
            "ordering": true, // Enable column sorting
            "info": true, // Show "Showing X to Y of Z entries"
            "language": {
                "search": "Search Riders:", // Customize search box text
                "lengthMenu": "Show _MENU_ entries", // Customize "Show Entries" label
                "zeroRecords": "No riders found", // No records found message
            }
        });
    });
</script>
@endpush
@endsection

@push('styles')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush