<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comment";

    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
        'parent_id',
        'updated_at',
        'created_at',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function parent() {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }


}
