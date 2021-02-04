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
                        <button name="delete" value="{{$comment->id}}">Удалить</button>
                      </form>
                    @endforeach

                    <input type="button" name="hi" id="get_more_comments">
                </div>
            </div>
            <div class="form">
                <form action="/add_comment/{{$comment->user_id}}" method="post">
                    {{ csrf_field() }}
                    <input type="text" name="title"><br>
                    <input type="text" name="text" size="100"><br>
                    <input type="submit" name="Оставить комментарий">
                </form>
            </div>

            <div><a href="/my_comments">Комментарии которые я оставил</a></div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
   $('#get_more_comments').click(function () {
    alert("тест");
    $.ajax({
      url: '/get_more_comments',
      type: 'POST',
      data: {},
      error:function(){
      console.log('ошибка');
      },
      success: function() {
      /*$('.card-body').append('<form action="/delete_comment"><h1>{{$comment->title}}</h1><p>{{$comment->comment_text}}</p><br><button name="delete" value="{{$comment->id}}">Удалить</button></form>');*/
      console.log(1);
      }
    });
  });
</script>
@endsection
