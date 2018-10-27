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

    // Dashboard panel route
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    // Posts panel route
    Route::get('/posts', 'DashboardController@posts')->name('posts');
    // Posts CRUD routes
    Route::post('/post', 'PostController@create')->name('post');
    Route::get('/post/{id}', 'PostController@read')->name('post');
    Route::patch('/post', 'PostController@update')->name('post');
    Route::delete('/post', 'PostController@delete')->name('post');

    // Clients panel route
    Route::get('/clients', 'DashboardController@clients')->name('clients');

    // Posts form
    Route::get('/form/{post_type?}/{post_id?}', 'PostController@form')->name('crud');

    // Profile panel route
    Route::get('/profile', 'DashboardController@profile')->name('profile');
});
