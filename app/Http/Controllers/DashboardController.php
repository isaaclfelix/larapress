<?php

namespace App\Http\Controllers;

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
    public function dashboard()
    {
        return view('dashboard.home');
    }

    /**
     * Show the posts in the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function posts()
    {
        return view('dashboard.posts');
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

}
