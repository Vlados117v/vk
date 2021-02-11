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
        //Тут мы не знаем текущего пользователя, больше условий нет
        if (empty($book)) {
            return back();
        }; 

        return view('library.book_page', compact('book'));                
    }

    public function change_book($book_id)
    {   
        $user=\Auth::user(); 
  
        $book = book::where('id', '=', $book_id)->where('user_id', '=', $user->id)->get()->first();

        if (!empty($book) && ($book->user_id == $user->id)) {
            return view('library.change_book', compact('book'));
        }             
    }    

    public function add_change_book(Request $request, $book_id)
    {   
        $user=\Auth::user(); 

        $book = book::where('id', '=', $book_id)->where('user_id', '=', $user->id)->get()->first();

        if (empty($book)) {
            return back();
        };    

        $title = strval($request->title); 
        $text = strval($request->text);
        book::where('id', '=', $book_id)->where('user_id', '=', $user->id)->update(['title' => $title, 'text' => $text]); 
        // $book->update(['title' => $title, 'text' => $text]); не работает
        return redirect()->action('BooksController@library_main', ['this_user_id' => $user->id]
);
                              
    } 


    public function delete_book($book_id)
    {   
        $user=\Auth::user();

        $book_auther = book::where('id', '=', $book_id)->where('user_id', '=', $user->id)->get()->first();

        if (empty($book_auther)) {
            return back(); 
        };

        $book_auther->delete();

        return redirect()->action('BooksController@library_main', ['this_user_id' => $user->id]
);
    }


    public function add_new_book(Request $request, $this_user_id)
    {   
        $user=\Auth::user();

        if ($user->id == $this_user_id){
            $title = strval($request->title); 
            $text = strval($request->text);
            book::insert(['user_id' => $user->id,'title' =>$title, 'text' => $text]);

            return redirect()->action('BooksController@library_main', ['this_user_id' => $user->id]
);
        } else {
            return back();       
        }    
    }


    public function new_book_page($this_user_id)
    {   
        $user=\Auth::user();

        if ($user->id == $this_user_id){
            return view('library.create_book', compact('user'));
        } else {
            return back();          
        }    
    }

    public function access_for_all($book_id)
    {   
        $user=\Auth::user();

        $book = book::where('id', '=', $book_id)->where('user_id', '=', $user->id)->get()->first();

        if (empty($book)) {
            return back();
        };

        book::where('id', '=', $book_id)->where('user_id', '=', $user->id)->update(['for_all_users' => 1]); 
        // $book->update(['for_all_users' => 1]); не работает
        return back();

    }


    public function library_main($this_user_id = 0)
    {   
        $user = \Auth::user();
        $books = book::where('user_id','=',$this_user_id)->get(); 
        return view('library.library_main', compact('books', 'user', 'this_user_id'));
    }
}
