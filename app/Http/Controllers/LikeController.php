<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // public function like(Request $request, Post $post)
    // {
    //     $like = New Like();
    //     $like->post_id = $post->id;
    //     $like->user_id = Auth::user()->id;
    //     $like->save();
    //     return back();
    // }

    // public function unlike(Request $request, Post $post)
    // {
    //     $user = Auth::user()->id;
    //     $like = Like::where('post_id', $post->id)->where('user_id', $user)->first();
    //     $like->delete();
    //     return back();
    // }
}