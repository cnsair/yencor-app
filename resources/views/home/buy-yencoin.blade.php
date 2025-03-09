@extends('layouts.app-home')

@section('content')

<!-- Breadcrumb Section -->
<div class="breadcrumb-div">
    <div class="container">
        <h1 class="page-title mb-0">Buy $Yencoin</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Buy $Yencoin</li>
        </ol>
    </div>
</div>

<!-- Contact Info Section -->
<div class="div-padding contact-info-div">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="single-contact-info text-center">
                    <img height="100" src="{{ asset('assets/assets/images/yencoin/yencoin-logo1.png') }}" alt="icon">
                    <!-- <i class="fab fa-btc fa-5x"></i> -->
			
                    <input type="text" class="form-control" id="copyText" disabled value="CA: Not available!" readonly>
                    <p>Please check back! Contract address is not available yet!</p>
                    <button class="btn btn-lg btn-primary mt-3" id="copyBtn" data-clipboard-target="#copyText">Copy</button>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>
	<script>
        var clipboard = new ClipboardJS('#copyBtn');

        clipboard.on('success', function(e) {
            let copyBtn = e.trigger;
            copyBtn.innerText = "Copied!";
            copyBtn.classList.remove("btn-primary");
            copyBtn.classList.add("btn-success");

            setTimeout(function() {
                copyBtn.innerText = "Copy";
                copyBtn.classList.remove("btn-success");
                copyBtn.classList.add("btn-primary");
            }, 2000);

            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            alert("Failed to copy. Please try manually.");
        });
    </script>
@endsection
