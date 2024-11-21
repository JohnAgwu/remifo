<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
            <a href="{{route('/')}}" class="txt-dark f-26 f-w-500">
                <img class="img-fluid" src="{{ asset('assets/images/logo.png') }}" width="38" alt="Remifo logo">&nbsp;
                {{ env('APP_NAME') }}
            </a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper">
            <a href="{{route('/')}}">
                <img class="img-fluid" src="{{ asset('assets/images/logo.png') }}" width="40" alt="Remifo logo"> &nbsp;
                <span class="f-24 f-w-500">{{ env('APP_NAME') }}</span>
            </a>
        </div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
{{--						<a href="{{route('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>--}}
						<div class="mobile-back text-end"><a href="{{ route('/') }}"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></a></div>
					</li>

                    <!-- Dashboard -->
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{request()->route()->getName() == 'index' ? 'active' : '' }}" href="{{ route('/') }}">
                            <i data-feather="home" class="text-secondary txt-primary"></i><span class="lan-3">Dashboard</span>
                        </a>
                    </li>

{{--                    <li class="sidebar-list">--}}
{{--                        <a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/reminder' ? 'active' : '' }}" href="{{ route('reminders.create') }}">--}}
{{--                            <i data-feather="plus-square" class="text-success"></i><span class="lan-3">Add Reminder</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <!-- Users -->

                    <li>
                        <a class="sidebar-link sidebar-title {{request()->route()->getName() == 'users.edit' ? 'active' : '' }}" href="{{ route('users.edit')}}">
                            <i data-feather="user" class="text-primary"></i><span class="lan-3">Edit Profile</span>
                        </a>
                    </li>

                    @if(isAdmin())
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title {{request()->route()->getName() == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
                                <i data-feather="users" class="text-primary"></i><span class="lan-3">Users</span>
                            </a>
                        </li>
                    @endif
                </ul>

                <p class="mx-4" style="position: relative; bottom: 120px; list-style-type: none">
                    <a class="sidebar-link f-12 txt-info" href="{{ route('logout') }}">
                        <i class="icofont icofont-logout"></i><span class="lan-3 px-2 txt-info">Log out</span>
                    </a>
                </p>
            </div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
	</div>
</div>
