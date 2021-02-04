@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Комментарии которые я оставил</div>

                <div class="card-body">

                    @foreach ($comments as $comment)
                    <form action="/delete_comment">
                        <h1>{{$comment->title}}</h1>
                        <p>{{$comment->comment_text}}</p><br>
                      </form>
                    @endforeach
                </div>
            </div>

            <div><a href="/home">На мою стену</a></div>
        </div>
    </div>
</div>
@endsection
