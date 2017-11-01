@extends('layouts.master')

@section('content')
<ol class="breadcrumb" style="margin-bottom: 5px;">
	<li><a href="{{ url('/') }}">Home</a></li>
	<li class="active">All Notes</li>
</ol>

<div class="all-notes-page">
	
	<div class="inner-content">



		@if ($notes->count() <= 0)
		<div class="panel panel-theme" style="margin-bottom: 25%">
			<div class="panel-heading">
				<h3 class="panel-title">Hello {{ Auth::check() ? Auth::user()->name : 'Guest' }} </h3>
			</div>
			<div class="panel-body">
				@if (Auth::check())
				<h4 class="text-danger">There is no note yet in Store My Notes</h4>
				<a href="{{ route('add_note') }}" class="btn btn-theme btn-lg">Create A Note Now</a>
				@else
				<h4 class="text-danger">There is no note yet in Store My Notes</h4>
				<p>You are not also logged in as a user. Create an account in store my notes and make your own public and private note</p>
				<a href="{{ route('register') }}" class="btn btn-theme btn-lg">Create Account</a>
				@endif
				
			</div>
		</div>
		
		@else

{{-- 		<table class="table table-responsive table-hover table-striped">
			<thead>
				<tr>
					<th width="3%">No</th>
					<th width="10%">Note Title</th>
					<th width="20%">Note Description</th>
					<th width="5%">Author/Category/Tags</th>
					<th width="10%">Statistics</th>
				</tr>
			</thead>
			<tbody> --}}

				@php
				$i=1;
				@endphp
				<div class="row">
					@foreach ($notes as $note)
				{{-- <tr>
					<td>{{ $i }}</td>
					<td>{{ $note->title }}</td>
					<td>
						{!! substr(strip_tags($note->description), 0, 200) !!}...
					</td>
					<td>
						<a href="{{ route('user.single', $note->user->username) }}">{{ $note->user->name }}</a><br />
						<div class="text-sm">
							Category: {{ $note->category->name }} <br />
							Tags: @foreach ($note->tags as $tag)
							<span class="label label-default">{{ $tag->name }}</span>
							@endforeach
						</div>
						
					</td>
					<td>
						<i class="fa fa-eye"></i> {{ $note->statistic->total_visits }} Views | 
						<i class="fa fa-thumbs-up"></i> {{ $note->likes->count() }} Likes  <br />
						<a href="{{ route('note.single', $note->slug) }}" class="btn btn-sm btn-primary">View</a>
						<a href="#report-note" class="btn btn-sm btn-danger" data-toggle="modal">Report this note</a>

						<div class="modal fade" id="report-note">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Report For Note</h4>
									</div>
									<div class="modal-body">
										<p><strong>Note Title : </strong> {{ $note->title }}</p>
										@include('partials.note-report-request')
									</div>
								</div>
							</div>
						</div>



					</td>
				</tr> --}}




				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img src="images/note_images/{{ $note->image }}" alt="{{ $note->title }}" title="{{ $note->title }}">
						<div class="caption">
							<h3><a href="{{ route('note.single', $note->slug) }}">{{ $note->title }}</a></h3>
							<p>
								<strong><i class="fa fa-folder-open-o"></i>  Category </strong> {{ $note->category->name }}
								<strong><i class="fa fa-tags"></i>  Tags</strong> 
								@foreach ($note->tags as $tag)
								<span class="label label-default">{{ $tag->name }}</span>
								@endforeach | 
								<strong><i class="fa fa-user text-info"></i> Published By</strong> 
								<a href="/users/{{ $note->user->username }}"> 
									{{ $note->user->name }}
								</a>
							</p>
							<hr />
							{!! substr(strip_tags($note->description), 0, 200) !!}...
							<hr />
							<p>
							<i class="fa fa-eye"></i> {{ $note->statistic->total_visits }} Views 
								<i class="fa fa-thumbs-up"></i> {{ $note->likes->count() }} Likes 
							</p>
							<p>
								<a href="{{ route('note.single', $note->slug) }}" class="btn btn-primary" role="button">See Note <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
								<a href="#report-note{{ $note->id }}" class="btn btn-danger" data-toggle="modal">Report this note <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
							</p>

							<div class="modal fade" id="report-note{{ $note->id }}">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Report For Note</h4>
										</div>
										<div class="modal-body">
											<p><strong>Note Title : </strong> {{ $note->title }}</p>
											@include('partials.note-report-request')
										</div>
									</div>
								</div>
							</div> <!--End Model Report Form-->

						</div>
					</div>
				</div>



				@php
				$i++;
				@endphp
				@endforeach
			</div>


{{-- 			</tbody>
</table> --}}






@endif

<div class="text-right">
	{{ $notes->links() }}
</div>
</div>
</div>
@endsection