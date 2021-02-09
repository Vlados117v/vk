<?php

namespace App\Http\Middleware;

use Closure;
use App\book;
use App\User;
use App\Comments;
use App\Friends;

class HaveAccess
{
  /**
   * Обработка входящего запроса
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  { 
    if (\Auth::check()) {                                   // если пользователь авторизован
        $to_user_id = $request->route('this_user_id');      // к кому переходим
        $user=\Auth::user();                                  // текущий юзер
        if (User::find($to_user_id) !== null) {                      //если пользователь существует
            if ($user->id == $to_user_id) {                     // я на своей странице
                return $next($request);
            } else {                                                // на странице другого пользователя
                $is_friend = Friends::where([['user_id', '=', $to_user_id],['friend_id', '=', $user->id]])->first();
                if ($is_friend !== null) {                          // я у него в друзьях
                    return $next($request);
                } else {                                               //меня нет в друзьях
                    return redirect()->action('HomeController@welcome', ['user' => $user]);
                }
            }
        } else {                                                    //Пользователя не существует
            return redirect()->action('HomeController@welcome', ['user' => $user]);
        }            
    } else {                                                        //пользователь неавторизован
        return redirect()->action('HomeController@welcome');
    }
  }
}