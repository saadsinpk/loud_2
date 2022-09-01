<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    use HasFactory;

    protected $table = "live";

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'media',
        'updated_at',
        'created_at',
    ];

}
