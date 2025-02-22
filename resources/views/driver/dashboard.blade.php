@extends('layouts.app-driver')

@section('content')
    
    <div class="breadcrumb-div">
        <div class="container">
            <h1 class="page-title mb-0">Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('driver.dashboard') }}">Home</a></li>
                <li>My Dashboard</li>
            </ol>
        </div>
    </div>

    <div class="div-padding driver-dashboard-div">
        <div class="container">
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="passanger-name">
                        <div class="media">
                            
                            @php
                                $user_id = Auth::user()->id;
                                
                                $file = Auth()->user()->profile_photo_path;
                                $photo_path  = asset('storage/' . $file);
                            @endphp

                            @if ($file)
                                <img class="me-3 profile-picture" src="{{ asset($photo_path) }}" alt="partner-img" alt="ProfilePicture">
                            @else
                                <img class="me-3 profile-picture" src="{{ asset('assets/assets/images/avatar.png') }}" alt="ProfilePicture">
                            @endif

                            <div class="media-body">
                                <h2 class="mt-0">{{ Auth()->user()->firstname .' '.Auth()->user()->lastname }}</h2>
                                <p>{{ 'ID: ' . Auth()->user()->yenkor_id }}</p>
                                <p>{{ 'Email: ' . Auth()->user()->email }}</p>
                                <a class="btn btn-secondary" style="color: #fffddd" href="{{ route('driver.edit-profile.edit') }}">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 right-text">
                    <h2>Driver</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-dashboard">
                        <ul class="nav nav-tabs tab-navigation" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#dashboard" aria-controls="dashboard" class="active" role="tab"
                                    data-toggle="tab">Dashboard</a>
                            </li>
                            <li role="presentation" class="active">
                                <a href="#info" aria-controls="info" role="tab" data-toggle="tab">Profile
                                    Information</a>
                            </li>
                            <li role="presentation">
                                <a href="#vehicles" aria-controls="vehicles" role="tab" data-toggle="tab">My Vehicles</a>
                            </li>
                            <li role="presentation">
                                <a href="#rides" aria-controls="rides" role="tab" data-toggle="tab">My Rides</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="dashboard">
                                <div class="dashboard-info">
                                    <!-- <div class="ride-chart small-div">
                                        <h4>Ride Chart</h4>
                                        <div class="small-div-item">
                                            <div id="ride-chart"></div>
                                        </div>
                                    </div> -->
                                    <div class="overview-counter small-div">
                                        <h4>Overview</h4>
                                        <div class="counter-wrapper bg-gray small-div-item">
                                            <div class="single-counter-box">
                                                <h2 class="counter-number">0</h2>
                                                <p class="counter-text">Today Rides</p>
                                            </div>
                                            <div class="single-counter-box">
                                                <h2 class="counter-number">0</h2>
                                                <p class="counter-text">Total Rides</p>
                                            </div>
                                            <div class="single-counter-box">
                                                <h2 class="counter-number inline">0</h2>
                                                <p class="counter-text">Position</p>
                                            </div>
                                            <div class="single-counter-box">
                                                <h2 class="counter-number">0 Cedis</h2>
                                                <p class="counter-text">Total Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="earning-details small-div">
                                        <h4>Total earnings today</h4>
                                        <div class="total-earning-table table-responsive small-div-item">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Vehicle</th>
                                                        <th scope="col">Earnigns</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">From</th>
                                                        <th scope="col">To</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">N/A <small></small></th>
                                                        <td>N/A</td>
                                                        <td>N/A</td>
                                                        <td>N/A</td>
                                                        <td>N/A</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="button button-dark">View More</a>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="info">
                                <div class="personal-info small-div">
                                    <div class="div-heading">
                                        <h4 class="heading-item heading-item-1">Profile Information</h4>
                                        <!-- <p class="heading-item heading-item-2 right">
                                            <a href="#" class="edit-btn"><i class="fas fa-edit"></i> Edit</a>
                                        </p> -->
                                    </div>
                                    <div class="personal-details small-div-item">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="inputFirstName">First Name</label>
                                                    <input type="text" class="form-control text-muted"
                                                        id="inputFirstName" readonly value="{{ old('firstname',Auth()->user()->firstname) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="inputLastName">Last Name</label>
                                                    <input type="text" class="form-control text-muted"
                                                        id="inputLastName" readonly value="{{ old('lastname',Auth()->user()->lastname) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="inputEmail">Your Email</label>
                                                    <input type="text" class="form-control text-muted" id="inputEmail"
                                                        readonly value="{{ old('email', Auth()->user()->email) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="inputPhoneNumber">Phone Number</label>
                                                    <input type="text" class="form-control text-muted"
                                                        id="inputPhoneNumber" readonly value="{{ old('phone', Auth()->user()->phone) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="inputGender">Gender</label>
                                                    <input type="text" class="form-control text-muted" id="inputGender"
                                                        readonly value="{{ old('gender', Auth()->user()->gender) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="inputBirthday">Your Birthday</label>
                                                    <input type="text" class="form-control text-muted"
                                                        id="inputBirthday" readonly value="{{ date("M d, Y", strtotime( old('d_o_b', Auth()->user()->d_o_b) )) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="inputDesc">Something about you</label>
                                                    <textarea class="form-control text-muted" id="inputDesc"
                                                        readonly>{{ old('biography', Auth()->user()->biography) }}.</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div role="tabpanel" class="tab-pane" id="vehicles">
                                <div class="vahicles-container">

                                    <div class="row">
                                        <!-- <div class="col-lg-6">
                                            <h4>My vehicles</h4>
                                        </div> -->
                                        <div class="col-lg-12 text-end">
                                            <a href="{{ route('driver.register-vehicle.create') }}" class="button button-dark">Register New Vehicle</a>
                                        </div>

                                        @forelse ( $vehicle_data as $vehicle )
                                            @php
                                                $vehicle_photo = $vehicle->vehicle_photo;
                                                $insurance_document = $vehicle->insurance_document;
                                                $registration_document = $vehicle->registration_document;

                                                $photo = asset('storage/' . $vehicle_photo);
                                                $insurance_doc = asset('storage/' . $insurance_document);
                                                $registration_doc = asset('storage/' . $registration_document);
                                                //$file_ext = pathinfo($vid, PATHINFO_EXTENSION);

                                                $make = $vehicle->make;
                                                $model = $vehicle->model;
                                                $year_of_manufacture = $vehicle->year_of_manufacture;
                                                $license_plate = $vehicle->license_plate;
                                                $vin = $vehicle->vin;
                                                $color = $vehicle->color;
                                                $vehicle_type = $vehicle->vehicle_type;
                                                $insurance_provider = $vehicle->insurance_provider;
                                                $insurance_policy_number = $vehicle->insurance_policy_number;
                                                $insurance_expiration = $vehicle->insurance_expiration;
                                                $driver_license_number = $vehicle->driver_license_number;
                                                $license_expiration = $vehicle->license_expiration;
                                                $seating_capacity = $vehicle->seating_capacity;
                                                $mileage = $vehicle->mileage;
                                            @endphp

                                            <div class="col-lg-6">
                                                <h2>{{ $make }} <small>"{{ $model }}"</small></h2>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="single-vehicle-container">
                                                        <img src="{{ $photo }}" alt="Vehicle">
                                                    </div>
                                                </div>

                                                <form action="{{ route('driver.vehicle.destroy', ['vehicle' => $vehicle->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <x-danger-button type="submit" onclick="return confirm('Are you sure you want to permanently delete this vehicle record?');" class="button button-dark">
                                                        {{ __('Delete') }}
                                                    </x-danger-button>
                                                </form>

                                                <p>Year of Manufacture: <small><b>{{ $year_of_manufacture }}</b></small></p>
                                                <p>License Plate: <small><b>{{ $license_plate }}</b></small></p>
                                                <p>VIN: <small><b>{{ $vin }}</b></small></p>
                                                <p>Color: <small><b>{{ $color }}</b></small></p>
                                                <p>Vehicle Type: <small><b>{{ $vehicle_type }}</b></small></p>
                                                <p>Insurance Provider: <small><b>{{ $insurance_provider }}</b></small></p>
                                                <p>Insurance Policy Number: <small><b>{{ $insurance_policy_number }}</b></small></p>
                                                <p>Insurance Expiration: <small><b>{{ $insurance_expiration }}</b></small></p>
                                                <p>Driver License Number: <small><b>{{ $driver_license_number }}</b></small></p>
                                                <p>License Expiration: <small><b>{{ $license_expiration }}</b></small></p>
                                                <p>Seating Capacity: <small><b>{{ $seating_capacity }}</b></small></p>
                                                <p>Mileage: <small><b>{{ $mileage }}</b></small></p>
                                                <p>Insurance Document: 
                                                    <small><b><a download href="{{ $insurance_doc }}">Download</a> to preview</b></small>
                                                </p>
                                                <p>Registration Document: 
                                                    <small><b><a download href="{{ $registration_doc }}">Download</a> to preview</b></small>
                                                </p>
                                            </div>
                                        @empty
                                            <div class="container">
                                                You've not registered any vehicle yet. Please click <a href="{{ route('driver.register-vehicle.create') }}">here</a> to register one.
                                            </div>
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane" id="rides">
                                <div class="rides-details">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4>Rides</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="rides-filter">
                                                <ul>
                                                    <li>
                                                        <a href="#">Yesterday</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Last Week</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Last Month</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Last 6 Month</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Last Year</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row small-div">
                                        <div class="col-lg-12">
                                            <div class="total-earning-table table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Vehicle</th>
                                                            <th scope="col">Earnigns</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">From</th>
                                                            <th scope="col">To</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">N/A <small></small></th>
                                                            <td>N/A</td>
                                                            <td>N/A</td>
                                                            <td>N/A</td>
                                                            <td>N/A</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="text-center">
                                                <a href="#" class="button button-dark">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

        <!-- Ends here -->   
        </div>
    </div>

@endsection