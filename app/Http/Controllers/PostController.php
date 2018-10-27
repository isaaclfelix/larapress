<?php
namespace App\Http\Controllers;

use App\Post;
use App\Posttype;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new post instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        // Validate the request...
        $request->validate([
            'route' => 'bail|required|string|unique:posts',
            'guid' => 'string|unique:posts',
            'parent' => 'integer',
            'author' => 'integer',
            'title' => 'string',
            'content' => 'string',
            'excerpt' => 'string',
            'type' => 'string',
            'status' => 'string'
        ]);

        $post = new Post;

        $post->parent = (int)$request->parent;
        $post->author = (int)$request->author;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->excerpt = $request->excerpt;
        $post->type = $request->type;
        $post->status = $request->status;
        $post->route = $request->title;
        $post->guid = trim(getGUID(), '{}');

        $post->save();

        return redirect()->back(['post_type' => $post->type, 'post_id' => $post->id])->with('message', 'Post created successfully');
    }

    /**
     * Read a post instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function read(Request $request)
    {
        // Validate the request...
        $request->validate([
            'id' => 'integer'
        ]);
        return Post::find((int)$request->id);
    }

    /**
     * Update a post instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        // Validate the request...
        $request->validate([
            'parent' => 'integer',
            'author' => 'integer',
            'title' => 'string',
            'content' => 'string',
            'excerpt' => 'string',
            'type' => 'string',
            'status' => 'string'
        ]);
        // Find the post we're trying to update
        $post = \App\Post::find((int)$request->id);
        // Set fields with the request values
        $post->parent = (int)$request->parent;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->excerpt = $request->excerpt;
        $post->type = $request->type;
        $post->status = $request->status;
        // If the route is different and not empty, save it
        if ($request->route !== $post->route && $request->route !== '') {
            $request->validate([
                'route' => 'bail|required|string|unique:posts'
            ]);
            $post->route = $request->route;
        }
        // Save post
        $post->save();
        return redirect()->back()->with('message', 'Post updated successfully.');
    }

    /**
     * Delete a post instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function delete(Request $request)
    {
        // Do nothing if we didn't get an ID
        $request->validate([
            'id' => 'bail|required|integer'
        ]);
        // Get the ID
        $post = \App\Post::find((int)$request->id);
        // Delete post
        $post->delete();
        return redirect()->route('post')->with('message', 'Post removed successfully.');
    }

    /**
     * Editor for adding a new content or updating existing contents
     *
     * @return \Illuminate\Http\Response
     */
    public function editor(Request $request, $post_type = 'post', $post_id = 0) {
        // TODO: Find a way to validate post type and post id before any of this
        $post_type = \App\Posttype::where('name', $post_type);
        if ($post_type === null || !$post_type->count()) {
            return redirect()->route('posts')->with('message', 'Post type doesnt exist');
        }
        $post_type = $post_type->first();
        $data = array(
            'update' => false,
            'post_type' => $post_type
        );
        if ($post_id !== 0) {
            $post = \App\Post::find($post_id);
            if ($post !== null && $post->count()) {
                $data['update'] = true;
                $data['post'] = $post->first();
            }
            else {
                return redirect()->route('posts', $post_type->name)->with('message', "Post doesn't exist");
            }
        }
        return view('crud.editor', $data);
    }
}

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}
