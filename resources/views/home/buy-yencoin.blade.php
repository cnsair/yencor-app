@extends('layouts.app-home')

@section('content')

<!-- Breadcrumb Section -->
<div class="breadcrumb-div">
    <div class="container">
        <h1 class="page-title mb-0">Buy Yencoin</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Buy Yencoin</li>
        </ol>
    </div>
</div>

<!-- Contact Info Section -->
<div class="div-padding contact-info-div">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="single-contact-info text-center">
                    <!-- <img src="assets/assets/images/icon/contact_info.webp" alt="icon"> -->
                    <i class="fab fa-btc fa-5x"></i>
                    <h1>CA: Not available!</h1>
                    <p>Please check back! Contract address is not available yet.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
