@extends('layouts.app-home')

@section('content')

    <div class="breadcrumb-div">
        <div class="container">
            <h1 class="page-title mb-0">Blog</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Blog</li>
            </ol>
        </div>
    </div>

        <div class="container">
            <div class="blog-posts row">

                @if($blogs->isEmpty())
                     <p class="text-center">No blogs available.</p>
                @endif

                
                @foreach ($blogs as $blog)
                    <div class="blog-card col-lg-4 col-md-6">
                        <div>
                            <div class="post-thumb">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-100">
                            </div>
                            <div class="post-info-v-2 post-info">
                                <span class="category-v-2 category">Discuss</span>
                                <h2>
                                    <a class="blog-link" href="{{ route('blogs.show', $blog->id) }}" title>{{ $blog->title }}</a>
                                </h2>
                                <p class="blog-text">
                                    {{ Str::limit($blog->content, 100) }}
                                    <a href="{{ route('blogs.show', $blog->id) }}">Read More</a>
                                </p>
                                <span class="posted-on">
                                    {{ $blog->created_at->format('M d, Y') }}, by <b>Admin</b>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $blogs->links() }}
            </div>

        </div>
@endsection