@extends('layouts.app-auth')

@section('content')

<div class="div-padding p-t-0 signin-div user-access-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <h1 class="h3 mb-3 fw-normal">Sign In</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-access sign-in">

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="rider">

                            <x-validation-errors class="mb-4" />

                            @if (session('error'))
                            <div class="alert alert-danger mb-4">
                                {{ session('error') }}
                            </div>
                            @endif

                            <form class="mb-4" method="POST" action="{{ route('login') }}"
                                onsubmit="return signInF(this);">
                                @csrf

                                <div class="form-floating mb-4">
                                    <input type="email" name="email" class="form-control" id="floatingInput"
                                        placeholder="name@yenkor.com" :value="old('email')" required
                                        autofocus autocomplete="username">
                                    <label for="floatingInput">Email address</label>
                                </div>

                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control" id="floatingPassword"
                                        placeholder="Password" required autocomplete="current-password">
                                    <label for="floatingPassword">Password</label>
                                </div>

                                <div class="checkbox mb-3 mt-3">
                                    <label for="remember">
                                        <input type="checkbox" value="remember-me" id="remember_me" name="remember">
                                        Remember me
                                    </label>
                                </div>

                                <button class="w-100 btn btn-lg btn-dark" name="signIn">
                                    Sign in
                                </button>
                            </form>

                            <p class="acclink">Don't have an account?
                                <a href="{{ route('register') }}">
                                    <b>Sign up</b>
                                </a>
                            </p>

                            <!-- <div class="externel-signup">
                                    <a href="#" class="btn-block facebook">
                                        <i class="fab fa-facebook-f"></i>
                                        Sign up with Facebook
                                    </a>
                                    <a href="#" class="btn-block google">
                                        <i class="fab fa-google"></i>
                                        Sign up with Google
                                    </a> &laquo; Coming soon
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection