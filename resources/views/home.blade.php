@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

       <div class="card-body">

          @forelse ($comments as $comment)
          <form action="/delete_comment">
            <h1>{{$comment->title}}</h1>
            <p>{{$comment->comment_text}}</p><br>
            <button name="delete" value="{{$comment->id}}">Удалить</button><br>
            <a href="">Ответить</a>
          </form>




        @empty

      <div class="form">
        <form action="/add_comment/{{$to_user_id}}" method="post">
          {{ csrf_field() }}
          <input type="text" name="title"><br>
          <input type="text" name="text" size="100"><br>
          <input type="submit" name="Оставить комментарий">
        </form>
      </div>
      @endforelse
        </div>
      </div>
      @if(count($comments) > 0)
<input type="button" name="hi" value = "{{$to_user_id}}" id="get_more_comments">    
    <div class="form">
      <form action="/add_comment/{{$to_user_id}}" method="post">
        {{ csrf_field() }}
        <input type="text" name="title"><br>
        <input type="text" name="text" size="100"><br>
        <input type="submit" name="Оставить комментарий">
      </form>
          </div>
         @endif 
            <div><a href="/my_comments">Комментарии которые я оставил</a></div>
        </div>
    </div>
</div>
@endsection
