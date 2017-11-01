@extends('layouts.master')

@section('title')
{{ $note->title }}
@endsection

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ URL::to('css/parsley.css') }}" />
@endsection


@section('content')
<div class="row">
	<div class="col-sm-8 col-md-8">
		<div class="note-full-body">
			<div class="note-header">
				<h2>{{ $note->title }}</h2>
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
			</div>
			<a href="{{ URL::to("images/note_images/$note->image") }}" target="blank"><img src="{{ URL::to("images/note_images/$note->image") }}" class="img img-responsive img-thumbnail margin-top-20 text-center" style="width: 50%; margin-left: 25%;" /></a>
			<div class="margin-top-20" ></div>
			{!! $note->description !!}

			@if (Auth::check())
			<div class="note-options">
				<form action="{{ route('note.changeLike', $note->id) }}" method="post" class="pull-left">
					{{ csrf_field() }}
					@if ($likes->count() > 0)
					<button type="submit" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Click to remove like"  style="color: #01579B; font-weight: bold; font-size: 25px;"><i class="fa fa-thumbs-up"></i> Liked</button>
					@else
					<button type="submit" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Click to like the note" style=" font-size: 25px;"><i class="fa fa-thumbs-o-up"></i> Like</button>
					@endif
					
				</form>

				<form action="{{ route('note.changeDisLike', $note->id) }}" method="post" class="pull-left">
					{{ csrf_field() }}
					@if ($dislikes->count() > 0)
					<button type="submit" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Click to remove dislike"  style="color: #ff0000; font-weight: bold; font-size: 25px;"><i class="fa fa-thumbs-down"></i> Disliked</button>
					@else
					<button type="submit" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Click to dislike the note" style="font-size: 25px;color: #ff1616;"><i class="fa fa-thumbs-o-down"></i> Dislike</button>
					@endif
					
				</form>
				<div class="clearfix"></div>
			</div>
			@else
			<a href="{{ route('register') }}" class="btn btn-theme btn-lg">Create an account to like or dislike the note</a>
			@endif

		</div>
		



		
		<div class="full-comment-section">
			<h3>Note Comments <i class="fa fa-comment"></i> {{ $note->comments->count() }}</h3>
			
			@if ( Session::has('success') )

			<div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-top: 5%">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<strong>{{ Session::get('success') }}</strong>
			</div>
			@endif

			<table class="table table-hover table-striped">
				<tbody>
					@foreach ($note->comments as $comment)
					<tr>
						<td width="30%">
							<img src="{{ "https://www.gravatar.com/avatar/".md5(strtolower(trim($comment->email)))."?s=50&d=identicon" }}" class="img img-responsive img-circle" style="height: 70px;width: 70px;" />
							<br />
							<h5><a href="{{ $comment->website }}">{{ $comment->name }}</a></h5>
							<p class="time_comment">
								{{ date('F nS, Y - g:iA', strtotime($comment->created_at)) }} 
							</p>
						</td>
						<td>
							{{ $comment->comment }}
							<div>
								<a  data-toggle="collapse" href="#replyComment{{ $comment->id }}" class="btn btn-primary pull-right">Reply</a>

								<div class="clearfix"></div>
								<form id="replyComment{{ $comment->id }}" class="form-horizontal collapse" action="{{ route('comments.store', $note->slug) }}" method="post"  data-parsley-validate style="padding: 20px;border: 1px solid rgba(118, 255, 3, 0.24);margin: 10px;">

									{{ csrf_field() }}
									<input type="hidden" name="note_id" id="note_id" class="form-control" value="{{ $note->id }}" />
									<input type="hidden" name="reply_comment_id" id="reply_comment_id" value="{{ $comment->id }}" class="form-control"/>
									<div class="form-group">
										<label for="name" class="control-label col-sm-2">Your Name <span class="required-star">*</span></label>
										<div class="col-sm-10">
											<input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required="" />
										</div>
									</div>
									<div class="form-group">
										<label for="email" class="control-label col-sm-2">Your Email <span class="required-star">*</span></label>
										<div class="col-sm-10">
											<input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email address"  required="" />
										</div>
									</div>
									<div class="form-group">
										<label for="website" class="control-label col-sm-2">Your Website</label>
										<div class="col-sm-10">
											<input type="url" name="website" id="website" class="form-control" placeholder="Enter your website address" />
										</div>
									</div>
									<div class="form-group">
										<label for="comment" class="control-label col-sm-2">Your Comment<span class="required-star">*</span></label>
										<div class="col-sm-10">
											<textarea type="text" name="comment" id="comment" class="form-control" rows="5"  required="" minlength="5"></textarea>
										</div>
									</div>



									<div class="form-group">
										<div class="col-sm-10 col-sm-offset-2">
											<button type="submit" class="btn btn-theme">Reply Comment</button>
										</div>
									</div>

								</form>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			

			<div class="add-comment">
				<h3>Leave a comment</h3>


				<form class="form-horizontal" action="{{ route('comments.store', $note->slug) }}" method="post" data-parsley-validate id="form">

					{{ csrf_field() }}
					<input type="hidden" name="note_id" id="note_id" class="form-control" value="{{ $note->id }}" />
					<input type="hidden" name="reply_comment_id" id="reply_comment_id" class="form-control"/>
					<div class="form-group">
						<label for="name" class="control-label col-sm-2">Your Name <span class="required-star">*</span></label>
						<div class="col-sm-10">
							<input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required="" />
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="control-label col-sm-2">Your Email <span class="required-star">*</span></label>
						<div class="col-sm-10">
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email address"  required="" />
						</div>
					</div>
					<div class="form-group">
						<label for="website" class="control-label col-sm-2">Your Website</label>
						<div class="col-sm-10">
							<input type="url" name="website" id="website" class="form-control" placeholder="Enter your website address" />
						</div>
					</div>
					<div class="form-group">
						<label for="comment" class="control-label col-sm-2">Your Comment<span class="required-star">*</span></label>
						<div class="col-sm-10">
							<textarea type="text" name="comment" id="comment" class="form-control" rows="5"  required="" minlength="5"></textarea>
						</div>
					</div>
					

					
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-theme">Send Comment</button>
						</div>
					</div>
					
				</form>
			</div>
		</div>
		
	</div>
	<div class="col-sm-4 col-md-4 right-sidebar">
		<div class="sidebar-full">
			<div class="sidebar-widget">
				<ul>
					<li>
						<strong><i class="fa fa-pencil text-warning"></i> Created at</strong> 
						{{ date('M j, Y h:ia', strtotime( $note->created_at)) }}
					</li>
					<li><strong><i class="fa fa-edit text-success"></i> Updated at</strong> 
						{{ date('M j, Y h:ia', strtotime( $note->updated_at)) }}
					</li>
					<li><strong><i class="fa fa-user text-info"></i> Published By</strong> 
						<a href="/users/{{ $note->user->username }}"> 
							{{ $note->user->name }}
						</a>
					</li>
					<li><strong><i class="fa fa-eye text-warning"></i> Total Views </strong> 
						{{ $note->statistic->total_visits }}
					</li>
					<li><strong><i class="fa fa-thumbs-up text-primary"></i> Total Likes </strong> {{ $note->likes->count() }} </li>
					<li><strong><i class="fa fa-thumbs-down text-danger"></i> Total Dislikes </strong> {{ $note->dislikes->count() }}</li>
					{{-- <li><strong><i class="fa fa-share text-primary"></i> Total Shares </strong> 5</li> --}}
				</ul>
			</div>

			<div class="sidebar-widget advertise">
				<h2 class="text-center text-muted">Advertise</h2><br /><br />
				<h2 class="text-center text-muted">350 X 300</h2>
			</div>

			<div class="sidebar-widget">
				<h2>Popular Notes</h2>
				

				<div class="media" style="cursor: pointer" onclick="window.location='{{ route('index') }}'">
					<a class="pull-left" href="#">
						<img class="media-object img img-thumbnail img-responsive" src="{{URL::to('images/logo.png')}}" alt="Image" style="width: 64px; height: 64px" >
					</a>
					<div class="media-body">
						<h4 class="media-heading">This is our first note</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						</p>
					</div>
				</div>
				

			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ Url::to('js/parsley.min.js') }}"></script>
<script type="text/javascript">
	//Start Parsely
	$('#form').parsley();
</script>
@endsection