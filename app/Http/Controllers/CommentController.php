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
        $to_user_id_req = Comments::where('id','=',$comment_id)->first();
        $to_user_id = $to_user_id_req->to_user_id; 
        $user = \Auth::user();
        if ($to_user_id_req !== null) {                                        //Если комментарий существует
            if (($to_user_id_req->user_id == $user->id) || ($to_user_id_req->to_user_id == $user->id)) {
                                                                                //Если я автор или на домашней
                Comments::where('id','=',$comment_id)->delete();                //Удаляю коммент
                Comments::where('is_answer_id','=',$comment_id)->update(['comment_text' => 'Ответ на удаленный комментарий','title' => 'Ответ на удаленный комментарий', 'is_answer_id' => null]);
                $comments = Comments::where('to_user_id','=',$to_user_id)->take(5)->get();
                return view('/home', compact('comments', 'to_user_id', 'user'));  
            } else {                                                             //Если я нет прав на удаление
                return view('welcome', compact('user'));       
            }
        } else {                                                                 //Если коммента не существует
            return view('welcome', compact('user'));   
        }
    }

    public function add_comment(Request $request,$to_user_id)
    {   
        $text = strval($request->text);
        $title = strval($request->title);        
        $user = \Auth::user();
        Comments::insert(['user_id' => $user->id, 'to_user_id' => $to_user_id,'title' =>$title, 'comment_text' => $text]);
        $comments = Comments::where('to_user_id','=',$to_user_id)->take(5)->get();
        return view('home', compact('comments', 'to_user_id', 'user'));
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
    $comments = Comments::where('id','=',$comment_id)->first(); //нахожу комментарий на который отвечаю
    $user = \Auth::user();
    if (($comments !== null) && ($user !== null)) {             //Проверка наличия комментария
    $text = $request->text; // мой ответ
    $title = $request->title;  // мой ответ
    $to_user_id = $comments->to_user_id;
    Comments::insert(['user_id' => $user->id, 'to_user_id' => $to_user_id,'title' =>$title, 'comment_text' => $text, 'is_answer_id' => $comment_id]);
    $comments = Comments::where('to_user_id','=',$to_user_id)->take(5)->get();
    return view('home', compact('comments', 'to_user_id', 'user'));
}  else {
    return view('welcome', compact('user'));         
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

public function my_comments()
{   

    $user = \Auth::user();
    $to_user_id = $user->id;
    $comments = Comments::where('user_id','=',$user->id)->get();
    return view('my_comments.my_comments', compact('comments'));

}
}
