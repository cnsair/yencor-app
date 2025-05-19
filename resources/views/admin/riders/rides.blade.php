@extends('layouts.app-admin')

@section('content')

<div class="app-inner-layout__wrapper">
    <div class="app-inner-layout__content">
        <div class="tab-content">
            <div class="container-fluid">
                <!-- Rides Card -->
                <div class="card mb-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="metismenu-icon pe-7s-map-2 mr-3 text-muted opacity-6"></i>
                            @if(isset($rider))
                            Rides by {{ $rider->firstname }} {{ $rider->lastname }}
                            @else
                            No Rider Selected
                            @endif
                        </div>
                        <div class="btn-actions-pane-right text-capitalize">
                            <a href="{{ route('admin.riders.index') }}" class="btn-wide btn-outline-2x mr-md-2 btn btn-outline-focus btn-sm">
                                Back to Riders
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="ridesTable" class="table table-hover table-striped table-bordered">
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
                                <tr>
                                    <td colspan="4" class="text-center">No rides available.</td>
                                </tr>
                                @endif
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Ride ID</th>
                                    <th>Pickup</th>
                                    <th>Destination</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection