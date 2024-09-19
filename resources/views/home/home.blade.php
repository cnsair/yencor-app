@extends('home-layouts.home-app')

@section('content')

    <section class="hero-area-v-2 p-0 dark-overlay-3">
        <video autoplay muted loop id="myVideo" width="100">
            <source src="assets/assets/bg-video-2.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="hero-area-wrap">
                        <div class="hero-area-left">
                            <h1 class="hero-title-v-2">
                                <span class="hero-title-bg">
                                    Ride Safety. <span class="hero-title-accent-v-2">Drive and Earn.</span>
                                    <span>All Contributes to Society.</span></span>
                            </h1>
                            <p class="hero-text">
                                Partner with us as a rider for ease and comfort, or as a driver to drive your own livelihood and more.
                            </p>
                            <div class="download-buttons">
                                <a href="#" aria-label="download-apple-btn"><img src="assets/assets/images/download-1.webp"
                                        alt></a>
                                <a href="#" aria-label="download-android-btn"><img src="assets/assets/images/download-2.webp"
                                        alt></a>
                            </div>
                        </div>
                        <div class="hero-area-right">
                            <div class="combine-form">
                                <nav class="navigation">
                                    <div class="nav nav-tabs form-tab" role="tablist">
                                        <button class="nav-link" id="nav-ride-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-ride" type="button" role="tab" aria-controls="nav-ride"
                                            aria-selected="false">
                                            <i class="fas fa-car"></i> Take a Ride
                                        </button>
                                        <button class="nav-link active" id="nav-drive-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-drive" type="button" role="tab"
                                            aria-controls="nav-drive" aria-selected="true">
                                            <i class="far fa-steering-wheel"></i> Apply to Drive
                                        </button>
                                    </div>
                                </nav>
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="nav-ride" role="tabpanel"
                                        aria-labelledby="nav-ride-tab">

                                        <x-validation-errors class="mb-4" />

                                        <form method="POST" action="{{ route('register') }}" class="form1">
                                            @csrf

                                            <h2 class="form-title">Get member exclusive rewards</h2>
                                            <p class="form-text">
                                                Enjoy the comfort of stressless and cheap ride 
                                            </p>
                                            <div class="row">
                                                <input type="number" class="form-control" name="role"
                                                        id="role" hidden value="0" required>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" name="firstname"
                                                        id="firstName" placeholder="First Name" :value="old('firstname')" required autofocus autocomplete="firstname">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" name="lastname"
                                                        id="lastName" placeholder="Last Name" :value="old('lastname')" required autocomplete="lastname">
                                                </div>
                                                <div class="form-group col-12">
                                                    <input type="number" class="form-control" name="phone" id="number"
                                                        placeholder="Phone Number (Optional)" :value="old('phone')" autocomplete="phone">
                                                </div>
                                                <div class="form-group col-12">
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        placeholder="Email Address" :value="old('email')" required autocomplete="email">
                                                </div>
                                                <div class="form-group col-12">
                                                    <input type="password" class="form-control" name="password"
                                                        id="password" placeholder="Password">
                                                </div>
                                                <div class="form-group col-12">
                                                    <input type="password" class="form-control" name="password.confirmation"
                                                        id="password" placeholder="Confirm Password">
                                                </div>
                                                <div class="col-12 form-group mt-3">
                                                    <input type="checkbox" id="agree" name="terms-and-privacy">
                                                    <label for="agree">I agree to the
                                                        <a href="#">Terms and Conditions</a> and
                                                        <a href="#">Privacy Policy</a></label>
                                                </div>
                                                <div class="form-btn col-12">
                                                    <button class="form-button button button-dark big">
                                                        Sign up to Ride
                                                    </button>
                                                </div>
                                            </div>
                                            <p class="form-messages mb-0 mt-3"></p>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade show active" id="nav-drive" role="tabpanel"
                                        aria-labelledby="nav-drive-tab">

                                        <x-validation-errors class="mb-4" />

                                        <form method="POST" action="{{ route('register') }}" class="form1">
                                            @csrf
                                            
                                            <h2 class="form-title">
                                                Start driving now and get paid
                                            </h2>
                                            <p class="form-text">
                                                Enjoy being paid what you deserve.
                                            </p>
                                            <div class="row">
                                                <input type="number" class="form-control" name="role"
                                                    id="role" hidden value="1" required>
                                                
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" name="firstname"
                                                        id="firstName2" placeholder="First Name" :value="old('firstname')" required autofocus autocomplete="name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" name="lastname"
                                                        id="lastName2" placeholder="Last Name" :value="old('lastname')" required autocomplete="name">
                                                </div>
                                                <div class="form-group col-12">
                                                    <input type="tel" class="form-control" name="phone" id="number2"
                                                        placeholder="Phone Number" required :value="old('phone')" autocomplete="phone">
                                                </div>
                                                <div class="form-group col-12">
                                                    <input type="email" class="form-control" name="email" id="email2"
                                                        placeholder="Email Address" :value="old('email')" required autocomplete="email">
                                                </div>
                                                <div class="form-group col-12">
                                                    <input type="password" class="form-control" name="password"
                                                        id="password" placeholder="Password" required>
                                                </div>
                                                <div class="form-group col-12">
                                                    <input type="password" class="form-control" name="password.confirmation"
                                                        id="password" placeholder="Confirm Password" required>
                                                </div>
                                                <div class="col-12 form-group mt-3">
                                                    <input type="checkbox" id="agree2" {{ old('terms') == 1 ? 'checked' : '' }} name="terms" required>
                                                    <label for="agree2">I agree to the
                                                        <a href="#">Terms and Conditions</a> and
                                                        <a href="#">Privacy Policy</a></label>
                                                </div>
                                                <div class="form-btn col-12">
                                                    <button type="submit" class="form-button button button-dark big">
                                                        Become a Driver
                                                    </button>
                                                </div>
                                            </div>
                                            <p class="form-messages mb-0 mt-3"></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    @include('home.howitworks')

    @include('home.trusted')

    @include('home.download')

    @include('home.testimonial')

@endsection