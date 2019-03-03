<?php

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'PostController@index');
    Route::get('/post/{slug}', 'PostController@show')->name('frontend.post.show');
    Route::get('/category/{slug}', 'PostController@category')->name('frontend.category.show');
    Route::get('/tag/{slug}', 'PostController@tag')->name('frontend.tag.show');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@store');

    Route::post('/comment', 'CommentController@store')->name('frontend.comment');
    Route::delete('/comment/{id}', 'CommentController@destroy')->name('frontend.comment.destroy');

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('', 'DashboardController@index')->name('dashboard');

    Route::resource('/category', 'CategoryController');
    Route::resource('/tag', 'TagController');
    Route::resource('/post', 'PostController');

    Route::get('/comments', 'CommentController@index')->name('comments');
    Route::delete('/comment/{id}', 'CommentController@destroy')->name('comment.destroy');
    Route::get('/comment/toggle/{id}', 'CommentController@toggle')->name('comment.toggle');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
