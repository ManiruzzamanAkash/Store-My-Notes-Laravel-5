@extends('layouts.master')
@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ URL::to('css/select2.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::to('css/parsley.css') }}" />
<script type="text/javascript" src="{{ URL::to('js/tinymce/tinymce.min.js') }}"></script>
@endsection
@section('content')
<ol class="breadcrumb" style="margin-bottom: 5px;">
	<li><a href="./">Home</a></li>
	<li class="active">Add Note</li>
</ol>

<div class="add-note-page">
	<div class="inner-content">
		{{-- <form class="form-horizontal" role="form" method="post" data-parsley-validate id="form" action="{{ route('note.update', $note->slug) }}" enctype="multipart/form-data"> --}}

		{!! Form::model($note, ['route' => ['note.update', $note->id], 'method'=>'PUT', 'files'=>true, 'class' => 'form-horizontal']) !!}

		@if (count($errors) > 0)
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
			<p>{{ $error }}</p>
			@endforeach
		</div>
		@endif

		<div class="form-group">
			{{ Form::label('title', 'Note Title', ['class' => 'control-label col-sm-2']) }}
			<div class="col-sm-10">
				{{ Form::text('title', null, ['class' => 'form-control', 'required' => true]) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Note description', ['class' => 'control-label col-sm-2']) }}
			<div class="col-sm-10">
				{{ Form::textarea('description', null, ['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('oldImage', 'Note Previous Image', ['class' => 'control-label col-sm-2']) }}
			<div class="col-sm-10">
				<a href="{{ URL::to("images/note_images/$note->image") }}" target="blank"><img src="{{ URL::to("images/note_images/$note->image") }}" class="img img-responsive img-thumbnail" style="width: 200px" /></a>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('image', 'Note New Featured Image', ['class' => 'control-label col-sm-2']) }}
			<div class="col-sm-10">
				{{ Form::file('image',['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('category_id', 'Note Category/Tags', ['class' => 'control-label col-sm-2']) }}
			<div class="col-sm-4">
				{{ Form::label('category_id', 'Select a category for your note') }}

				{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

			</div>
			<div class="col-sm-5">
				{{ Form::label('tags[]', 'Select at least one tag please') }}
				{{ Form::select('tags[]', $tags, null, ['class'=> 'form-control select2-multi', 'data-parsley-required'=>'true', 'multiple'=>'multiple']) }}
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="status">Note status:</label>
			<div class="col-sm-10">
				<select name="status" class="form-control" data-parsley-required="true">

					@if ($note->status == 1)
					<option value="1" selected="true">Public</option>
					<option value="0">Private</option>
					@else
					<option value="1">Public</option>
					<option value="0" selected="true">Private</option>
					@endif

					
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="image">For Search Engines [Optional]:</label>

			<div class="col-sm-5">
				{{ Form::label('meta_keywords', 'Meta Keywords For Search Engine')}}
				{{ Form::text('meta_keywords', null, ['class' => 'form-control'])}}
			</div>

			<div class="col-sm-5">
				{{ Form::label('meta_description', 'Meta Descriptions For Search Engine') }}
				{{ Form::text('meta_description', null, ['class' => 'form-control']) }}
			</div>
		</div>




		<div class="form-group"> 
			<div class="col-sm-offset-2 col-sm-10">
				{{-- <button type="submit" class="btn btn-theme"><i class="fa fa-save"></i> Publish Note</button> --}}
				{{ Form::submit('Update Note', ['class' => 'btn btn-theme']) }}
			</div>
		</div>

		{!! Form::close() !!}

	</div>
</div>
@endsection
@section('scripts')

<script type="text/javascript" src="{{ URL::to('js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('js/parsley.min.js') }}"></script>
<script type="text/javascript">

	//For TinyMce
	tinymce.init({
		selector:'textarea' ,
		// plugins:'link code image imagetools',
		plugins:['autolink lists link image preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime table'],  
		
		toolbar1: ' styleselect | bold italic underline hr link image | bullist numlist | table insert searchreplace undo redo | fontselect  preview code ',
		image_advtab: true, 
		menubar:false
	});

	//For select2
	$('.select2-multi').select2();

	//Start Parsely
	$('#form').parsley();
</script>

@endsection