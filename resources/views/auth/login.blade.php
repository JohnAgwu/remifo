@extends('layouts.auth.master')

@section('name')
    Sign In
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
                            <form class="theme-form" method="POST" action="{{route('login')}}">
                                @csrf
                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>
                                <div class="form-group">
                                    <x-error.message />

                                    <label for="email" class="col-form-label">Email Address</label>
                                    <div>
                                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="example@test.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <x-error.form-input :inputName="$error = 'email'" />
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
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="text-muted" for="remember">Remember password</label>
                                                                        </div><a class="link" href="{{ route('password.request') }}">Forgot password?</a>
                                        <div class="text-end mt-3">
                                            <button class="btn btn-primary btn-block w-100" type="submit">Sign In</button>
                                        </div>
                                    </div>
                            </form>

                            <p class="mt-4 mb-0">Don't have an account? <a href="{{route('register')}}">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
