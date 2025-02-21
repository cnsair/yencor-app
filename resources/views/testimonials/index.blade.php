@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Testimonials</h1>
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">Add Testimony</a>

        @if ($testimonials->isEmpty())
            <p>No testimonials available.</p>
        @else
            <ul>
                @foreach ($testimonials as $testimonial)
                    <li>
                        <strong>{{ $testimonial->name }}:</strong> {{ $testimonial->testimonial }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
