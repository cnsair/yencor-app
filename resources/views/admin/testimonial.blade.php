@extends('layouts.app-admin')

@section('content')

<div class="app-inner-layout__wrapper">
    <div class="app-inner-layout__content">
        <div class="tab-content">
            <div class="container-fluid">
                    
                <div class="card mb-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-settings mr-3 text-muted opacity-6"> </i>
                            Testimonials                         
                        </div>
                    </div>
                </div>
                       
                <div class="main-card mb-3 card">
                    <div class="card-body">

                        <div class="card mb-3">
                            <div class="card-body">
                                <table style="width: 100%;" id="example"
                                        class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Testimony</th>
                                            <th>Sent On</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($testimonials as $testimonial)
                                            <tr>
                                                <td>
                                                    <a class="font-weight-bold" href="{{ route('admin.testimonial.show', ['testimonial'=>$testimonial->id]) }}">{{ $testimonial->name }}</a>
                                                </td>
                                                <td>{{ Str::limit($testimonial->content, 50) }}</td>
                                                <td>
                                                    {{ $testimonial->created_at->diffForHumans() ." (".$testimonial->created_at .")" }}
                                                </td>
                                                <td>
                                                    <span class="d-flex justify-content-center gap-3">
   
                                                        <form method="POST" action="{{ route('admin.testimonial.toggle', $testimonial->id) }}" >
                                                            @csrf
                                                            @method('PUT')

                                                            @if ($testimonial->approved)
                                                                <button type="submit" class="btn btn-sm btn-success mr-2">
                                                                    Approved
                                                                </button>
                                                            @else
                                                                <button type="submit" class="btn btn-sm btn-warning mr-2">
                                                                    Not Approved
                                                                </button>
                                                            @endif

                                                            @if (session('status') === 'toggled' && session('approved_id') == $testimonial->id)
                                                                <p
                                                                    x-data="{ show: true }"
                                                                    x-show="show"
                                                                    x-transition
                                                                    x-init="setTimeout(() => show = false, 2000)"
                                                                    class="text-sm text-gray-600 dark:text-gray-400"
                                                                >
                                                                {{ __('Updated!') }}</p>
                                                            @endif
                                                        </form>

                                                        <form method="POST" action="{{ route('admin.testimonial.destroy', $testimonial->id) }}" onsubmit="return confirm('Are you sure you want to delete this testimony. This action is not reversible?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash fa-xs"></i>
                                                            </button>
                                                        </form>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Testimony</th>
                                            <th>Sent On</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
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
