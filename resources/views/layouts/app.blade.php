<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">  
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {    
       $('#get_more_comments').click(function () {
        var test = $('#get_more_comments').val();
        $.ajax({
          url: '/get_more_comments',
          type: 'GET',
          data: {test : test},
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            var comment = data;
            for(var i = 5; i<comment.length; i++){
              if (comment[i].is_answer_id !== null) {
                for(var j = 0; j<comment.length; j++){
                    if (comment[j].id == comment[i].is_answer_id) {
                        $('.card-body').append('<br><p>FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF</p><h1>'+comment[j].title+'</h1><p>'+comment[j].comment_text+'</p><p>FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF</p><br>') 
                    }
                }
                $('.card-body').append('<form action="/delete_comment"><br><h1>'+comment[i].title+'</h1><p>'+comment[i].comment_text+'</p><br><button name="delete" value="'+ comment[i].id +'">Удалить</button><br><a href="/answer'+ comment[i].id +'">Ответить</a></form>')    
            } else {
                $('.card-body').append('<form action="/delete_comment"><br><h1>'+comment[i].title+'</h1><p>'+comment[i].comment_text+'</p><br><button name="delete" value="'+ comment[i].id +'">Удалить</button><br><a href="/answer'+ comment[i].id +'">Ответить</a></form>')
            }
        };
        console.log(comment);
    }
});
        $('#get_more_comments').hide();
    });

       $('#any_get_more_comments').click(function () {
        var test = $('#any_get_more_comments').val();
        $.ajax({
          url: '/get_more_comments',
          type: 'GET',
          data: {test : test},
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            var comment = data;
            var id = $('#user_id').attr('class');
            for(var i = 5; i<comment.length; i++){
              if (comment[i].is_answer_id !== null) {
                for(var j = 0; j<comment.length; j++){
                    if (comment[j].id == comment[i].is_answer_id) {
                        $('.card-body').append('<br><p>FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF</p><h1>'+comment[j].title+'</h1><p>'+comment[j].comment_text+'</p><p>FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF</p><br>') 
                    }
                }
                if (comment[i].user_id == id) {    
                    $('.card-body').append('<form action="/delete_comment"><br><h1>'+comment[i].title+'</h1><p>'+comment[i].comment_text+'</p><br><button name="delete" value="'+ comment[i].id +'">Удалить</button><br></form>');
                    console.log('comment');
                } else {
                    $('.card-body').append('<form action=""><br><h1>'+comment[i].title+'</h1><p>'+comment[i].comment_text+'</p><br></form>') 
                }   
            } else {

                if (comment[i].user_id == id) {    
                    $('.card-body').append('<form action="/delete_comment"><br><h1>'+comment[i].title+'</h1><p>'+comment[i].comment_text+'</p><br><button name="delete" value="'+ comment[i].id +'">Удалить</button><br></form>');
                    console.log('comment');
                } else {
                    $('.card-body').append('<form action=""><br><h1>'+comment[i].title+'</h1><p>'+comment[i].comment_text+'</p><br></form>') 
                }

            }
        };
        console.log(id);
    }
});     
        $('#any_get_more_comments').hide();
    });

       $('#spy_get_more_comments').click(function () {
        var test = $('#spy_get_more_comments').val();
        $.ajax({
          url: '/get_more_comments',
          type: 'GET',
          data: {test : test},
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            var comment = data;
            for(var i = 5; i<comment.length; i++){
             $('.card-body').append('<form action=""><br><h1>'+comment[i].title+'</h1><p>'+comment[i].comment_text+'</p><br></form>'); 
        };
        console.log(id);
    }
}); 
        $('#spy_get_more_comments').hide();
    });

   });
</script> 
</body>

</html>
