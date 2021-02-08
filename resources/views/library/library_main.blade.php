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
          <a href="">Прочитать</a><br>
          <a href="">Редактировать</a><br>
          <a href="/delete_book/{{$book->id}}">Удалить</a><br></div>
          @empty
          @endforelse
          </div>
          <a href="/new_book">Создать книгу</a>
      </div>
    </div>
  </div>
</div>
@endsection
