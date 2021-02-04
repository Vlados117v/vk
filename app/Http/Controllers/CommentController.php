<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\User;
//use App\Http\Controllers\CommentController;

class CommentController extends Controller
{

    public function __construct()
    {   
     $this->middleware('auth');
    }

    public function show_users()
    {
        $users = User::all();
        return view('all_users_page.all_users_page', compact('users'));      
    }


    public function delete_comment(Request $request)
    {
        $comment_id = $request->delete;
        Comments::where('id','=',$comment_id)->delete();
        $user = \Auth::user();
        $to_user_id = $user->id;
        $comments = Comments::where('to_user_id','=',$user->id)->take(5)->get();
        return view('home', compact('comments', 'to_user_id', 'user'));      
    }

    public function add_comment(Request $request,$to_user_id)
    {   
        $text = $request->text;
        $title = $request->title;        
        $user = \Auth::user();
        Comments::insert(['user_id' => $user->id, 'to_user_id' => $to_user_id,'title' =>$title, 'comment_text' => $text]);
        $comments = Comments::where('to_user_id','=',$to_user_id)->take(5)->get();
        return view('any_user_page.any_user_page', compact('comments', 'to_user_id', 'user'));
    }


    public function my_comments()
    {   
        if (\Auth::check()){
            $user = \Auth::user();
            $to_user_id = $user->id;
            $comments = Comments::where('user_id','=',$user->id)->get();
            return view('home', compact('comments', 'to_user_id'));
        } else {
            return view('welcome');             
        }
        return 22;
    }

}
