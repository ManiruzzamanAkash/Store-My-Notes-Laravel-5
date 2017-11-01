@extends('layouts.master')

@section('content')
<ol class="breadcrumb" style="margin-bottom: 5px;">
	<li><a href="{{ url('/') }}">Home</a></li>
	<li>Search</li>
	<li class="active">{{$search}}</li>
</ol>

<div class="all-notes-page">
	
	<div class="inner-content">




		@if ($notes->count() <= 0)
		<div class="panel panel-theme" style="margin-bottom: 25%">
			<div class="panel-heading">
				<h3 class="panel-title">Sorry {{ Auth::check() ? Auth::user()->name : 'Guest' }} </h3>
			</div>
			<div class="panel-body">
				<h4 class="text-danger">There is no note found in Store My Notes for your search <mark>{{$search}}</mark></h4>
			</div>
		</div>
		
		@else
		<div class="alert alert-info">
			There are {{$notes->count()}} found for your search <mark class="text-success">{{$search}}</mark>
		</div>
		<table class="table table-responsive table-hover table-striped">
			<thead>
				<tr>
					<th width="3%">No</th>
					<th width="10%">Note Title</th>
					<th width="20%">Note Description</th>
					<th width="5%">Author/Category/Tags</th>
					<th width="10%">Statistics</th>
				</tr>
			</thead>
			<tbody>

				@php
				$i=1;
				@endphp
				@foreach ($notes as $note)
				<tr>
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
						<a href="{{ route('note.single', $note->slug) }}" class="btn btn-sm btn-primary">View</a> <a href="#" class="btn btn-sm btn-danger">Report this note</a>
					</td>
				</tr>
				@php
				$i++;
				@endphp
				@endforeach

				

			</tbody>
		</table>
		@endif

		<div class="text-right">
			{{ $notes->links() }}
		</div>
	</div>
</div>
@endsection