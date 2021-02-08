<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\book;
use App\User;
//use App\Http\Controllers\CommentController;

class BooksController extends Controller
{

    public function __construct()
    {   

    }


    public function delete_book($book_id)
    {   
       /* if (\Auth::check()){
        $user=\Auth::user();
        $book_auther = book::where('id','=',$book_id)->get();
        $book_auther_id = $book_auther->user_id;
        if ($user->id == $book_auther_id) {
        book::where('id','=',$book_id)->delete();
        $books = book::all();
        return view('library.library_main', compact('books', 'user'));
           }
        } else {
        return view('welcome');          
        }  */  
    }


    public function add_new_book(Request $request)
    {   
        if (\Auth::check()){
        $user=\Auth::user();
        $title = strval($request->title); 
        $text = strval($request->text);
        book::insert(['user_id' => $user->id,'title' =>$title, 'text' => $text]);
        $books = book::all();
        return view('library.library_main', compact('books', 'user'));
        } else {
        return view('welcome');          
        }    
    }


    public function new_book_page()
    {   
        if (\Auth::check()){
        return view('library.create_book');
        } else {
        return view('welcome');          
        }    
    }

    public function library_main()
    {   
        if (\Auth::check()){
        $user = \Auth::user();
        $books = book::all();  
        return view('library.library_main', compact('books', 'user'));
        } else {
        return view('welcome');          
        }    
    }
}
