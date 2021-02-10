<?php

namespace App\Http\Middleware;

use Closure;
use App\book;
use App\User;
use App\Comments;
use App\Friends;

class OwnerOnlyBooks
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

        $user=\Auth::user(); 

        $book_id = $request->route('book_id');

        $book = book::where('id', '=', $book_id)->first();

        if ($user->id == $book->user_id && \Auth::check()){
            return $next($request);
        } else {
            return redirect()->route('home',['user' => $user]);
        }
    }
}
