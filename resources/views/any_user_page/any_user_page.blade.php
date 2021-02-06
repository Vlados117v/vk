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
            @if (!is_null($comment->is_answer_id))
               @foreach ($comments as $second_iteration_comm)
                  @if ($comment->is_answer_id == $second_iteration_comm->id)
                     <p>-------------------------------------------</p>
                     <h1>{{$second_iteration_comm->title}}</h1>
                     <p>{{$second_iteration_comm->comment_text}}</p><br>
                     <p>-------------------------------------------</p>
                  @endif
                @endforeach
            @endif     
            <h1>{{$comment->title}}</h1>
            <p>{{$comment->comment_text}}</p><br>
           @if ($user->id == $comment->user_id) <button name="delete" value="{{$comment->id}}">Удалить</button><br>
           @endif
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
<input type="button" name="hi" value = "{{$to_user_id}}" id="any_get_more_comments">    
    <div class="form">
      <form action="/add_comment/{{$to_user_id}}" method="post">
        {{ csrf_field() }}
        <input type="text" name="title"><br>
        <input type="text" name="text" size="100"><br>
        <input type="submit" name="Оставить комментарий">
      </form>
          </div>
         @endif 
         <div id="user_id" class="{{$user->id}}" ></div>
    </div>
  </div>
</div>
@endsection
