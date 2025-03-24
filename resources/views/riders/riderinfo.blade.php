@extends('layouts.app-admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Rider Management</h2>

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

    <table class="table table-bordered">
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
                            $statusColors = [
                                1 => 'danger',    // Banned
                                2 => 'info',      // Suspended
                                3 => 'warning',   // Inactive
                                4 => 'success'    // Active
                            ];
                        @endphp
                        <span class="badge bg-{{ $statusColors[$rider->status] ?? 'secondary' }}">
                            {{ $rider->status_text }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.riders.update-status', $rider->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to ban this rider?');">
                            @csrf
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-sm btn-danger" {{ $rider->status == 1 ? 'disabled' : '' }}>Ban</button>
                        </form>
                        <form action="{{ route('admin.riders.update-status', $rider->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to suspend this rider?');">
                            @csrf
                            <input type="hidden" name="status" value="2">
                            <button type="submit" class="btn btn-sm btn-info" {{ $rider->status == 2 ? 'disabled' : '' }}>Suspend</button>
                        </form>
                        <form action="{{ route('admin.riders.update-status', $rider->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to deactivate this rider?');">
                            @csrf
                            <input type="hidden" name="status" value="3">
                            <button type="submit" class="btn btn-sm btn-warning" {{ $rider->status == 3 ? 'disabled' : '' }}>Deactivate</button>
                        </form>
                        <form action="{{ route('admin.riders.update-status', $rider->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to activate this rider?');">
                            @csrf
                            <input type="hidden" name="status" value="4">
                            <button type="submit" class="btn btn-sm btn-success" {{ $rider->status == 4 ? 'disabled' : '' }}>Activate</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.riders.show-rides', $rider->id) }}" class="btn btn-info btn-sm">View Rides</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection