@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
            <i class="metismenu-icon pe-7s-users mr-3 text-muted opacity-6"> </i>
            Driver Details
        </div>
    </div>    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $driver->firstname }} {{ $driver->lastname }}</p>
            <p><strong>ID:</strong> {{ $driver->yenkor_id }}</p>
            <p><strong>Phone:</strong> {{ $driver->phone }}</p>
            <p><strong>Email:</strong> {{ $driver->email }}</p>
            <p><strong>Gender:</strong> {{ $driver->gender ?? 'N/A' }}</p>
            <p><strong>Vehicle:</strong> {{ $driver->vehicle }}</p>
            <p><strong>Status:</strong>
                @if($driver->status == 4)
                    Active
                @elseif($driver->status == 3)
                    Inactive
                @elseif($driver->status == 2)
                    Suspended
                @endif
            </p>
            <p><strong>Registration Date:</strong> {{ $driver->created_at->format('Y-m-d') }}</p>

            <!-- Add driver-related documents if available -->
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    <i class="metismenu-icon pe-7s-users mr-3 text-muted opacity-6"> </i>
                    <h6>Documents</h6>
                </div>
            </div>
            @if(isset($driver->documents) && $driver->documents->count() > 0)
                <ul>
                    @foreach($driver->documents as $doc)
                        <li>{{ $doc->document_name }}</li>
                    @endforeach
                </ul>
            @else
                <p>No documents available.</p>
            @endif
        </div>
    </div>
    <a href="{{ route('admin.driver-registered') }}" class="btn btn-secondary mt-3">Back to Drivers</a>
</div>
@endsection
