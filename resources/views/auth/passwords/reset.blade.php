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
                            <form class="theme-form" method="POST" action="{{route('password.update')}}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <h4>Reset Password</h4>
                                <p class="txt-info">Enter your New password</p>
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
                                        </div>
                                        <x-error.form-input :inputName="$error = 'password'" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Confirm Password</label>
                                    <div>
                                        <div class="form-input position-relative">
                                            <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="*********">
                                        </div>
                                        <x-error.form-input :inputName="$error = 'password_confirmation'" />
                                    </div>
                                </div>

                                <div class="text-end mt-5">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Reset Password</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
