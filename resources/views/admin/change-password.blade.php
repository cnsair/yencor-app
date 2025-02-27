@extends('layouts.app-admin')

@section('content')

<div class="app-inner-layout__wrapper">
    <div class="app-inner-layout__content">
        <div class="tab-content">

            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header-tab card-header">
                                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                        <i class="header-icon pe-7s-settings mr-3 text-muted opacity-6"> </i>
                                        Change Password                             
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-sm-12 sub-header -->

                        <!-- right column -->
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-body">

                                    <x-validation-errors class="mb-4" />

                                    @if (session('status') === 'success')
                                        <x-success-msg>
                                            {{ __('Password updated successfully.') }}
                                        </x-success-msg>
                                    @elseif (session('status') === 'failed')
                                        <x-failed-msg>
                                            {{ __('Something went wrong! Please try again.') }}
                                        </x-failed-msg>
                                    @endif

                                    <form method="POST" action="{{ route('admin.change-password.update', ['update' => Auth::user()->id]) }}" class="mt-6 space-y-6">
                                        @csrf
                                        @method('patch')
                                        
                                        <div class="form-group has-label">
                                            <label>Current Password <star class="star">*</star></label>
                                            <input name="current_password" type="password" class="form-control" required />
                                            <x-input-error for="current_password" class="mt-2" />
                                        </div>

                                        <div class="form-group has-label">
                                            <label>New Password <star class="star">*</star></label>
                                            <input name="password" type="password" class="form-control" required />
                                            <x-input-error for="password" class="mt-2" />
                                        </div>

                                        <div class="form-group has-label">
                                            <label>Confirm Password <star class="star">*</star></label>
                                            <input name="password_confirmation" type="password" class="form-control" required />
                                            <x-input-error for="password_confirmation" class="mt-2" />
                                        </div>

                                        <div class="card-category form-category">
                                            <star class="star">*</star> Required fields
                                        </div>
                                           
                                        <div class="card-footer text-center">    
                                            <input style="color: #fff" type="submit" class="mb-2 mr-2 btn-hover-shine btn btn-shadow btn-focus btn-block" value="UPDATE PASSWORD">
                                        </div>
                                      
                                    </form>
                                    
                                
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.mini-card mb3 card -->
                        </div>
                        <!--/.col (right) -->
        
                    </div>
                    <!-- /.row -->
                </div>
            </div>


        </div>
    </div>
</div>

@endsection