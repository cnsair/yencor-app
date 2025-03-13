@extends('layouts.app-home')

@section('content')

    <div class="breadcrumb-div">
        <div class="container">
            <h1 class="page-title mb-0">{{ $blog->title }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li>{{ $blog->title }}</li>
            </ol>
        </div>
    </div>

        <div class="container">
            @if ($blog->image)
                <div class="text-center">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-100">
                </div>
            @endif

            <p class="mt-4">
                {!! nl2br(e($blog->content)) !!}
            </p>

            <span class="posted-on">
                Posted on {{ $blog->created_at->format('M d, Y') }} by <b>Admin</b>
            </span>

            <div class="mt-5">
                <a href="{{ route('blog') }}" class="btn btn-primary">Back to Blog</a>
            </div>

        </div>
@endsection