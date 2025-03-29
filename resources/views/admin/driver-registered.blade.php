@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
            <i class="metismenu-icon pe-7s-users mr-3 text-muted opacity-6"> </i>
            Registered Drivers
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="example" class="table table-hover table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <th>Name / ID</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Vehicle</th>
                <th>Status</th>
                <th>Registration Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
            <tr>
                <td>
                    <a href="{{ route('admin.driver-registered-details', $driver->id) }}">
                        {{ $driver->firstname }} {{ $driver->lastname }}
                    </a>
                    <br>
                    <small>{{ $driver->yenkor_id }}</small>
                </td>
                <td>{{ $driver->phone }}</td>
                <td>{{ $driver->email }}</td>
                <td>{{ $driver->vehicle }}</td>
                <td>
                    @if($driver->status == 4)
                        <span class="badge badge-success">Active</span>
                    @elseif($driver->status == 3)
                        <span class="badge badge-secondary">Inactive</span>
                    @elseif($driver->status == 2)
                        <span class="badge badge-warning">Suspended</span>
                    @endif
                </td>
                <td>{{ $driver->created_at->format('Y-m-d') }}</td>
                <td>
                    <!-- Individual Status Update Actions (each as its own form) -->
                    <form action="{{ route('admin.driver-registered.updateStatus', $driver->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" name="status" value="4" class="btn btn-sm btn-success">Activate</button>
                    </form>
                    <form action="{{ route('admin.driver-registered.updateStatus', $driver->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" name="status" value="3" class="btn btn-sm btn-secondary">Deactivate</button>
                    </form>
                    <form action="{{ route('admin.driver-registered.updateStatus', $driver->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" name="status" value="2" class="btn btn-sm btn-warning">Suspend</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name / ID</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Vehicle</th>
                <th>Status</th>
                <th>Registration Date</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#example').DataTable({
            "paging": true,
            "info": true,
            "searching": true,
            "lengthChange": true,
            "order": [[1, 'asc']] // default sorting by Name/ID
        });
    });
</script>
@endsection

