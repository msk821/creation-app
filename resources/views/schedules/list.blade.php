
    <div class="container">
        <h1>日付: {{ $date }}</h1>
        @if($posts->count() > 0)
        <div class='post'>
                @foreach($posts as $post)
                <h2 class='title'>{{ $post->title }}</h2>
                <a href="{{ route('tags.index', $post->tag) }}">{{ $post->tag->name }}</a>
                <p class='body'>{{ $post->body }}</p>
                @endforeach
        </div>
        @else
            <p>該当する投稿はありません。</p>
        @endif
    </div>
