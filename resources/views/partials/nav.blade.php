
<div class="header-main">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="./"><img src="{{ URL::to('images/logo.png') }}" alt="Store My Notes" class="img logo-image" ></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li class="{{ Request::is('/') ? "active" : "" }}">
						<a href="{{ route('index') }}">Home</a>
					</li>
					<li class="{{ Request::is('add-note') ? "active" : "" }}">
						<a href="{{ route('add_note') }}">Create Note</a>
					</li>
					<li class="{{ Request::is('all-notes') ? "active" : "" }}">
						<a href="{{ route('all_notes') }}">All Notes</a>
					</li>
					<li class="{{ Request::is('manage-notes') ? "active" : "" }}">
						<a href="{{ route('manage_all_notes') }}">Manage Notes</a>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li>
						{{-- {!! Form::open(['route' => 'note.search', 'class' => 'navbar-form', 'role' => 'search']) !!}
							{{ Form::text('searchText', null, ['class' => 'form-control', 'placeholder' => 'Search']) }}
							{!! Form::close() !!} --}}

							<form action="{{ route('note.search') }}" method="get" class="navbar-form" role="search">
								{{-- {{csrf_field()}} --}}
								@php
								if (isset($search)) {
									$s = $search;
								}else {
									$s = "";
								}
								@endphp
								<input type="text" name="search" placeholder="Search" class="form-control" value="{{$s}}" />
							</form>


						</li>
						@if (Auth::check())
						<li class="dropdown {{ Request::is('posts') ? "active" : "" || Request::is('posts/create') ? "active" : ""}}">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user()->name }}
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="{{ route('user.single', Auth::user()->username) }}">Profile</a></li> 
									<li>
										<a href="{{ route('user.logout') }}"
										onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
										Logout
									</a>

									<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li> 
							</ul>
						</li>
						@else
						<li class="{{ Request::is('login') ? "active" : "" }}"><a href="{{ route('login') }}">Login</a></li>
						<li class="{{ Request::is('register') ? "active" : "" }}"><a href="{{ route('register') }}">Create Account</a></li>
						@endif

					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
	</div> <!-- End Header Main -->
