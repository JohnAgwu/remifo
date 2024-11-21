@extends('layouts.simple.master')

@section('title', 'Default')

@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

@section('content')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row project-cards">

            <!-- Nav links header list starts-->
            <div class="col-md-12 project-list">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                <li class="nav-item">
                                    <a href="{{route('/')}}" @class(['nav-link', 'txt-primary' => !request()->has('status')])>
                                        <i data-feather="target"></i>All
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('/', ['status' => 'pending'])}}" @class(['nav-link', 'txt-primary' => request('status') == 'pending']) >
                                        <i data-feather="info"></i>Pending
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('/', ['status' => 'completed'])}}"  @class(['nav-link', 'txt-primary' => request('status') == 'completed'])>
                                        <i data-feather="check-circle"></i>Done
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0 me-0"></div><a class="btn btn-primary" href="{{route('option')}}"> <i data-feather="plus-square"> </i>Add New Message</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nav links header list ends-->

            <!-- Reminders grid list starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                <div class="row">
                                    @if($reminders->count() == 0)
                                        @if(!request()->has('status'))
                                            <p class="text-center pb-3">No Message has been added yet.</p>
                                        @elseif(request('status') == 'pending')
                                            <p class="text-center pb-3">No Message is currently pending.</p>
                                        @else
                                            <p class="text-center pb-3">No Message has been completed yet.</p>
                                        @endif

                                    @else
                                        @foreach($reminders as $reminder)
                                            <div class="col-xxl-4 col-lg-6">
                                                <div class="project-box">
                                                    <span class="badge badge-{{$reminder->is_done ? 'success' : 'primary'}}">
                                                        {{$reminder->is_done ? 'Done' : 'Pending'}}
                                                    </span>
                                                    <h6 class="pt-2">{{ $reminder->name }}</h6>
                                                    <div class="media">
{{--                                                        <img class="img-20 me-1 rounded-circle" src="../assets/images/user/3.jpg" alt="" data-original-title="" title="">--}}
                                                        <div class="media-body">
{{--                                                            <p><em>{{ str_replace('"','', $reminder->email ?? $reminder->phone )}}</em></p>--}}
                                                            <p><em>{{ $reminder->email ?? str_replace('"', '', $reminder->phone) }}</em></p>
                                                        </div>
                                                    </div>
                                                    <p class="f-12 f-w-400 mb-0 txt-primary"><strong>{{$reminder->subject}}</strong></p>
                                                    <p>{{$reminder->body}}</p>
                                                    <div class="row details">
                                                        <div class="col-6"><span>Start Date </span></div>
                                                        <div class="col-6 txt-primary">{{$reminder->start_date->format('d/m/Y H:i')}} </div>
                                                        @if(!is_null($reminder->cron) && $reminder->interval != 'QUARTERLY')
                                                            <div class="col-6"><span>Interval </span></div>
                                                            <div class="col-6 txt-info">{{$reminder->cron}} </div>
                                                        @else
                                                            <div class="col-6"><span>Interval </span></div>
                                                            <div class="col-6 txt-info">{{$reminder->interval}} </div>
                                                            <div class="col-6"><span>Frequency </span></div>
                                                            <div class="col-6 txt-info">{{$reminder->frequency ?? '----'}} </div>
                                                        @endif

                                                        <div class="col-6"><span>Message Sent </span></div>
                                                        <div class="col-6 txt-success">{{$reminder->total_sent}} </div>
                                                    </div>
                                                    <div class="d-flex mt-3 justify-content-between">
                                                        @if(!$reminder->is_done)
                                                            <div class="d-flex gap-3">
                                                                @can('update', $reminder)
                                                                    <form action="{{ route('reminders.toggle', $reminder) }}" method="post">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button class="btn p-0 f-16 {{ $reminder->is_done ? 'text-success' : 'txt-primary' }}"
                                                                                title="{{ $reminder->is_done ? 'COMPLETED' : 'STOP REMINDER' }}">
                                                                            <i class="fa {{ $reminder->is_done ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                                                        </button>
                                                                    </form>

                                                                    <form action="{{ route('reminders.destroy', $reminder) }}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn p-0 text-danger f-16" title="Delete">
                                                                            <i class="fa fa-trash-o"></i>
                                                                        </button>
                                                                    </form>
                                                                @endcan
                                                            </div>
                                                        @endif

                                                        @if(isAdmin())
                                                            <div><em class="f-12 text-secondary">By {{ $reminder->user->name }}</em></div>
                                                        @endif

                                                       @if(!$reminder->is_done)
                                                            <div class="p-0 ">
                                                                <a class="btn btn-primary" href="{{route('reminders.edit', $reminder)}}"> Edit</a>
                                                            </div>
                                                       @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    {{ $reminders->appends($data)->links() }}
                </div>
            </div>
            <!-- Reminders grid list ends-->

        </div>
    </div>
    <!-- Container-fluid Ends-->

@endsection

@section('script')
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{asset('js/actions/delete-prompt.js')}}"></script>
@endsection
