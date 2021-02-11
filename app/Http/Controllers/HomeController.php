<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\User;

class HomeController extends Controller
{

    public function __construct()
    {   
       
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
            $this_user = User::where('id','=',$this_user_id)->first();

            if ($this_user !== null) {
                $user = \Auth::user();
                if ($user->id == $this_user_id) {
                    $to_user_id = $user->id;               
                } else {
                    $to_user_id = $this_user_id;           
                }
                $comments = User::where('id','=',$this_user_id)->first()->comments()->take(5)->get();
                //Отношение
                return view('home', compact('comments', 'to_user_id', 'user'));

            } else {
                $user = \Auth::user();
                return view('welcome', compact('user'));  
            }

        } else {
            $to_user_id = -1; 
            $user = null;   
            $comments = Comments::where('to_user_id','=',$this_user_id)->take(5)->get();   
            return view('home', compact('comments', 'to_user_id', 'user'));               
        }
    }
}
