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



    public function read_book($book_id)
    {   
        $user=\Auth::user(); 
        $book = book::find($book_id);         
        return view('library.book_page', compact('book'));                
    }



    public function delete_book($book_id)
    {   
        $user=\Auth::user();
        $book_auther = book::find($book_id);
        if (\Auth::check()&&($user->id == $book_auther->user_id)){
        $book_auther->delete();
        $books = book::where('user_id','=',$user->id)->get(); 
        $this_user_id = $user->id;
        return view('library.library_main', compact('books', 'user', 'this_user_id'));
        } else {
        return view('welcome');          
        }  
    }


    public function add_new_book(Request $request, $this_user_id)
    {   
        $user=\Auth::user();
        if (\Auth::check()&&($user->id == $this_user_id)){
        $title = strval($request->title); 
        $text = strval($request->text);
        book::insert(['user_id' => $user->id,'title' =>$title, 'text' => $text]);
        $books = book::where('user_id','=',$user->id)->get(); 
        $this_user_id = $user->id;
        return view('library.library_main', compact('books', 'user', 'this_user_id'));
        } else {
        return view('welcome');          
        }    
    }


    public function new_book_page($this_user_id)
    {   
        $user=\Auth::user();
        if (\Auth::check()&&($user->id == $this_user_id)){
        return view('library.create_book', compact('user'));
        } else {
        return view('welcome');          
        }    
    }

    public function library_main($this_user_id = 0)
    {   
        if (\Auth::check()){
        $user = \Auth::user();
        $books = book::where('user_id','=',$this_user_id)->get();  
        return view('library.library_main', compact('books', 'user', 'this_user_id'));
        } else {
        return view('welcome');          
        }    
    }
}
