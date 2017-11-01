@extends('layouts.master')
@section('title', 'Contact | Store My Notes')

@section('content')
<div class="contact-page">
	@if ( Session::has('success') )

	<div class="alert alert-success alert-dismissible fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		<strong>{{ Session::get('success') }}</strong>
	</div>
	@endif

	<div class="inner-content">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6">
				<h2 class="text-theme">Contact Us</h2>
				<form class="form-horizontal" role="form" method="post" data-parsley-validate id="form" action="{{ route('note.store') }}" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="form-group">
						<label class="control-label col-sm-2" for="name">Name:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" data-parsley-required="true">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Email:</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="title" id="title" placeholder="Enter your email address" data-parsley-required="true">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="title">Message:</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="10" name="description" id="description" placeholder="Enter your message" style="max-width: 458px; max-height: 214px;"></textarea>
						</div>
					</div>

					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-theme"><i class="fa fa-send"></i> Send Contact</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-6">
				<h2 class="text-theme">Our Location</h2>
				<div class="location">
					
				</div>
			</div>
		</div>

	</div>
</div>
@endsection