<?php
namespace App\Http\Controllers;

use App\Post;
use App\Posttype;
use App\Posttypesmeta;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
     * Show the root of the dashboard in the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function root()
    {
        return redirect()->route('dashboard');
    }

    /**
     * Show the root of the dashboard in the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('dashboard.home');
    }

    /**
     * Show the posts in the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function posts($post_type = 'post')
    {
        $labels = array(
            'singular' => 'Post',
            'plural' => 'Posts'
        );
        $post_type = \App\Posttype::where('name', $post_type);
        if ($post_type !== null && $post_type->count()) {
            $post_type = $post_type->first();
            $post_type_id = $post_type->id;
            $post_type = $post_type->name;

            if ($post_type === 'page') {
                return redirect()->route('pages');
            }
            if ($post_type === 'medium') {
                return redirect()->route('media');
            }
        }
        else {
            return redirect()->route('posts')->with('message', "Post type doesn't exist");
        }
        $post_type_meta = \App\Posttypesmeta::where([
            ['posttype_id', '=', $post_type_id],
            ['meta_key', '=', 'options']
        ]);
        if ($post_type_meta !== null && $post_type_meta->count()) {
            $labels = json_decode($post_type_meta->first()->meta_value, true)['labels'];
        }
        $data = array(
            'labels' => $labels,
            'post_type' => $post_type,
            'post_type_id' => $post_type_id
        );
        return view('dashboard.posts', $data);
    }

    /**
     * Show the posts in the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function media($post_type = 'medium')
    {
        $labels = array(
            'singular' => 'Medium',
            'plural' => 'Media'
        );
        $post_type = \App\Posttype::where('name', 'medium')->first();
        $post_type_id = $post_type->id;
        $post_type_meta = \App\Posttypesmeta::where([
            ['posttype_id', '=', $post_type_id],
            ['meta_key', '=', 'options']
        ]);
        if ($post_type_meta !== null && $post_type_meta->count()) {
            $labels = json_decode($post_type_meta->first()->meta_value, true)['labels'];
        }
        $data = array(
            'labels' => $labels,
            'post_type' => $post_type->name,
            'post_type_id' => $post_type_id
        );
        return view('dashboard.posts', $data);
    }

    /**
     * Show the posts in the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pages($post_type = 'page')
    {
        $labels = array(
            'singular' => 'Page',
            'plural' => 'Pages'
        );
        $post_type = \App\Posttype::where('name', 'page')->first();
        $post_type_id = $post_type->id;
        $post_type_meta = \App\Posttypesmeta::where([
            ['posttype_id', '=', $post_type_id],
            ['meta_key', '=', 'options']
        ]);
        if ($post_type_meta !== null && $post_type_meta->count()) {
            $labels = json_decode($post_type_meta->first()->meta_value, true)['labels'];
        }
        $data = array(
            'labels' => $labels,
            'post_type' => $post_type->name,
            'post_type_id' => $post_type_id
        );
        return view('dashboard.posts', $data);
    }

    /**
     * Show the posts in the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $labels = [
            'singular' => 'User',
            'plural' => 'Users'
        ];
        $data = [
            'labels' => $labels
        ];
        return view('dashboard.users', $data);
    }

    /**
     * Show the users tab in the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('dashboard.profile');
    }

    /**
     * Show the user's settings tab in the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        return view('dashboard.settings');
    }

}
