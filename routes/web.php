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

Route::get('/', function () {return view('welcome');});

Route::get('test/show/{param}', 'TestController@show');	

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/add_comment/{to_user_id}','CommentController@add_comment');

Route::get('/delete_comment','CommentController@delete_comment');

Route::get('/all','HomeController@show_users');

Route::get('/any_user_comments/{user_id}', 'HomeController@any_user_comments');

Route::get('/get_more_comments', 'HomeController@get_more_comments');

Route::get('/my_comments','CommentController@my_comments');