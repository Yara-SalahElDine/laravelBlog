@extends('layouts.master')
@section('content')
<div class="container">
<center>
<a href="posts/create" class="btn btn-success mt-3  " role="button">Create Post</a>
</center>
</br></br>
<table class="table table-striped">
<thead>
      <tr>
        <th>Post #</th>
        <th>Title</th>
        <th>Posted By</th>
        <th>Slug</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
</thead>
<tbody>
@foreach ($posts as  $indexKey => $post)
      <tr>
        <td ml-3>{{ $post->id }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->user->name }}</td>
        <td>{{ $post->slug }}</td>
        <td>{{ $post->date }}</td>
        <td>
            <form action="posts/{{$post->id}}" method="POST">
                <a href="posts/{{$post->id}}" class="btn btn-info" role="button">View</a>
                <a href="posts/{{$post->id}}/edit" class="btn btn-primary" role="button">Edit</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Are You Sure You Would Like to Delete This Post?');">Delete</button>
            </form>
        </td>        
      </tr>
@endforeach
    </tbody>
  </table>
  
  @include('pagination.default', ['paginator' => $posts])

</div>
@endsection