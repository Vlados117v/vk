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

   public function delete_comment(Request $request)
   {
    $comment_id = intval($request->delete);
    Comments::where('id','=',$comment_id)->delete();
    $user = \Auth::user();
    $to_user_id = $user->id;
    $comments = Comments::where('to_user_id','=',$user->id)->take(5)->get();
    return view('any_user_page.any_user_page', compact('comments', 'to_user_id', 'user'));     
}

public function add_comment(Request $request,$to_user_id)
{   
    $text = strval($request->text);
    $title = strval($request->title);        
    $user = \Auth::user();
    Comments::insert(['user_id' => $user->id, 'to_user_id' => $to_user_id,'title' =>$title, 'comment_text' => $text]);
    $comments = Comments::where('to_user_id','=',$to_user_id)->take(5)->get();
    return view('any_user_page.any_user_page', compact('comments', 'to_user_id', 'user'));
}

public function answer($to_comment_id)
{   
    $comments = Comments::where('id','=',$to_comment_id)->first();
    $x = $comments->user_id;
    $auther = User::find($x);
    $user = \Auth::user();
    return view('answer.answer_page', compact('comments', 'auther', 'to_comment_id', 'user'));
}

public function add_answer(Request $request, $comment_id)
{   
    $comments = Comments::where('id','=',$comment_id)->first();
    $text = $request->text;
    $title = $request->title; 
    $answer_comment = $comments->comment_text;
    $user = \Auth::user();
    $answer_comment = "Ответ на комментарий: ".$answer_comment."___ОТВЕЧАЮ___".$text;
    Comments::insert(['user_id' => $user->id, 'to_user_id' => $user->id,'title' =>$title, 'comment_text' => $answer_comment]);
    $to_user_id = $user->id;
    $comments = Comments::where('to_user_id','=',$user->id)->take(5)->get();
    return view('home', compact('comments', 'to_user_id'));
}


public function my_comments()
{   

    $user = \Auth::user();
    $to_user_id = $user->id;
    $comments = Comments::where('user_id','=',$user->id)->get();
    return view('my_comments.my_comments', compact('comments'));

}
}
