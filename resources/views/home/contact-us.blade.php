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
<div class="feedback-form py-5" style="background-color: #f9fafb;">
    <div class="container d-flex justify-content-center">
        <div class="col-lg-8 col-xl-6">

            <h1 class="text-center mb-4 fw-bold text-dark">Give us your Feedback</h1>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="bg-white p-4 p-md-5 rounded shadow-sm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Your Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control">
                    @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Your Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control">
                    @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="message" class="form-label fw-semibold">Your Message</label>
                    <textarea id="message" name="message" rows="5" required class="form-control">{{ old('message') }}</textarea>
                    @error('message')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-semibold py-2">
                    Submit Feedback
                </button>
            </form>

        </div>
    </div>
</div>


@endsection