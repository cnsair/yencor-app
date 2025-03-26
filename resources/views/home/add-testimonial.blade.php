@extends('layouts.app-home')

@section('content')

    <div class="breadcrumb-div">
        <div class="container">
            <h1 class="page-title mb-0">Testimonial</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Testimonial</li>
            </ol>
        </div>
    </div>

    <section class="div-padding border-0">
        <div class="container">
            <h2 class="div-title text-center">Share Your Testimony</h2>
            <div class="col-md-6 offset-3">

                @if(session('success'))
                    <p class="success-message">{{ session('success') }}</p>
                @endif

                <form action="{{ route('testimonial.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Please enter your full name" required>
                        @error('name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="form-label">Testimony:</label>
                        <textarea id="content" name="content" class="form-textarea" placeholder="Please tell us your experience with us in not more than 300 characters" maxlength="500" required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>            
               <!-- reCAPTCHA -->
               <div class="form-group">
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                @error('g-recaptcha-response')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                    <button type="submit" class="submit-btn">
                        Submit Testimony
                    </button>
                </form>
               
            </div>
        </div>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </section>

@endsection
