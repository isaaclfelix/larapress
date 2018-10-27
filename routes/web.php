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
    Route::get('/posts', 'DashboardController@posts')->name('posts');
    // Posts CRUD routes
    Route::post('/post', 'PostController@create')->name('post'); // Create
    Route::get('/post/{type?}/{id}', 'PostController@read')->name('post'); // Read
    Route::patch('/post', 'PostController@update')->name('post'); // Update
    Route::delete('/post', 'PostController@delete')->name('post'); // Delete

    // Posts Create or Update form
    Route::get('/posts/editor/{post_type?}/{post_id?}', 'PostController@editor')->name('crud');

    // Profile panel route
    Route::get('/profile', 'DashboardController@profile')->name('profile');
});
