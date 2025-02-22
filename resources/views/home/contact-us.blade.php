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
                    <p>Address : akumono, Tema, Accra, Ghana.</p>
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

    <form action="{{ route('contact-us.store') }}" method="POST">
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

<!-- CSS Styles -->
<style>
    /* Feedback form container */
    .feedback-form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    /* Form title */
    .feedback-form h1 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 20px;
    }

    /* Form group (label + input/textarea) */
    .form-group {
        margin-bottom: 20px;
    }

    /* Label styling */
    .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    /* Input and textarea styles */
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; /* Ensures padding doesn't affect width */
    }

    /* Focus state for input and textarea */
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #007bff;
    }

    /* Submit button styling */
    .submit-btn {
        background-color: #44433F;
        color: white;
        padding: 10px 20px;
        font-size: 1rem;
        border: none;
        border-radius: 4px;
        width: 100%;
        cursor: pointer;
    }

    /* Submit button hover effect */
    .submit-btn:hover {
        background-color: #0056b3;
    }

    /* Error message styling */
    .error-message {
        color: red;
        font-size: 0.875rem;
    }

    /* Success message styling */
    .success-message {
        color: green;
        font-size: 1.1rem;
        text-align: center;
        margin-bottom: 20px;
    }
</style>

@endsection
