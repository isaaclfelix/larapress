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
// Labels
$labels = App\Posttypesmeta::where([
    ['posttype_id', '=', $post_type->id],
    ['meta_key', '=', 'labels']
]);
if ($labels !== null && $labels->count()) {
    //$labels = json_decode(json_decode($post_type_meta->first())->meta_value, true)['labels'];
    $labels = $labels->first();
    $labels = json_decode($labels->meta_value, true);
}
else {
    $labels = [
        'singular' => 'Post',
        'plural' => 'Posts'
    ];
}
// Supports
$supports = App\Posttypesmeta::where([
    ['posttype_id', '=', $post_type->id],
    ['meta_key', '=', 'supports']
]);
if ($supports !== null && $supports->count()) {
    $supports = $supports->first();
    $supports = json_decode($supports->meta_value, true);
}
else {
    // Default supports
    $supports = array(
        'title',
        'editor',
        'excerpt'
    );
}
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
<h1>Edit {{ $labels['singular'] }}</h1>
@else
<h1>Add New {{ $labels['singular'] }}</h1>
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
    // TODO: Change this for non hardcoded values
    var post = {
        id: 0,
        parent: 0,
        author: {{ Auth::user()->id }},
        type: "<?php echo $post_type->id; ?>", // Change this for non harcoded post type
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
