<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- ※以下は、@vite(['resources/css/app.css', 'resources/js/app.js'])の下に記述 --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    </head>
    <body>
        <h1>投稿一覧</h1>
        <div class="footer">
            <a href="/create">投稿</a>
            <a href="/calendar">マイページ</a>
        </div>
        <div class='posts'>
            
            @foreach($posts as $post)
            <div class='post'>
                <h2 class='title'>{{ $post->title }}</h2>
                <a href="{{ route('tags.index', $post->tag) }}">{{ $post->tag->name }}</a>
                <p class='body'>{{ $post->body }}</p>
                
                @auth
                <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
                @if (!$post->isLikedBy(Auth::user()))
                    <span class="likes">
                        <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                    </span><!-- /.likes -->
                @else
                    <span class="likes">
                        <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                    </span><!-- /.likes -->
                    @endif
                    @endauth
            </div>
            @endforeach
           
        </div>
    </body>
</html>