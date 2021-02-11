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

           if (empty($already_friend)) {
               Friends::insert(['user_id' => $user->id,'friend_id' => $friend_id]);
           } else {
               Friends::where('user_id', '=', $user->id)->where('friend_id', '=', $friend_id)->delete();
           }

           return redirect()->action('HomeController@index', ['this_user_id' => $friend_id]
            );
       } else {
           return view('welcome'); 
       }
   }
}
