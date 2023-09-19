<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tag_id',
        'title',
        'body',
        'start_date',
        'end_date',
        
    ];
    
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    // 実装1
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    // 実装2
    // Viewで使う、いいねされているかを判定するメソッド。
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
    
    
    // public function user()
    // {
    //     return $this->belongTo(User::class);
    // }
}
