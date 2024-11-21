@extends('layouts.simple.master')

@section('title', 'Default')

@section('css')
@endsection

@section('style')
{{--    <link rel="stylesheet" href="{{ asset('css/pages/users.css') }}">--}}
@endsection

@section('breadcrumb-title')
    <h3>Manage Users</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Manage Users</li>
@endsection

@section('content')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Users</h5>
                        <p>List of all Users registered on the platform</p>
                    </div>

                    <!-- Agents Table Starts -->
                    <div class="table-responsive">
                        <div class="mx-2">
                            <x-error.message />
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Verified</th>
                                <th scope="col"><i class="fa fa-cogs"></i></th>
                            </tr>
                            </thead>

                            <tbody>
                                @if($users->count() == 0)
                                    <tr>
                                        <td colspan="5" class="text-center">No User has been added yet.</td>
                                    </tr>
                                @else
                                    @foreach($users as $usr)
                                        <tr>
                                            <td>{{ $usr->name}}</td>
                                            <td>{{ $usr->email }}</td>
                                            <td>{{ $usr->phone }}</td>
                                            <td><span class="text-{{is_null($usr->email_verified_at) ? 'warning' : 'info'}}"></span>{{ is_null($usr->email_verified_at) ? 'Not Yet' : 'Yes' }}</td>
                                                <td>
{{--                                                    <a href="{{ route('users.edit', [$usr->id])}}" class="f-16 action-btn px-1" title="Edit"><i class="fa fa-edit"></i></a>--}}
                                                    <a id="delete" href="{{ route('users.delete', [$usr->id]) }}" class="action-btn text-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <!-- Agents Table Ends -->

                        <div class="m-3">
                            {{ $users->links() }}
                        </div>

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
