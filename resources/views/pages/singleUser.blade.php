@extends('layouts.master')

@section('title')
User - {{ $user->name }} | Store My Notes
@endsection

@section('content')
<div class="user-single-page">
	<div class="row">
		<div class="col-sm-4 well">
			@if (Auth::check() && ($user->id == Auth::user()->id))
			<a href="" class="btn btn-theme pull-right">Upload a new Image</a>
			<div class="clearfix"></div>
			@endif

			@if ($user->image == NULL)
			<img src="{{ "https://www.gravatar.com/avatar/".md5(strtolower(trim($user->email)))."?s=50&d=identicon" }}" class="img img-responsive img-circle" style="height: 220px;width: 220px;" />
			@else
			<img src="{{ URL::to("images/users/$user->image") }}" class="img img-responsive img-rounded" style="height: 220px;width: 200px;" />
			@endif
			
			<h2>{{ $user->name }}</h2>
			@if (Auth::check() && ($user->id == Auth::user()->id))
			<a href="{{ route('user.edit', $user->username) }}" class="btn btn-theme pull-right margin-bottom-20"><i class="fa fa-edit"></i> Edit</a>
			<div class="clearfix"></div>
			@endif
			<ul class="list-group">
				
				<li class="list-group-item"><h3>{{ $user->bio_title }}</h3></li>
				<li class="list-group-item">
					Primary Email : <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
				</li>
				<li class="list-group-item">{{ $user->organization }}, {{ $user->country }}</li>
				<li class="list-group-item"><a href="{{ $user->website }}">{{ $user->website }}</a></li>
				<li class="list-group-item"><a href="#" class="btn btn-info">Hire Me Now</a></li>
			</ul>
		</div>
		<div class="col-sm-8">
			<h3>About {{ $user->name }}</h3>
			<p>{{ $user->bio_description }}</p>
			@if (Auth::check() && ($user->id == Auth::user()->id))
			<a href="{{ route('user.edit', $user->username) }}" class="btn btn-theme pull-right margin-bottom-20"><i class="fa fa-edit"></i> Edit</a>
			<div class="clearfix"></div>
			@endif
			<hr />

			<h3>Public Notes  of {{ $user->name }}</h3>
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
							{!! substr(strip_tags($note->description), 0, 100) !!}...
						</td>
						<td>
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
			<div class="text-right">
				{{ $notes->links() }}
			</div>
		</div>
	</div>
</div>

@endsection