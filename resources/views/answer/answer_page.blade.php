@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Комментарии которые я оставил</div>

                <div class="card-body">
                    {{$auther->name}}<br>
                    {{$comments->comment_text}}<br>
                  <div class="form">
                    <form action="/add_answer/{{$comments->id}}" method="post">
                      {{ csrf_field() }}
                      <input type="text" name="title"><br>
                      <input type="text" name="text" size="100"><br>
                      <input type="submit" name="Оставить комментарий">
                  </form>
              </div>
          </div>
      </div>

      <div><a href="/home">На мою стену</a></div>
  </div>
</div>
</div>
@endsection
