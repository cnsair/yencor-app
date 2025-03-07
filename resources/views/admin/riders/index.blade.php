@extends('layouts.app-home')

@section('content')
<div class="container">
    <h2>Rider Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
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
                        <td>{{ $rider->name }}</td>
                        <td>{{ $rider->email }}</td>
                        <td>
                            <span class="badge {{ $rider->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($rider->status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.riders.update-status', $rider->id) }}" method="POST">
                                @csrf
                                <select name="status" class="form-select">
                                    <option value="1" {{ $rider->status == '1' ? 'selected' : '' }}>Activate</option>
                                    <option value="2" {{ $rider->status == '2' ? 'selected' : '' }}>Deactivate</option>
                                    <option value="3" {{ $rider->status == '3' ? 'selected' : '' }}>Suspend</option>
                                    <option value="4" {{ $rider->status == '4' ? 'selected' : '' }}>Ban</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
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
</div>
@endsection
