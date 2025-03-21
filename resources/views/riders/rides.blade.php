@extends('layouts.app-admin')

@section('content')
<div class="container">
    @if(isset($rider))
        <h2>Rides by {{ $rider->firstname }} {{ $rider->lastname }}</h2>
    @else
        <h2>No rider selected</h2>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ride ID</th>
                    <th>Pickup</th>
                    <th>Destination</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($rides) && count($rides) > 0)
                    @foreach($rides as $ride)
                        <tr>
                            <td>{{ $ride->id }}</td>
                            <td>{{ $ride->pick_up }}</td>
                            <td>{{ $ride->destination }}</td>
                            <td>{{ $ride->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="4">No rides available.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
