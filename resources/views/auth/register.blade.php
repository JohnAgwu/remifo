@extends('layouts.auth.master')
@section('name')
    Sign Up
@endsection
@section('content')
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <x-auth-logo />
                        </div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{route('register')}}">
                                @csrf
                                <h4>Sign up for an account</h4>
                                <div class="form-group">
                                    <x-error.message />

                                    <label for="email" class="col-form-label">Full Name</label>
                                    <div>
                                        <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <x-error.form-input :inputName="$error = 'name'" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <x-error.message />

                                    <label for="email" class="col-form-label">Email Address</label>
                                    <div>
                                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="example@test.com" value="{{ old('email') }}" required autocomplete="email">
                                        <x-error.form-input :inputName="$error = 'email'" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <x-error.message />

                                    <label for="phone" class="col-form-label">Phone Number</label>
                                    <div>
                                        <input id="phone" class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="08123456789" value="{{ old('phone') }}" required autocomplete="phone">
                                        <x-error.form-input :inputName="$error = 'phone'" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password</label>
                                    <div>
                                        <div class="form-input position-relative">
                                            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required placeholder="*********">
                                            <div class="show-hide"><span class="show"></span></div>
                                        </div>
                                        <x-error.form-input :inputName="$error = 'password'" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confrim" class="col-form-label">Confirm Password</label>
                                    <div>
                                        <div class="form-input position-relative">
                                            <input id="password-confrim" class="form-control @error('password-confrimation') is-invalid @enderror" type="password" name="password_confirmation" required placeholder="*********">
                                        </div>
                                        <x-error.form-input :inputName="$error = 'password_confirmation'" />
                                    </div>
                                </div>

                                <div class="form-group mb-0">

                                    <div class="text-end mt-5">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Sign Up</button>
                                    </div>
                                </div>
                            </form>

                            <p class="mt-4 mb-0">Already have an account? <a href="{{route('login')}}">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
