@extends('layouts.master')
@section('content')
<div class="container">

<div class="card mt-3">
  <h3 class="card-header">Post Info</h3>
  @if (!empty($post->photo))
  <img class="card-img-top"   height="500" src="{{ url($post->photo) }}">

  @endif
  <div class="card-body">
    <h5 class="card-title bg-light text-dark">Title</h5>
    <p class="card-text">{{ $post->title }}</p>
    <h5 class="card-title bg-light text-dark">Description</h5>
    <p class="card-text">{{ $post->description }}</p>
    <h5 class="card-title bg-light text-dark">Tags</h5>
    <p class="card-text">
        @foreach ($post->tags as $tag)
        #{{ $tag->name }}
      @endforeach
    
    
    </p>
  </div>
</div>

<div class="card mt-3">
  <h3 class="card-header">Author Info</h3>
  <div class="card-body">
    <h5 class="card-title bg-light text-dark ">Name</h5>
    <p class="card-text">{{ $post->user->name  }}</p>
    <h5 class="card-title bg-light text-dark">Email</h5>
    <p class="card-text">{{ $post->user->email }}</p>
    <h5 class="card-title bg-light text-dark">Created At</h5>
    <p class="card-text">{{ $post->user->date }}</p>
  </div>
</div>


<h2 class="mt-2">Leave A Comment</h2>
<form method="POST" action="/comments/{{ $post->id}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <textarea name="comment" class="form-control"  rows="5" placeholder="Write Your Comment"></textarea>
    </div>
    <input type="submit" class="btn btn-success" value="Comment"/>
  </form>

  <div class="card mt-3">
      <h3 class="card-header">Comments</h3>
      <div class="card-body">
        @foreach ($post->comments as $comment)
        <h5 class="card-title bg-light text-dark ">{{ $comment->user->name }}</h5>
        <p class="card-text">{{ $comment->comment }}</p>
        <p class="card-text">{{ $comment->date }}</p>
    
        
        @endforeach
      </div>
    </div>

</div>




@endsection

