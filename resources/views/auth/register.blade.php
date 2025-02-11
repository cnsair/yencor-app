@extends('layouts.app-auth')

@section('content')

    <div class="div-padding p-t-0 signup-div user-access-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <h1 class="h3 mb-3 fw-normal">Please Register</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="account-access sign-up">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#rider" class="active" aria-controls="rider" role="tab" data-toggle="tab">
                                    Take to Ride
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#driver" aria-controls="driver" role="tab" data-toggle="tab">
                                    Apply to Drive
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Rider Registration -->
                            <div role="tabpanel" class="tab-pane active" id="rider">

                                <x-validation-errors class="mb-4" />

                                <form method="POST" action="{{ route('register') }}" class="user-access-form"
                                    onsubmit="return registerF(this);">
                                    @csrf

                                    <div class="row">
                                        <input type="number" class="form-control" name="role" 
                                            id="role" hidden value="0" required>

                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="firstname"
                                                    id="firstName" placeholder="First Name" :value="old('firstname')" required autofocus autocomplete="name">
                                                <label for="firstName">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="lastname"
                                                        id="lastName" placeholder="Last Name" :value="old('lastname')" required autocomplete="name">
                                                <label for="lastName">Last Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="phone" id="phone"
                                            placeholder="Phone Number (Optional)" :value="old('phone')">
                                        <label for="phone">Phone Number</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email Address" :value="old('email')" required autocomplete="email">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="password"
                                            id="password" placeholder="Password">
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="password.confirmation"
                                            id="passwordConfirm" placeholder="Confirm Password">
                                        <label for="passwordConfirm">Confirm Password</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="agree" name="terms">
                                        <label for="agree">
                                            I agree to the
                                            <a href="https://acrobat.adobe.com/id/urn:aaid:sc:EU:16df4fd1-c621-4634-b681-829a890b92ee" target="_blank" rel="noopener noreferrer">
                                                Terms and Conditions
                                            </a>
                                            and
                                            <a href="https://acrobat.adobe.com/id/urn:aaid:sc:EU:96c179ba-aeab-4b35-9a88-389da04e1e40" target="_blank" rel="noopener noreferrer">
                                                Privacy Policy
                                            </a>.
                                        </label>
                                    </div>
                                    <button type="submit" name="register" class="w-100 btn btn-lg btn-primary">Register</button>
                                </form>
                                <p class="acclink">Already have an account?
                                    <a href="{{ route('login') }}"> <b>Sign in</b>
                                        <i class="icofont">double_right</i>
                                    </a>
                                </p>
                            </div>

                            <!-- Driver Registration -->
                            <div role="tabpanel" class="tab-pane" id="driver">

                                <x-validation-errors class="mb-4" />

                                <form method="POST" action="{{ route('register') }}" class="user-access-form"
                                    onsubmit="return registerF(this);">
                                    @csrf

                                    <div class="row">
                                        <input type="number" class="form-control" name="role"
                                            id="role" hidden value="1" required>

                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="firstname"
                                                    id="firstName2" placeholder="First Name" :value="old('firstname')" required autofocus autocomplete="name">
                                                <label for="firstName2">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="lastname"
                                                    id="lastName2" placeholder="Last Name" :value="old('lastname')" required autocomplete="name">
                                                <label for="lastName2">Last Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" name="phone" id="number2"
                                            placeholder="Phone Number" required :value="old('phone')">
                                        <label for="number2">Phone Number</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="email" class="form-control" name="email" id="email2"
                                            placeholder="Email Address" :value="old('email')" required autocomplete="email">
                                        <label for="email2">Email</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="password"
                                            id="password2" placeholder="Password" required>
                                        <label for="password2">Password</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="password.confirmation"
                                            id="passwordConfirm2" placeholder="Confirm Password" required>
                                        <label for="passwordConfirm2">Confirm Password</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="agree2" name="terms">
                                        <label for="agree2">
                                            I agree to the
                                            <a href="https://acrobat.adobe.com/id/urn:aaid:sc:EU:16df4fd1-c621-4634-b681-829a890b92ee" target="_blank" rel="noopener noreferrer">
                                                Terms and Conditions
                                            </a>
                                            and
                                            <a href="https://acrobat.adobe.com/id/urn:aaid:sc:EU:96c179ba-aeab-4b35-9a88-389da04e1e40" target="_blank" rel="noopener noreferrer">
                                                Privacy Policy
                                            </a>.
                                        </label>
                                    </div>
                                    <button type="submit" name="register" class="w-100 btn btn-lg btn-primary">Register</button>
                                </form>

                                <p class="acclink">Already have an account?
                                    <a href="{{ route('login') }}"><b>Sign in</b>
                                        <i class="icofont">double_right</i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection