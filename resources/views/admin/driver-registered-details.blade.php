@extends('layouts.app-admin')

@section('content')
<div class="container">
    <h2>Driver Details</h2>
    
    <table class="table">
        <tr>
            <th>Name:</th>
            <td>{{ $driver->user->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $driver->user->email ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>License Number:</th>
            <td>{{ $driver->license_number ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Vehicle Type:</th>
            <td>{{ $driver->vehicle ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{ ucfirst($driver->status) }}</td>
        </tr>
    </table>

    <h3>Uploaded Documents</h3>
    <ul>
        <li><a href="{{ asset('storage/documents/' . $driver->license_number . '.pdf') }}" target="_blank">View License</a></li>
    </ul>

    <a href="{{ route('admin.registered-driver') }}" class="btn btn-primary">Back to Drivers</a>
</div>
@endsection
