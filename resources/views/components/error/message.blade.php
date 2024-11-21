@if(session()->has('success'))
    <div id="alert" class="alert alert-success" role="alert">
        <small>{{session('success')}}</small>
        <button type="button" class="btn-close float-end" onclick="$('#alert').hide()" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('error'))
    <div id="alert" class="alert alert-danger" role="alert">
        <small>{{session('error')}}</small>
        <button type="button" class="btn-close float-end" onclick="$('#alert').hide()" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('message'))
    <div id="alert" class="alert alert-primary" role="alert">
        <small>{{session('message')}}</small>
        <button type="button" class="btn-close float-end" onclick="$('#alert').hide()" aria-label="Close"></button>
    </div>
@endif

@if (session('status'))
    <div id="alert" class="alert alert-success" role="alert">
        <small>{{ session('status') }}</small>
        <button type="button" class="btn-close float-end" onclick="$('#alert').hide()" aria-label="Close"></button>
    </div>
@endif


{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
