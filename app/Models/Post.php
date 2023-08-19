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
        'date',
        'title',
        'body'
    ];
    
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    
}
