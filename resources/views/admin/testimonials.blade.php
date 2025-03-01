@extends('layouts.app-admin')

@section('content')
<div class="container-box">
    <h1 class="title">Manage Testimonials</h1>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <ul class="testimonial-list">
        @foreach ($testimonials as $testimonial)
            <li class="testimonial-item">
                <strong class="text-lg">{{ $testimonial->name }}:</strong> 
                <p class="testimonial-text">{{ $testimonial->content }}</p>

                @if (!$testimonial->approved)
                    <div class="button-container">
                        <form method="POST" action="{{ route('testimonials.approve', $testimonial->id) }}">
                            @csrf
                            <button type="submit" class="approve-button">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('testimonials.reject', $testimonial->id) }}">
                            @csrf
                            <button type="submit" class="reject-button">Reject</button>
                        </form>
                    </div>
                @else
                    <span class="approved-status">(Approved)</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
