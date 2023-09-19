<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ $tag->name }}の投稿</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <h1>{{ $tag->name }}の投稿</h1>
    <div class="footer">
        <a href="/">投稿一覧</a>
        <a href="/create">投稿</a>
        <a href="/calendar">マイページ</a>
    </div>
    <div class='posts'>
        @foreach($posts as $post)
        <div class='post'>
            <h2 class='date'>{{ $post->date }}</h2>
            <h2 class='title'>{{ $post->title }}</h2>
            <p class='body'>{{ $post->body }}</p>
        </div>
        @endforeach
    </div>
</body>
</html>





