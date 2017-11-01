{!! Form::open(['route'=> 'user.request.removeBan', 'data-parsley-validate' => true, 'class' => 'form-horizontal']) !!}
<div class="form-group">
	{{ Form::label('email', 'Your Email', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		@if (Auth::check())
		@php $request_email = Auth::user()->email; @endphp
		@else
		@php $request_email = ""; @endphp
		@endif
		{{ Form::text('email', $request_email, ['class' => 'form-control', 'required' => true]) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('description', 'Request Description', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		{{ Form::textarea('description', null, ['rows' => 5, 'class' => 'form-control', 'minlength' => 10, 'placeholder' => 'Enter the description why you are requesting...']) }}
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		{{ Form::submit('Send Request', ['class' => 'btn btn-primary']) }}
	</div>
</div>
{!! Form::close() !!}