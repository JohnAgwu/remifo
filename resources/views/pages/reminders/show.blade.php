@extends('layouts.simple.master')

@section('title', 'Default')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Message</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Message</li>
@endsection

@section('content')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 mx-1 mx-sm-0">
                                <h5>Message</h5>
                                <p class="mb-1">Showing details for <span class="txt-info f-16">{{ $reminder->name }}</span> </p>
                                <p><a href="#" class="txt-warning">Edit</a> &nbsp;&nbsp;<a href="{{route('/')}}">Go back.</a> </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

@endsection

@section('script')
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{asset('js/actions/delete-prompt.js')}}"></script>
@endsection
