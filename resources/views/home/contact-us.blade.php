@extends('layouts.app-home')

@section('content')

<!-- Breadcrumb Section -->
<div class="breadcrumb-div">
    <div class="container">
        <h1 class="page-title mb-0">Contact Us</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Contact</li>
        </ol>
    </div>
</div>

<!-- Contact Info Section -->
<div class="div-padding contact-info-div">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="single-contact-info text-center">
                    <img src="assets/assets/images/icon/contact_info.webp" alt="icon">
                    <h4>Address</h4>
                    <p>Address : Sakumono, Tema, Accra, Ghana.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="single-contact-info text-center">
                    <img src="assets/assets/images/icon/contact_info-2.webp" alt="icon">
                    <h4>Phone number</h4>
                    <p>Phone : (+233) 20 970 5088</p>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-0 col-sm-6 offset-sm-3">
                <div class="single-contact-info text-center">
                    <img src="assets/assets/images/icon/contact_info-3.webp" alt="icon">
                    <h4>E-mail</h4>
                    <p>Email : 
                        <a href="#" class="__cf_email__" >
                            admin@yencor.com | info@yencor.com | support@yencor.com
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Feedback Form Section -->
<div class="feedback-form">
    <h1>Give us a Feedback</h1>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="message">Your Message:</label><br>
            <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
            @error('message')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="submit-btn">Submit</button>
    </form>
</div>

@endsection
