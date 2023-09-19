
    <div class="container">
        <h1>日付: {{ $date }}</h1>
        @if($posts->count() > 0)
            <ul>
                @foreach($posts as $post)
                    <li>

                    </li>
                @endforeach
            </ul>
        @else
            <p>該当する投稿はありません。</p>
        @endif
    </div>
