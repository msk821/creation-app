<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Tag;
use App\Models\Schedule;
use App\Models\Like;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $user = auth()->user();
        $posts = Post::withCount('likes')->orderByDesc('updated_at')->get();
        return view('posts.index', ['posts' => $posts,]);
        
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Post $post, PostRequest $request)
    {
        $validated = $request->validated();
        $post->fill($validated);
        $user = auth()->user();
        $post->user_id = $user->id;
        //$post->tag_id = 1;
        // フォームから日付を取得
        $inputDate = $request->start_date; // フォームのinput名を指定

        // Carbonを使用して日付をY-m-dのフォーマットに変換
        $formattedDate = Carbon::createFromFormat('Y-m-d', $inputDate)->format('Y-m-d');
        $post->start_date=$formattedDate;
        $post->end_date=$formattedDate;
        
        
        $tagName = $request->input('tag_name');
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        
        $post->tag_id=$tag->id;
        
        $post->save();
        
        
        
        
        
        return redirect('/'); 
    }
    
    public function like(Request $request)
    {
        $user_id = Auth::user()->id; // ログインしているユーザーのidを取得
        $post_id = $request->post_id; // 投稿のidを取得

        // すでにいいねがされているか判定するためにlikesテーブルから1件取得
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); 

        if (!$already_liked) { 
        $like = new Like; // Likeクラスのインスタンスを作成
        $like->post_id = $post_id;
        $like->user_id = $user_id;
        $like->save();
    } else {
        // 既にいいねしてたらdelete 
        Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }
    // 投稿のいいね数を取得
        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); // JSONデータをjQueryに返す
}
    
    public function calendar() {
        session()->forget('last_searched_tag');
        $schedules = Schedule::with('post')->get();
        $schedulesJson = $schedules->toJson();
        return view('schedules.index')->with(['schedules' => $schedules, 'schedulesJson' => $schedulesJson]);
        
    }
    
     public function getTasksByDate(Request $request)
    {
        $date = $request->query('date'); // クエリパラメーターから日付を取得
        $lastSearchedTag = session('last_searched_tag');
        
        if($lastSearchedTag)
        {
            $posts = Post::where('start_date', $date)->whereHas('tag', function ($query) use ($lastSearchedTag) {
             $query->where('name', $lastSearchedTag);})
             ->get();
        }
        else
        {
            $posts = Post::where('start_date',$date)->get();
        }
        
        
        
        return view('schedules.list', compact(['posts', 'date']));
    }

    public function searchTasks(Request $request) {
        // バリデーション
        $request->validate([
            'tag' => 'required|string',
        ]);
    
        $tag = $request->input('tag');
        session(['last_searched_tag' => $tag]);
        
    
        // 予定取得処理（これがaxiosのresponse.dataに入る）
        $posts = Post::select(
            'id',
            'title as title',
            'body as description',
            'start_date as start',
            'end_date as end',
        )
        //->where('title', $title)
        ->whereHas('tag', function ($query) use ($tag) {
             $query->where('name', $tag);
         })
        ->get();
        
    
        return $posts;
    }
    
    
}
?>
