@extends('layouts.app-home')

@section('content')
<div class="testimonial-container">
    <div class="testimonial-card">
        <h2 class="testimonial-heading">Share Your Testimonial</h2>

        <form action="{{ route('testimonial.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Your Real Name:</label>
                <input type="text" id="name" name="name" class="form-input" placeholder="Your real name" required>
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Tell us your feedback (Max 500 words):</label>
                <textarea id="content" name="content" class="form-textarea" placeholder="Tell us your feedback in not more than 500 words" maxlength="500" required></textarea>
            </div>

            <button type="submit" class="submit-button">Submit Testimonial</button>
        </form>
    </div>
</div>
@endsection
