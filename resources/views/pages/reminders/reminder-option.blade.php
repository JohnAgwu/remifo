@extends('layouts.simple.master')

@section('name')
    Message Option
@endsection

@section('content')
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card" style="min-height: auto">
                    <div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{route('reminders.save-option')}}" id="option-form">
                                @csrf
                                <h4>Message Option</h4>
                                <p>Select a convenient option to receiving messages</p>
                                <div class="form-group">

                                    <label for="email" class="col-form-label">Email Address/SMS</label>
                                    <div class="form-group mb-0">
                                        <select name="option" class="form-control @error('option') is-invalid @enderror" id="option" required>
                                            <option value=""> --- </option>
                                            <option value="email" {{ old('option') == 'email' ? 'selected' : ''}} > Email </option>
                                            <option value="sms" {{ old('option') == 'sms' ? 'selected' : ''}} > SMS </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Add Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.getElementById('option').addEventListener('change', function (){
        var form = document.getElementById('option-form').
    })
</script>
