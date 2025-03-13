@extends('layouts.app-admin')

@section('content')
<div class="container">
    <h1>{{ $blog->title }}</h1>
    
    @if($blog->image)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
        </div>
    @endif

    <p>{!! nl2br(e($blog->content)) !!}</p>
    <p class="text-muted">Posted on {{ $blog->created_at->format('M d, Y') }}</p>
    
    <a href="{{ route('admin.blogs') }}" class="btn btn-primary">Back to Blogs</a>
</div>
@endsection
