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
                        <a href="#" class="__cf_email__">
                            admin@yencor.com | info@yencor.com | support@yencor.com
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Feedback Form Section -->
<div class="feedback-section">
    <div class="feedback-container">

        <h2 class="feedback-title">Give us your Feedback</h2>

        @if(session('success'))
        <div class="feedback-alert-success" role="alert">
            {{ session('success') }}
            <button class="feedback-alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="feedback-form">
            @csrf

            <label for="name" class="feedback-label">Your Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="feedback-input">
            @error('name')
            <p class="feedback-error">{{ $message }}</p>
            @enderror

            <label for="email" class="feedback-label">Your Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="feedback-input">
            @error('email')
            <p class="feedback-error">{{ $message }}</p>
            @enderror

            <label for="message" class="feedback-label">Your Message</label>
            <textarea id="message" name="message" rows="5" required class="feedback-input">{{ old('message') }}</textarea>
            @error('message')
            <p class="feedback-error">{{ $message }}</p>
            @enderror

            <button type="submit" class="feedback-button">Submit Feedback</button>
        </form>

    </div>
</div>

@endsection