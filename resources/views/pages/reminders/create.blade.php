@extends('layouts.simple.master')

@section('subject', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-subject')
    <h3>Add Message</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Add Message</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Message</h5>
                        <p><a href="{{ route('/') }}">Go back</a></p>
                    </div>
                    <div class="card-body">
                        <x-error.message />

                        <!-- Form Body Starts -->
                        <form method="POST" action="{{ route('reminders.store') }}" class="needs-validation">
                            @csrf

                            <div class="row g-1 mb-4">
                                <div class="col-md-12">
                                    <label class="form-label" for="name">Name <span class="text-danger"> * </span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Individual or Group Name" required>
                                    <x-error.form-input :inputName="$error = 'name'" />
                                </div>
                            </div>

                            @if($option == 'email')
                                <div class="row g-1 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" for="email">Email <span class="text-danger"> * </span></label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="text" value="{{ old('email') }}" placeholder="Recipient's email E.g. example@test.com, johndoe@gmail.com" required autofocus>
                                        <x-error.form-input :inputName="$error = 'email'" />
                                    </div>
                                </div>
                            @endif

                            @if($option == 'sms')
                                <div class="row g-1 mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" type="text" value="{{ old('phone') }}" placeholder="Comma seperated if inputting multiple numbers Eg. 08107042127, +2348183736452">
                                        <x-error.form-input :inputName="$error = 'phone'" />
                                    </div>
                                </div>
                            @endif

                            <div class="row g-1 mb-4">
                                <div class="col-md-12">
                                    <label class="form-label" for="subject">Subject <span class="text-danger"> * </span></label>
                                    <input class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" type="text" value="{{ old('subject') }}" placeholder="Add message subject" required>
                                    <x-error.form-input :inputName="$error = 'subject'" />
                                </div>
                            </div>

                            <div class="row g-1 mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="body">Message Body <span class="text-danger"> * </span></label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" value="{{ old('body') }}" maxlength="{{$option == 'sms'? '140' : ''}}"  rows="5" placeholder="{{$option == 'sms'? 'Message content should not exceed 140 characters' : 'Add message content'}}"  required>{{old('body')}}</textarea>
                                    <x-error.form-input :inputName="$error = 'body'" />
                                </div>
                            </div>

{{--@error('cron')--}}
{{--                            {{ 'yes' }}--}}
{{--@enderror--}}
{{--                            <div class="txt-info m-4 d-inline-block animate-chk">--}}
{{--                                <div class="row">--}}
{{--                                    <label class="d-block" for="basicRadio">--}}
{{--                                        <input class="radio_animated" id="basicRadio" type="radio" name="interval_format" data-bs-original-title value="basic" checked> Basic Interval Format--}}
{{--                                    </label>--}}

{{--                                    <label class="d-block" for="cronRadio">--}}
{{--                                        <input class="radio_animated" id="cronRadio" type="radio" name="interval_format" data-bs-original-title value="cron" @if(old('interval_format') == 'cron') checked @endif> Crontab Interval Format--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row g-2 mb-4 cronFormat">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="mb-3 row g-3">--}}
{{--                                        <label class="form-label">Start Date <span class="text-danger"> * </span></label>--}}
{{--                                        <div class="col-12 mt-0">--}}
{{--                                            <div class="input-group">--}}
{{--                                                <input class="datepicker-here form-control digits" type="text" data-language="en" data-bs-original-title="" name="cron_start_date" value="{{ old('cron_start_date') }}" title="">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <x-error.form-input :inputName="$error = 'cron_start_date'" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <label class="form-label" for="cron"> Command/Interval <span class="text-danger"> * </span></label>--}}
{{--                                    <input class="form-control @error('cron') is-invalid @enderror" id="cron" name="cron" type="text" value="{{ old('cron') }}">--}}
{{--                                    <x-error.form-input :inputName="$error = 'cron'" />--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="row g-3 mb-4 basicFormat">
                                <div class="col-md-4">
                                    <div class="mb-3 row g-3">
                                        <label for="basic_start_date" class="form-label">Start Date <span class="text-danger"> * </span></label>
                                        <div class="col-12 mt-0">
                                            <div class="input-group">
                                                <input class="form-control form-control-danger" id="basic_start_date" type="datetime-local" name="basic_start_date" min="{{ now()->format('Y-m-d\TH:i') }}" value="{{ now()->format('Y-m-d\TH:i') }}"/>
                                            </div>
                                            {{--                                            <input class="datepicker-here form-control digits" type="text" name="date_filter" data-range="true" data-multiple-dates-separator=" - " data-language="en" value="{{ request('date_filter') ?? old('date_filter') }}" placeholder="mm/dd/yyyy">--}}
                                        </div>
                                        <x-error.form-input :inputName="$error = 'basic_start_date'" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="interval">Interval <span class="text-danger">  </span></label>
                                    <select id="interval" name="interval" class="form-select">
                                        <option value="DAILY" selected>DAILY</option>
                                        <option value="WEEKLY" @if(old('interval') == 'WEEKLY') selected @endif>WEEKLY</option>
                                        <option value="MONTHLY" @if(old('interval') == 'MONTHLY') selected @endif>MONTHLY</option>
                                        <option value="QUARTERLY" @if(old('interval') == 'QUARTERLY') selected @endif>QUARTERLY</option>
                                        <option value="YEARLY" @if(old('interval') == 'YEARLY') selected @endif>YEARLY</option>
                                    </select>
                                    <x-error.form-input :inputName="$error = 'interval'" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="frequency"> Frequency
                                        <small class="text-secondary">(Eg. 3 = 3 days or 3 weeks, etc)</small>
                                    </label>
                                    <input class="form-control @error('frequency') is-invalid @enderror" id="frequency" name="frequency" type="text" placeholder="Nọ of times based on the interval" value="{{ old('frequency') }}">
                                    <x-error.form-input :inputName="$error = 'frequency'" />
                                </div>
                            </div>
                            <hr class="mt-5">

                            <div class="m-3 text-center">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                        <!-- Form Body Ends -->

                        <div class="mt-5 shadow-sm py-3 px-3 text-secondary">
                            <strong><span class="text-danger"> * </span>Note</strong>
                            @if($option == 'sms')
                                <div><p>- Only <em>NIGERIAN CONTACTS</em> are allowed!</p></div>
                            @endif
                            <p>- For the <em>QUARTERLY interval</em>, select the date and time of the month you want on the start date input. <i>For example: Start date - 5th April 13:00, frequency - 2, interval - QUARTERLY; would be 5th April & 5th July </i></p>
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
    <script src="{{ asset('js/actions/interval-format-toggle.js') }}"></script>
@endsection
