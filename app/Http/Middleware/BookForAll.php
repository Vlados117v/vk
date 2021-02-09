<?php

namespace App\Http\Middleware;

use Closure;
use App\book;
use App\User;
use App\Comments;
use App\Friends;

class BookForAll
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {                                    
        $book_id = $request->route('book_id');                  
        if (book::find($book_id) !== null) {                      
        $book = book::find($book_id);
            if ($book->for_all_users == 1) {
            return $next($request);
            } elseif (\Auth::check()) {
                $user = \Auth::user();
                $auther = $book->user_id;
                $is_friend = Friends::where([['user_id', '=', $auther],['friend_id', '=', $user->id]])->first();
                if ($user->id == $auther || ($is_friend)) {
                   return $next($request);
                }
               
            } else {
                return view('welcome');
            }
          }                  

    }
}
