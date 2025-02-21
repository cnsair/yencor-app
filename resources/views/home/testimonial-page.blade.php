@extends('layouts.app-home')

@section('content')
<div style="margin-top: 80px; display: flex; justify-content: center;">
    <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px;">
        <h2 style="text-align: center; font-size: 24px; font-weight: bold; color: #333; margin-bottom: 15px;">Share Your Testimonial</h2>

        <form action="{{ route('testimonial.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Your Real Name:</label>
                <input type="text" id="name" name="name" style="width: 100%; border: 1px solid #ccc; border-radius: 5px; padding: 10px; font-size: 16px; outline: none;" placeholder="Your real name" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="content" style="display: block; font-weight: bold; color: #555; margin-bottom: 5px;">Tell us your feedback (Max 500 words):</label>
                <textarea id="content" name="content" style="width: 100%; border: 1px solid #ccc; border-radius: 5px; padding: 10px; font-size: 16px; outline: none; height: 120px; resize: none;" placeholder="Tell us your feedback in not more than 500 words" maxlength="500" required></textarea>
            </div>

            <button type="submit" style="width: 100%; background: #007BFF; color: white; padding: 10px; font-size: 18px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: background 0.3s;">
                Submit Testimonial
            </button>
        </form>
    </div>
</div>
@endsection
