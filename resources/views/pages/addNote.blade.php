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

	@if ( Session::has('ban_error'))

	<div class="alert alert-danger alert-dismissible fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		<strong>{{ Session::get('ban_error') }}</strong>
		<a href="#form" class="btn btn-primary" data-toggle="modal">Request to Admin</a>



		<div id="form" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Request to Admin</h4>
					</div>
					<div class="modal-body">
						@include('partials.ban-request')
					</div>
				</div>

			</div>
		</div>
	</div>
	@endif

	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<div class="inner-content">
		<form class="form-horizontal" role="form" method="post" data-parsley-validate id="form" action="{{ route('note.store') }}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group">
				<label class="control-label col-sm-2" for="title">Note Title:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="title" id="title" placeholder="Give a title to your note" data-parsley-required="true">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="title">Note Description:</label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="10" name="description" id="description" placeholder="Write about your note"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="image">Note Featured Image:</label>
				<div class="col-sm-10">
					<input type="file" class="form-control" name="image" id="image" placeholder="Upload an image for note's featured image" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="image">Note Category/Tags:</label>
				<div class="col-sm-4">
					<label for="tags">Select a category please</label>
					<select name="category_id" class="form-control" data-parsley-required="true">
						<option value="">Select a category please</option>
						@foreach ($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="col-sm-6">
					<label for="tags">Select at least one tag please</label>
					<select name="tags[]" class="select2-multi form-control" id="tags" multiple="multiple" data-parsley-required = "true">
						@foreach ($tags as $tag)
						<option value="{{ $tag->id }}">{{ $tag->name }}</option>
						@endforeach
					</select>
				</div>
				
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="image">Note status:</label>
				<div class="col-sm-4">
					<select name="status" class="form-control" data-parsley-required="true">
						<option value="1">Public</option>
						<option value="0">Private</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<a href="#advance" class="col-sm-offset-2 btn btn-default" data-toggle="collapse" data-target="#advance"><i class="fa fa-plus-circle"></i> Add Some Advance options if you want</a>
				<div class="col-sm-10"> </div>
			</div>

			<div class="collapse" id="advance">
				<div class="form-group">
					<label class="control-label col-sm-2" for="image">For Search Engines [Optional]:</label>

					<div class="col-sm-5">
						<label for="meta_keywords">Meta Keywords For Search Engine</label>
						<input type="text" class="form-control" name="meta_keywords" id="meta_keywords" placeholder="Add Some meta keywords for more sprecific" />
					</div>

					<div class="col-sm-5">
						<label for="meta_description">Meta Descriptions For Search Engine</label>
						<input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="Add Some meta Descriptions for more sprecific" />
					</div>
				</div>
			</div>
			


			
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-theme"><i class="fa fa-save"></i> Publish Note</button>
				</div>
			</div>
		</form>

	</div>
</div>
@endsection
@section('scripts')

<script type="text/javascript" src="{{ URL::to('js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('js/parsley.min.js') }}"></script>
<script type="text/javascript">

	//For TinyMce
	tinymce.init({
		selector:'#description' ,
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