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

Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('/home{this_user_id?}', 'HomeController@index')->name('home');

Route::post('/add_comment/{to_user_id}','CommentController@add_comment');

Route::get('/delete_comment','CommentController@delete_comment');

Route::get('/all','HomeController@show_users');

Route::get('/any_user_comments/{user_id}', 'HomeController@any_user_comments');

Route::get('/get_more_comments', 'CommentController@get_more_comments');

Route::get('/my_comments','CommentController@my_comments');

Route::get('/answer/{to_comment_id}','CommentController@answer');

Route::post('/add_answer/{comment_id}','CommentController@add_answer')->middleware("AuthCheck");

Route::get('/library_main/{this_user_id?}','BooksController@library_main')->middleware("HaveAccess");

Route::get('/new_book/{this_user_id}','BooksController@new_book_page')->middleware("AuthCheck");

Route::get('/add_new_book/{user_id}','BooksController@add_new_book')->middleware("AuthCheck");

Route::get('/delete_book/{book_id}','BooksController@delete_book')->middleware("OwnerOnlyBooks");

Route::get('/read_book/{book_id}','BooksController@read_book')->middleware("BookForAll");

Route::get('/add_friend/{to_user_id}','FriendController@add_friend')->middleware("AuthCheck");

Route::get('/access_for_all/{book_id}','BooksController@access_for_all')->middleware("OwnerOnlyBooks");

Route::get('/change_book/{book_id}','BooksController@change_book')->middleware("OwnerOnlyBooks");

Route::get('/add_change_book/{book_id}','BooksController@add_change_book')->middleware("AuthCheck");

