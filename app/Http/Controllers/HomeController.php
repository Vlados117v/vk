<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\User;

class HomeController extends Controller
{

    public function __construct()
    {   
       /// $this->middleware('auth');
    }

    public function show_users()
    {
        $users = User::all();
        return view('all_users_page.all_users_page', compact('users'));      
    }

    public function any_user_comments($user_id)
    {   
        $to_user_id = $user_id;
        if (\Auth::check()){
            $user = \Auth::user();
            $comments = Comments::where('to_user_id','=',$user_id)->take(5)->get();
            return view('any_user_page.any_user_page', compact('comments', 'to_user_id', 'user'));
        } else {
            $comments = Comments::where('to_user_id','=',$user_id)->take(5)->get();  
            return view('any_user_page.just_for_watch_any_user_page', compact('comments', 'to_user_id'));           
        }

    }


    public function get_more_comments(Request $request)
    {   
        $user_id = intval($request->test);
        //$comments = Comments::where('user_id','=',$user_id)->limit(5)->offset(5)->get();
        $comments = Comments::where('to_user_id','=',$user_id)->get();
        $data=[];
        foreach ($comments as $comment) {
            array_push($data, $comment);
        }
        return json_encode($comments);
    }


    public function index()
    {   
        if (\Auth::check()){
            $user = \Auth::user();
            $to_user_id = $user->id;
            $comments = Comments::where('to_user_id','=',$user->id)->take(5)->get();
            return view('home', compact('comments', 'to_user_id'));
        } else {
            return view('welcome');             
        }
    }
}
