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

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'PostController@index');
    Route::get('/post/{slug}', 'PostController@show')->name('frontend.post.show');
    Route::get('/category/{slug}', 'PostController@category')->name('frontend.category.show');
    Route::get('/tag/{slug}', 'PostController@tag')->name('frontend.tag.show');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('', 'DashboardController@index')->name('dashboard');
    Route::resource('/category', 'CategoryController');
    Route::resource('/tag', 'TagController');
    Route::resource('/post', 'PostController');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

