@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Library</div>
        <div class="card-body">
          <h1>{{$book->title}}</h1><br>
          <br>
          <p>{{$book->text}}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
