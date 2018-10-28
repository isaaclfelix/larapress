<?php
$posts = App\Post::where([
  ['type', '=', $post_type_id]
])->get();
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

<h1>All {{ $labels['plural'] }}</h1>
<a href="{{ route('editor', $post_type) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New {{ $labels['singular'] }}</a>

<table class="table table-striped mt-3">
  <thead>
    <tr>
      <th scope="col"><input type="checkbox" /></th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Date</th>
      <th scope="col">Remove</th>
      <th scope="col"><i class="fas fa-sort"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>
      <th><input type="checkbox" /></th>
      <td><a href="{{ route('editor', ['post_type' => $post_type, 'post_id' => $post->id]) }}">{{ $post->title }}</a></td>
      <td>{{ $post->author }}</td>
      <td>{{ $post->updated_at }}</td>
      <td>
        <form method="POST" action="{{ route('post') }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="{{ $post->id }}">
          <button class="btn btn-primary" type="submit"><i class="fa fa-trash"></i> Remove</button>
        </form>
      </td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
