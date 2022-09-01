<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model
{
    use HasFactory;

    protected $table = "like_comment";

    protected $fillable = [
        'post_id',
        'user_id',
        'status',
        'updated_at',
        'created_at',
    ];

}
