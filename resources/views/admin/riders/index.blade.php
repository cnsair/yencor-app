@extends('layouts.app-home')

@section('content')
<div class="container">
    <h2 class="mb-4">Rider Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
                        <span class="badge bg-{{ $rider->status == 1 ? 'success' : 'danger' }}">
                            {{ $rider->status_text }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.riders.update-status', $rider->id) }}" method="POST">
                            @csrf
                            <button type="submit" name="status" value="1" class="btn btn-success btn-sm">Activate</button>
                            <button type="submit" name="status" value="2" class="btn btn-warning btn-sm">Deactivate</button>
                            <button type="submit" name="status" value="3" class="btn btn-danger btn-sm">Suspend</button>
                            <button type="submit" name="status" value="4" class="btn btn-dark btn-sm">Ban</button>
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
