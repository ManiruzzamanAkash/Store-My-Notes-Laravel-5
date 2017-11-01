@extends('layouts.master')

@section('content')
<div class="index-page">
	<div class="welcome-main">
		<div class="well">
			@if ( Session::has('success'))

			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<strong>{{ Session::get('success') }}</strong>
			</div>
			@endif
			
			@if (Auth::check())
			<h3>Hello <strong style="color: #32cb00;">{{ Auth::user()->name }}</strong></h3>
			@else
			<h3>Hello Guest !!! Welcome to Store My Notes</h3>
			<h4>To get all of the features of Store My Notes, Just create an account and make your private note, public note and so on...
			</h4>

			<a href="{{ route('register') }}" class="btn btn-theme btn-lg">Create Account</a>
			@endif
		</div>
	</div>

	<div class="inner-content">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6">
				<div class="well feature text-center">
					<img  src="{{ URL::to('images/notes.png') }}" class="img img-responsive pull-left" />
					<div class="texts text-right">
						<span class="header1 text-right">Our Features</span><br /><br />
						<span class="header2 text-right">
							<i class="fa fa-plus"></i>
							Store your notes publicly
						</span><br /><br />
						<span class="header3 text-right">
							<i class="fa fa-plus-square"></i>
							Store your notes privately

						</span><br /><br /><br />

						<span class="header4 text-right">
							<a href="{{ route('all_notes') }}">
								<i class="fa fa-sticky-note"></i>
								See Notes
							</a>
						</span>



					</div>

				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-6">
				<div class="well feature text-center">
					<img  src="{{ URL::to('images/user.png') }}" class="img img-responsive pull-left" />
					<div class="texts text-right">
						<span class="header1 text-right">Manage Account</span><br /><br />
						<span class="header2 text-right">
							<i class="fa fa-plus"></i>
							Public User Account
						</span><br /><br />
						<span class="header3 text-right">
							<i class="fa fa-plus-square"></i>
							Make a Hirable Link</span>
							<br />
							<br />
							<br />
							
							@if (Auth::check())
							<span class="header4 text-right">
								<a href="{{ route('user.single', Auth::user()->username) }}">
									<i class="fa fa-user"></i>
									Go to your Profile
								</a>
							</span>
							@endif

						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
	@endsection