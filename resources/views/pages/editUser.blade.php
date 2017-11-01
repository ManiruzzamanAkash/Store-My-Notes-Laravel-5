@extends('layouts.master')

@section('title')
Edit User - {{ $user->name}} Information | Store My Notes
@endsection

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ URL::to('css/parsley.css') }}" />
@endsection


@section('content')
{!! Form::model($user, ['route' => ['user.update', $user->id], 'method'=>'PUT', 'files'=>true, 'class' => 'form-horizontal', 'data-parsley-validate' => true]) !!}

<h3 class="text-theme">Update Your Information</h3>

@if (count($errors) > 0)
<div class="col-sm-offset-2 alert alert-danger">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	@foreach ($errors->all() as $error)
	<p>{{ $error }}</p>
	@endforeach
</div>
@endif

<div class="form-group">
	{{ Form::label('name', 'Name', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		{{ Form::text('name', null, ['class' => 'form-control', 'required' => true]) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('email', 'Primary Email Address (Not Changable)', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		<p class="form-control-static">{{ $user->email }}</p>
	</div>
</div>

<div class="form-group">
	{{ Form::label('username', 'UserName', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		{{ Form::text('username', null, ['class' => 'form-control', 'required' => true]) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('oldImage', 'Previous Image', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		@if ($user->image == NULL)
		<img src="{{ "https://www.gravatar.com/avatar/".md5(strtolower(trim($user->email)))."?s=50&d=identicon" }}" class="img img-responsive img-circle" style="height: 220px;width: 220px;" /><br />
		<p class="text-danger">No image is uploaded yet.. This is your gravator image. To change gravator image go to <a href="https://www.gravatar.com">Gravator Main Site</a></p>
		@else
		<a href="{{ URL::to("images/users/$user->image") }}" target="blank"><img src="{{ URL::to("images/users/$user->image") }}" class="img img-responsive img-thumbnail" style="width: 200px" /></a>
		@endif
		
	</div>
</div>

<div class="form-group">
	{{ Form::label('image', 'Set New Image', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		{{ Form::file('image',['class' => 'form-control']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('country_id', 'User Country', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-4">

		{{ Form::select('country_id', $countries, null, ['class' => 'form-control']) }}

	</div>
</div>


<div class="form-group">
	{{ Form::label('birthdate', 'Change Birthdate', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		{{-- Form::date('name', \Carbon\Carbon::now()); --}}
		{{ Form::date('birthdate', null, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('bio_title', 'Profession Title', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		{{ Form::text('bio_title', null, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('bio_description', 'Profession about', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		{{ Form::textarea('bio_description', null, ['class' => 'form-control', 'rows' => 5]) }}
	</div>
</div>


<div class="form-group">
	{{ Form::label('website', 'Website', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		{{ Form::url('website', null, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('organization', 'Current Work Place', ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
		{{ Form::text('organization', null, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-group"> 
	<div class="col-sm-offset-2 col-sm-10">
		{{-- <button type="submit" class="btn btn-theme"><i class="fa fa-save"></i> Publish Note</button> --}}
		{{ Form::submit('Update User Information', ['class' => 'btn btn-theme']) }}
	</div>
</div>

{!! Form::close() !!}
@endsection

@section('scripts')

<script type="text/javascript" src="{{ URL::to('js/parsley.min.js') }}"></script>
<script type="text/javascript">
	$('#form').parsley();
</script>

@endsection