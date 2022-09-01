<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportComments extends Model
{
    use HasFactory;

    protected $table = "comment_report";

    protected $fillable = [
        'post_id',
        'user_id',
        'status',
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
