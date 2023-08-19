<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ $tag->name }}の投稿</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>{{ $tag->name }}の投稿</h1>
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





