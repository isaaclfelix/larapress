<?php
$posts = App\Post::all();
?>
@extends('layouts.dashboard')

@section('panel')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h1><?php echo $type; ?></h1>
<a href="{{ route('editor') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Post</a>

<table class="table table-striped mt-3">
  <thead>
    <tr>
      <th scope="col">Post ID</th>
      <th scope="col">Post Title</th>
      <th scope="col">Post Route</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>
      <td>{{ $post->id }}</td>
      <td><a href="{{ route('crud', ['post_id' => $post->id, 'post_type' => $post->type]) }}">{{ $post->title }}</a></td>
      <td>{{ $post->route }}</td>
      <td>
        <form method="POST" action="{{ route('post') }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="{{ $post->id }}">
          <button class="btn btn-primary" type="submit"><i class="fa fa-trash"></i> Remove</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
