@extends('admin.layouts.master')

@section('title')
Manage Users | Store My Notes
@endsection

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{URL::to('css/jquery.ui.autocomplete.css')}}" />
@endsection

@section('content')
<div class="panel panel-theme">
	<div class="panel-heading">
		<h3 class="panel-title pull-left">Manage Users</h3>
		{!! Form::text('search_text', null, array('placeholder' => 'Search User','class' => 'form-control pull-right','id'=>'search_text', 'style' =>'width:auto')) !!}
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<table class="table table-hover table-striped table-responsive">
			<thead>
				<tr>
					<th>#</th>
					<th>User Name</th>
					<th>User Statistics</th>
					<th>User Primary Email</th>
					<th>User Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@php
				$i = 1;
				@endphp
				@foreach ($users as $user)
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $user->name }}</td>
					<td>10 Star<br /> 20 Note Likes</td>
					<td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
					<td>
						@if ($user->is_active == 1)
						<span class="label label-primary">Active</span>

						@else
						<span class="label label-danger">Banned</span>
						@endif
					</td>
					<td>
						<a href="{{ route('user.single',  $user->username) }}" class="btn btn-default"><i class="fa fa-user"></i> View User</a>
						{!! Form::open(['route' => ['admin.user.changeActiveStatus', $user->id], 'method' => 'post', 'class' => 'form-inline' ]) !!}
						@if ($user->is_active == 1)
						{!! Form::submit('Ban', ['class' => 'btn btn-danger']) !!}
						@else
						{!! Form::submit('Active', ['class' => 'btn btn-success']) !!}
						@endif


						{!! Form::close() !!}
						<a  data-toggle="modal" href='#form-model' class="btn btn-info"><i class="fa fa-gift"></i> Gift</a>

						<div class="modal fade" id="form-model">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Gift Some Star</h4>
									</div>
									<div class="modal-body">
										{!! Form::open(['route' => 'index', 'class' => 'form-horizontal']) !!}

										<div class="form-group">
											{{ Form::label('gift_star', 'Gift some star to user', ['class' => 'control-label col-sm-2']) }}
											<div class="col-sm-10">
												{!! Form::text('gift_star', null, ['class' => 'form-control']) !!}
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('gift_star', 'Why want to give star', ['class' => 'control-label col-sm-2']) }}
											<div class="col-sm-10">
												{!! Form::textarea('gift_star_why', null, ['class' => 'form-control']) !!}
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												{!! Form::submit('Gift',  ['class' => 'btn btn-theme', 'rows' => '5']) !!}
											</div>
										</div>
										{!! Form::close() !!}
									</div>
								</div>
							</div>
						</div>


					</td>
				</tr>
				@php
				$i++;
				@endphp
				@endforeach


			</tbody>
		</table>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{URL::to('js/jquery.ui.min.js')}}"></script>
<script>
	$(document).ready(function() {
		src = "{{ route('admin.searchUser') }}";
		$("#search_text").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: src,
					dataType: "json",
					data: {
						name : request.name,
						id   : request.id
					},
					success: function(data) {
						response(data);

					}
				});
			},
			minLength: 1,

		});
	});
</script>
@endsection