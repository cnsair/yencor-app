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

    <section class="div-padding border-0">
        <div class="container">
            <h2 class="div-title text-center">Blog</h2>
            <div class="blog-posts">
               
                <div class="blog-card col-lg-4 col-md-6">
                    <div>
                        <div class="post-thumb">
                            <img src="assets/assets/images/home/bus-1.jpg" alt class="w-100">
                        </div>
                        <div class="post-info-v-2 post-info">
                            <span class="category-v-2 category">discuss</span>
                            <h2>
                                <a class="blog-link" href="#" title>5 Things That You Need To Know
                                    About Yencor</a>
                            </h2>
                            <p class="blog-text">
                                Yencor is built around 5 core business principles. They are..
                            </p>
                            <span class="posted-on">Feb 3rd, 2025, by <a href="#" title>Admin</a></span>
                        </div>
                    </div>

                </div>
               
            </div>
        </div>
    </section>

@endsection