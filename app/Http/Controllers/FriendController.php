<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friends;
use App\User;
use App\Comments;
//use App\Http\Controllers\CommentController;

class FriendController extends Controller
{

    public function __construct()
    {   

    }


    public function add_friend($friend_id)
    {   
        $user=\Auth::user();
        if (\Auth::check()) {
           $already_friend = Friends::where([['user_id', '=', $user->id],['friend_id', '=', $friend_id]])->first();

           if ($already_friend === null) {
               Friends::insert(['user_id' => $user->id,'friend_id' => $friend_id]);
               $comments = Comments::where('to_user_id','=',$friend_id)->take(5)->get();
               $to_user_id = $friend_id;
               return view('home', compact('comments', 'to_user_id', 'user'));
           } else {
               Friends::where('user_id', '=', $user->id)->where('friend_id', '=', $friend_id)->delete();
               $comments = Comments::where('to_user_id','=',$friend_id)->take(5)->get();
               $to_user_id = $friend_id;
               return view('home', compact('comments', 'to_user_id', 'user'));
           }
           
       } else {
           return view('welcome'); 
       }
   }
}
