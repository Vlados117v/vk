@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Редактировать</div>
        <div class="card-body">
          <form action="/add_change_book/{{$book->id}}">
            <label for="title">Название <input type="text" name="title"></label><br>
            <textarea name="text" rows="10" cols="45">Текст книги</textarea><br>
            <button type="submit">Редактировать книгу</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
