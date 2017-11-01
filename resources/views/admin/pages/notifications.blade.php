@extends('admin.layouts.master')

@section('title')
Notifications | Admin Panel | Store My Notes
@endsection

@section('content')
<div class="panel panel-theme">
	<div class="panel-heading">
		<h3 class="panel-title">All Notifications</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover table-striped table-responsive">
			<thead>
				<tr>
					<th>#</th>
					<th>Subject</th>
					<th>Email</th>
					<th>Description</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@php $i = 1; @endphp
				@foreach ($notifications as $notification)
				<tr>
					<td>{{$i}}</td>
					<td>{{$notification->subject}}</td>
					<td>{{$notification->email}}</td>
					<td>{!! substr(strip_tags($notification->description), 0, 200) !!}...</td>
					<td>
					@if ($notification->is_seen == 1)
						<span class="btn btn-default">Seen</span>
					@else
						<span class="btn btn-danger">Unseen</span>
					@endif
						
					</td>
					<td>

						<a href="{{ route('admin.notification.single', $notification->id) }}" class="btn btn-theme">View</a>

					</td>
				</tr>
				@php $i++; @endphp
				@endforeach

			</tbody>
		</table>
		<div class="text-center">
			{{ $notifications->links() }}
		</div>
	</div>
</div>
@endsection