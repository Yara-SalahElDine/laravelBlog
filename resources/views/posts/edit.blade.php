@extends('layouts.master')
@section('content')
<div class="container">
@if ($errors->any())
    <div class="mt-2 alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h2  class="mt-2">Edit Post</h2>
<form method="POST" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" value="{{$post->title}}" name="title">
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea name="description" class="form-control" id="description" rows="5" >{{$post->description}}</textarea>
    </div>



    <div class="form-group input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Upload</span>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="photo" name="photo">
        <label class="custom-file-label" for="photo">Edit Post's Photo</label>
      </div>
    </div>


    <div class="form-group">
      <label for="user_id">Author:</label>
      <select class="form-control" id="user_id" name="user_id">
        @foreach ($users as $user)
          <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
      </select>
    </div>
    <input type="submit" class="btn btn-success" value="Edit"/>

@endsection

 