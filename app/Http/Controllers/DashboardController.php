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
        $post_type_id = \App\Posttype::where('name', 'post')->first()->id;
        $post_type = \App\Posttype::where('name', $post_type);
        if ($post_type !== null && $post_type->count()) {
            $post_type_id = $post_type->first()->id;
        }
        $post_type_meta = \App\Posttypesmeta::where([
            ['posttype_id', '=', $post_type_id],
            ['meta_key', '=', 'labels']
        ]);
        if ($post_type_meta !== null && $post_type_meta->count()) {
            $labels = json_decode($post_type_meta->first()->meta_value, true);
        }
        $data = array(
            'labels' => $labels,
            'post_type' => $post_type->first()->name
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
            ['meta_key', '=', 'labels']
        ]);
        if ($post_type_meta !== null && $post_type_meta->count()) {
            $labels = json_decode($post_type_meta->first()->meta_value, true);
        }
        $data = array(
            'labels' => $labels,
            'post_type' => $post_type->name
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
            ['meta_key', '=', 'labels']
        ]);
        if ($post_type_meta !== null && $post_type_meta->count()) {
            $labels = json_decode($post_type_meta->first()->meta_value, true);
        }
        $data = array(
            'labels' => $labels,
            'post_type' => $post_type->name
        );
        return view('dashboard.posts', $data);
    }

    /**
     * Show the user's profile tab in the application dashboard.
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
