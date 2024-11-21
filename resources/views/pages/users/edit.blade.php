@extends('layouts.simple.master')

@section('phone', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-phone')
    <h3>Edit User</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit User</h5>
                        <p>Edit <span class="pt-2 txt-info f-16">{{ $user->email }}</span> name and phone number. <a href="{{ route('/') }}">Go back</a></p>
                    </div>
                    <div class="card-body">
                        <x-error.message />

                        <!-- Form Body Starts -->
                        <form method="POST" action="{{ route('users.update') }}" class="needs-validation">
                            @csrf
                            <div class="mx-md-5">
                                <div class="row g-1 mb-4">
                                    <div class="col-md-3">
                                        <label class="form-label" for="name">Name</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name') ?? $user->name }}" @if($user->name_changed) readonly @else required autofocus @endif>
                                        <x-error.form-input :inputName="$error = 'name'" />
                                    </div>
                                </div>

                                <div class="row g-1 mt-5">
                                    <div class="col-md-3">
                                        <label class="form-label" for="phone">Phone</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" type="text" value="{{ old('phone') ?? $user->phone }}" @if($user->phone_changed) readonly @else required @endif>
                                        <x-error.form-input :inputName="$error = 'phone'" />
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-5">

                            <div class="m-3 text-center">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        <!-- Form Body Ends -->

                        <div class="mt-5">
                            <span class="txt-danger"> * </span><strong>Note</strong>
                            <br/>
                            <em class="txt-info">
                                Your Name and Phone number can only be changed once. Hence, ensure to enter the correct name before submitting the form.
                            </em>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
@endsection
