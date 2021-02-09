@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Library</div>
        <div class="card-body">
          @forelse ($books as $book)
         <div><h1>{{$book->title}}</h1><br>
          <a href="/read_book/{{$book->id}}">Прочитать</a><br>
          <a href="/delete_book/{{$book->id}}">Удалить</a><br></div>
          @if ($this_user_id == $user->id)
          <a href="/change_book/{{$book->id}}">Редактировать</a><br>
          <a href="/access_for_all/{{$book->id}}">Открыть доступ по ссылке</a><br></div>
          @endif
          @empty
          @endforelse
          @if ($this_user_id == $user->id)
          <a href="/new_book/{{$this_user_id}}">Создать книгу</a>
          @endif
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
