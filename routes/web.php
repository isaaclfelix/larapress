<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('root');

Auth::routes();

Route::prefix('admin')->group(function() {
    // Panel Route
    //Route::get('/[route-name]', 'DashboardController@[route-name]')->name('[route-name]')
    Route::get('/', 'DashboardController@root')->name('root');
    // Dashboard panel route
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    // Posts panel route
    Route::get('/posts/{type?}/{s?}', 'DashboardController@posts')->name('posts');

    Route::get('/pages/{s?}', 'DashboardController@pages')->name('pages');
    Route::get('/media/{s?}', 'DashboardController@media')->name('media');

    // Posts CRUD routes
    Route::post('/post', 'PostController@create')->name('post'); // Create
    Route::get('/post/{type?}/{id}', 'PostController@read')->name('post'); // Read
    Route::patch('/post', 'PostController@update')->name('post'); // Update
    Route::delete('/post', 'PostController@delete')->name('post'); // Delete

    // Editor
    Route::get('/editor/{post_type?}/{post_id?}', 'PostController@editor')->name('editor');

    // Profile panel route
    Route::get('/users', 'DashboardController@users')->name('users');
    Route::get('/user/{id?}', 'DashboardController@profile')->name('profile');

    // Settings panel route
    Route::get('/settings', 'DashboardController@settings')->name('settings');
});
