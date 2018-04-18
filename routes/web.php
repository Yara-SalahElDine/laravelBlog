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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('posts','PostsController@index');
//Route::get('posts/create','PostsController@create');
//Route::post('posts','PostsController@store');
Route::get(
    'posts', //url
    'PostsController@index'
)->name('posts.index')->middleware('auth');

Route::get(
    'posts/create',
    'PostsController@create'
)->name('posts.create')->middleware('auth');;

Route::post(
    'posts',
    'PostsController@store'
)->name('posts.store');

Route::post(
    'comments/{post}',
    'CommentsController@store'
)->name('comments.store');

Route::get(
    'posts/{post}',
    'PostsController@show'
)->name('posts.show')->middleware('auth');;

Route::get(
    'posts/{post}/edit',
    'PostsController@edit'
)->name('posts.edit')->middleware('auth');;

Route::put(
    'posts/{post}',
    'PostsController@update'
)->name('posts.update');

Route::delete(
    'posts/{post}',
    'PostsController@destroy'
)->name('posts.destroy');


