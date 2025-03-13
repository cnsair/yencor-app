@extends('layouts.app-admin')

@section('content')
<div class="container">
    <h2>Registered Drivers</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>License</th>
                <th>Vehicle Type</th>
                <th>Status</th>
                <th>Actions</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->driver }}</td>
                    <td>{{ $driver->user->name ?? 'N/A' }}</td>
                    <td>{{ $driver->license_number ?? 'N/A' }}</td>
                    <td>{{ $driver->vehicle ?? 'N/A' }}</td>
                    <td>
                        <span class="badge bg-{{ $driver->status == 'active' ? 'success' : ($driver->status == 'suspended' ? 'danger' : 'secondary') }}">
                            {{ ucfirst($driver->status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.updateStatus', $driver->driver) }}" method="POST">
                            @csrf
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="active" {{ $driver->status == 'active' ? 'selected' : '' }}>Activate</option>
                                <option value="inactive" {{ $driver->status == 'inactive' ? 'selected' : '' }}>Deactivate</option>
                                <option value="suspended" {{ $driver->status == 'suspended' ? 'selected' : '' }}>Suspend</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.registered-driver-details', $driver->driver) }}" class="btn btn-info">View Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $drivers->links() }}
</div>
@endsection
