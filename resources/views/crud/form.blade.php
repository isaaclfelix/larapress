<?php
// Default values
// Post misc
/*
if ($update) {
    // Populate with saved values
    // Post key
    $id = $post->id;
    // Post misc
    $parent = $post->parent;
    $author = $post->author;
    $type = $post->type;
    $status = $post->status;
    // Post contents
    $title = $post->title;
    $route = $post->route;
    $content = $post->content;
    $excerpt = $post->excerpt;
}
*/
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
@if ($update)
<h1>Edit Post</h1>
@else
<h1>Add New Post</h1>
@endif

<form id="add-new-post" method="POST" action="{{ route('post') }}">
    @if ($update)
        @method('PATCH')
    @endif
    @csrf

    @if ($update)
    <script>
    var post = JSON.parse('<?php echo($post); ?>');
    </script>
    @else
    <script>
    var post = {
        id: 0,
        parent: 0,
        author: 0,
        type: "post",
        status: "publish",
        // Post contents
        title: "",
        route: "",
        content: "",
        excerpt: ""
    };
    </script>
    @endif
    <div id="add-new-post-form"></div>
</form>
@endsection
