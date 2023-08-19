<x-app-layout>
        <h1>新規投稿</h1>
        <form action='/posts' method="POST">
            @csrf
            <div>
                <label>#</label>
                <input type='text' name='tag_name' id='tag_name' placeholder='タグ' />
            </div>
            <div>
                <div>
                    <label>date</label>
                    <input type='date' name='start_date' id='start_date' />
                </div>
                
            </div>
            <div>
                <div>
                    <label>title</label>
                    <input type='text' name='title' placeholder='title' />
                </div>
                <div>
                    <label>body</label>
                    <input type='text' name='body' placeholder='body' />
                </div>
            </div>
            <div>
                <button type='submit'>投稿</button>
            </div>
        </form>
    </x-app-layout>