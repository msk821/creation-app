<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
        const schedules = @json($schedulesJson);
        </script>
    </head>
<body>
     <div id="calendar2" class="mt-12"></div>
        <div class="calendar-search">
            <form id="search-form" action="/calendar/search" method="POST">
                @csrf
                <label for="">タスク検索</label>
                <input id="search-input" type="text" name="tag" placeholder="タスク名を入力">
                <button class="btn-b" type="submit">検索</button>
            </form>
        </div>
</body>
</html>