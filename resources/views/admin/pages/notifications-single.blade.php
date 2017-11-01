@extends('admin.layouts.master')

@section('title')
Notifications | Admin Panel | Store My Notes
@endsection

@section('content')
<div class="panel panel-theme">
	<div class="panel-heading">
		<h3 class="panel-title">Notification</h3>
	</div>
	<div class="panel-body">
		<h3><strong>Notification from:</strong> {{ $notification->email }}</h3>
		<h4><strong>Notification subject:</strong> {{ $notification->subject }}</h4><hr />
		<div>
			<strong>Notification About:</strong><br /> 
			{!! $notification->subject !!}
		</div>
	</div>
	<div class="panel-footer">

		@if ($notification->note_id)

		<div class="panel panel-theme">
			<div class="panel-heading">
				<h3 class="panel-title">Notification of Note - {{$notification->note->title}}</h3>
			</div>
			<div class="panel-body">
				<a href="#note-more" data-toggle="collapse" class="btn btn-primary">See The Note in Live <i class="fa fa-angle-double-down"></i></a>
				<div id="note-more" class="collapse embed-responsive embed-responsive-16by9" >
					<iframe src="{{ route('note.single', $notification->note->slug) }}" class="embed-responsive-item" width="100%" height="1000px" ></iframe>
				</div>

			</div>
			<div class="panel-footer">
				<h4>Wanna take some action for this note..?</h4>
				<a href="{{ route('admin.manage_notes') }}" class="btn btn-success">Go to manage Notes Page</a>
			</div>
		</div>
		@endif
		
		@if ($user)
		{{-- <a href="#user" class="btn btn-theme" data-toggle="collapse"> See More About this user</a> --}}
		<div id="user">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Notification from - {{ $user->name }}</h3>
				</div>
				<div class="panel-body">
					<p><strong>User Email: </strong> {{ $user->email }}</p>
					<p><strong>UserName: </strong><a href="{{ route('user.single', $user->username) }}"> {{ $user->username }}</a></p>
					<p>
						<strong>User Status: </strong>
						@if ($user->is_active == 1)
						<span class="btn btn-info">Active</span>
						@else
						<span class="btn btn-danger">Banned</span>
						@endif
					</p>
					<p><strong>User Email:</strong>{{ $user->email }}</p>
					<a href="#userFull" class="btn btn-primary" data-toggle="collapse">See More</a>
					<div id="userFull" class="collapse" style="margin-top: 20px">
						<iframe src="{{ route('user.single', $user->username) }}" class="embed-responsive-item" width="100%" height="1000px"></iframe>
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="alert alert-danger">
			Sorry !!!<br />
			There is no user for this Email
		</div>
		@endif
	</div>
</div>
@endsection