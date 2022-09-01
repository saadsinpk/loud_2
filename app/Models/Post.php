<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable = [
        'title',
        'description',
        'media',
        'user_id',
        'group_id',
        'view_count',
        'updated_at',
        'created_at',
    ];

    public function comment() {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function like() {
        return $this->hasMany(LikeComment::class, 'post_id', 'id')->where('status', 'LIKE');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function group() {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function dislike() {
        return $this->hasMany(LikeComment::class, 'post_id', 'id')->where('status', 'DISLIKE');
    }

}
