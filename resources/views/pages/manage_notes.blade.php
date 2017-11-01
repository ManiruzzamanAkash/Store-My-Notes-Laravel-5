@extends('layouts.master')
@section('title', 'Manage Notes | Store My Notes')

@section('content')
<ol class="breadcrumb" style="margin-bottom: 5px;">
	<li><a href="{{ url('/') }}">Home</a></li>
	<li class="active">Manage Notes</li>
</ol>

<div class="all-notes-page">
	
	<div class="inner-content">
		@if ( Session::has('success') )

		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				<span class="sr-only">Close</span>
			</button>
			<strong>{{ Session::get('success') }}</strong>
		</div>

		@endif



		@if ($notes->count() <= 0)
		<div class="panel panel-theme" style="margin-bottom: 25%">
			<div class="panel-heading">
				<h3 class="panel-title">Hello {{ Auth::user()->name }} !!</h3>
			</div>
			<div class="panel-body">
				<h4 class="text-danger">You haven't created any note yet...</h4>
				<a href="{{ route('add_note') }}" class="btn btn-theme btn-lg">Create A New Note Now</a>
			</div>
		</div>
		
		@else
		<table class="table table-responsive table-hover table-striped">
			<thead>
				<tr>
					<th width="2%">No</th>
					<th width="5%">Note Title</th>
					<th width="10%">Note Description</th>
					<th width="5%">Author/Category/Tags</th>
					<th width="10%">Statistics</th>
					<th width="10%">Actions</th>
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
						{!! substr(strip_tags($note->description), 0, 100) !!}...
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
					<td>

						
						<form action="{{ route('note.changeNoteStatus') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="status" value="{{ $note->status }}" />
							<input type="hidden" name="id" value="{{ $note->id }}"/>
							@if ($note->status == 0)
							<button type="submit" class="btn btn-success btn-sm"> Make Public</button>
							@else
							<button type="submit" class="btn btn-warning btn-sm"> Make Private</button>
							@endif
						</form>
						<a href="{{ route('note.edit', $note->slug) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit Note</a>
						
						{!! Form::open(['route' => ['note.delete', $note->id], 'method' => 'DELETE']) !!}
						{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'return deleteNote()']) }}
						{!! Form::close() !!}


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
@section('scripts')
<script type="text/javascript">
	function deleteNote () {
		confirm("Are you sure ? Note will be deleted permanently");
	}
</script>
@endsection
