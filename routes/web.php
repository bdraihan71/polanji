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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PostController@index')->name('post.index');

Route::middleware(['auth'])->group(function () {
    //post
    Route::post('/post', 'PostController@store')->name('post.store');
    Route::delete('/post/{id}', 'PostController@destroy')->name('post.destroy');
    Route::get('/mypost', 'PostController@ownPostIndex')->name('post.ownPostIndex');

    //comment
    Route::post('/comment', 'CommentController@store')->name('comment.store');
    Route::delete('/comment/{id}', 'CommentController@destroy')->name('comment.destroy');

    //reply
    Route::post('/reply', 'ReplyController@store')->name('reply.store');
    Route::delete('/reply/{id}', 'ReplyController@destroy')->name('reply.destroy');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
