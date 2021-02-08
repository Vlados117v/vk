@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Список пользователей</div>

                <div class="card-body">
                    <ul>
                    @foreach ($users as $user)
                    <li><p><a href="/home{{$user->id}}">{{$user->name}} - {{$user->email}}</a></p></li>
                    @endforeach
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
