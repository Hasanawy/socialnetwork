@extends('templates.app')
@section('title')
	Dashboard Add | Edit | Delete Posts	  
@endsection

@section('content')
	<div class="container">

		  @include('includes.message-block')

		<section class="row justify-content-md-center new-post">
			<div class=" col-md-6  ">
				<header><h3>What Do You Have To Say ??</h3></header>
				<form action="{{route('post.create')}}" method="post"  >
					{{csrf_field()}}
					<div class="form-group">
						<textarea class = "form-control" name="body" id="new-post" rows="5" placeholder="What Do You Want To Say"></textarea>
					</div>
					<button class = "btn btn-primary col"type="submit"> Create Post</button>
				</form>
			</div>
		</section>
		<div class="row justify-content-md-center posts">
			<div class="col-md-7 col-md-offset-3">
				<header><h3>What other People Say</h3></header>

			@foreach($posts as $post)
				<article class = "post" data-postid="{{ $post->id }}">
					<p>{{ $post->body }}</p>	
					<div class="info">
						Posted By: {{ $post->user->first_name }} on {{$post->created_at}}
					</div>
					<div class="interaction">
						<a href="#" class = "like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You Like This Post' : 'Like' : 'Like' }}</a> |
						<a href="#" class = "like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You Don\'t Like This Post' : 'Dislike' : 'Dislike' }}</a>
						@if(Auth::user() == $post->user )
							|
							<a href="#" class="edit">Edit</a>|
							<a href="{{ route('post.delete' , ['post_id'=>$post->id]) }}">Delete</a>
					
						@endif
						</div>
				</article>

			@endforeach

			</div>
		</div>
		<div class="modal" tabindex="-1" role="dialog" id = "edit-modal">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Edit Post</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form>
		        	<div class="form-group">
		        		<label for="post-body">Edit The Post</label>
		        		<textarea class = "form-control" name="post-body" id="post-body"  rows="5" ></textarea>
		        	</div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id = "modal-save">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>

	</div>
	<script>
		var token = '{{csrf_field()}}';
		var urlEdit = '{{route('edit')}}';
		var urlLike = '{{route('like')}}';

	</script>
@endsection