@extends('layouts.auth.master')

@section('name')
    Password Reset
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <x-auth-logo />
                        </div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{route('password.email')}}">
                                @csrf

                                <h4>Password Reset Request</h4>
                                <p class="txt-info">Enter your email to receive password reset link.</p>
                                <div class="form-group">
                                    <x-error.message />

                                    <label for="email" class="col-form-label">Email Address</label>
                                    <div>
                                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="example@test.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <x-error.form-input :inputName="$error = 'email'" />
                                    </div>
                                </div>

                                <div class="text-end mt-5">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Send Password Reset Link</button>
                                </div>

                            </form>

                            <p class="mt-2 py-0 mb-0 text-end"><a href="{{ route('login') }}"> Back to login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
