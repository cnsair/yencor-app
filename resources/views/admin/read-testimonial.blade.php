@extends('layouts.app-admin')

@section('content')

<div class="app-inner-layout__wrapper">
    <div class="app-inner-layout__content">
        <div class="tab-content">
            <div class="container-fluid">
                    
                <div class="card mb-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-mail mr-3 text-muted opacity-6"> </i>
                            Testimonial                         
                        </div>
                    </div>
                </div>
                       
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="metismenu-icon pe-7s-users mr-3 text-muted opacity-6"> </i>
                                    <span>{{ $testimonial->name }}</span>
                                    <span class="px-4 fw-normal">
                                        <small>{{ $testimonial->created_at ." (". $testimonial->created_at->diffForHumans() .")" }}</small>
                                    </span>
                                </div>
                            </div>

                            <div class="card-body">
                                {{ htmlspecialchars_decode($testimonial->content) }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.mini-card mb3 card -->
             
            </div>
        </div>
    </div>
</div>

@endsection
