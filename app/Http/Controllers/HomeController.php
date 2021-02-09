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

    public function welcome()
    {
        $user = \Auth::user();
        return view('welcome', compact('user'));      
    }

    public function index($this_user_id = 0)
    {   
        if (\Auth::check()){
            $user = \Auth::user();
            if ($user->id == $this_user_id) {
                $to_user_id = $user->id;               
                $comments = Comments::where('to_user_id','=',$to_user_id)->take(5)->get();
                return view('home', compact('comments', 'to_user_id', 'user'));
            } else {
                $to_user_id = $this_user_id;    
                $comments = Comments::where('to_user_id','=',$to_user_id)->take(5)->get();   
                return view('home', compact('comments', 'to_user_id', 'user'));        
            }

        } else {
            $to_user_id = -1; 
            $user = null;   
            $comments = Comments::where('to_user_id','=',$this_user_id)->take(5)->get();   
            return view('home', compact('comments', 'to_user_id', 'user'));               
        }
    }
}
