@extends('layouts.app-admin')


@section('content')
<div style="max-width: 800px; margin: 20px auto; padding: 20px; background: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px;">
    <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px; text-align: center;">Manage Testimonials</h1>

    @if(session('success'))
        <p style="color: green; text-align: center; margin-bottom: 15px;">{{ session('success') }}</p>
    @endif

    <ul style="list-style: none; padding: 0;">
        @foreach ($testimonials as $testimonial)
            <li style="padding: 15px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 10px;">
                <strong style="font-size: 18px;">{{ $testimonial->name }}:</strong> 
                <p style="color: #333; margin: 8px 0;">{{ $testimonial->content }}</p>

                @if (!$testimonial->approved)
                    <div style="display: flex; gap: 10px; margin-top: 10px;">
                        <form method="POST" action="{{ route('testimonials.approve', $testimonial->id) }}">
                            @csrf
                            <button type="submit" style="background: green; color: white; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer;">
                                Approve
                            </button>
                        </form>
                        <form method="POST" action="{{ route('testimonials.reject', $testimonial->id) }}">
                            @csrf
                            <button type="submit" style="background: red; color: white; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer;">
                                Reject
                            </button>
                        </form>
                    </div>
                @else
                    <span style="color: green; font-weight: bold;">(Approved)</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
