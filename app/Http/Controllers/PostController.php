<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Tag;
use App\Models\Schedule;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->get()]);
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
        
        
        
        $tagName = $request->input('tag_name');
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        
        
        
        
        $post->tag_id=$tag->id;
        
        $post->save();
        
        $schedule = new Schedule();
        $schedule->start_date = $request->input('start_date');
        $schedule->end_date = $request->input('start_date');
        $schedule->post_id=$post->id;
        $schedule->save();
        
        
        return redirect('/'); 
    }
}
?>