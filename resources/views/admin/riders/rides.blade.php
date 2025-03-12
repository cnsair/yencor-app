@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Rides by {{ $rider->firstname }} {{ $rider->lastname }}</h2>

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
            @foreach($rides as $ride)
                <tr>
                    <td>{{ $ride->id }}</td>
                    <td>{{ $ride->pickup_location }}</td>
                    <td>{{ $ride->destination }}</td>
                    <td>{{ $ride->created_at->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
