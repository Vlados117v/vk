@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    @foreach ($comments as $comment)
                    <form action="/delete_comment">
                        <h1>{{$comment->title}}</h1>
                        <p>{{$comment->comment_text}}</p><br>
                        @if (($user != 0) && ($user->id == $comment->user_id))
                        <button name="delete" value="{{$comment->id}}">Удалить</button>
                        @endif
                      </form>
                    @endforeach

                    <input type="button" name="hi" id="get_more_comments">
                </div>
            </div>
            @if ($user != 0)
            <div class="form">
                <form action="/add_comment/{{$to_user_id}}" method="post">
                    {{ csrf_field() }}
                    <input type="text" name="title"><br>
                    <input type="text" name="text"><br>
                    <input type="submit" name="Оставить комментарий">
                </form>
             @endif   
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
   $('#get_more_comments').click(function () {
    $.ajax({
      url: '/get_more_comments',
      type: 'POST',
      data: {},
      success: function() {
      /*$('.card-body').append('<form action="/delete_comment"><h1>{{$comment->title}}</h1><p>{{$comment->comment_text}}</p><br><button name="delete" value="{{$comment->id}}">Удалить</button></form>');*/
      console.log(1);
      }
    });
  });
</script>
@endsection
