<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = "report";

    protected $fillable = [
        'state',
        'lga',
        'user_id',
        'category',
        'title',
        'is_annoymous',
        'media',
        'message',
        'view_count',
        'updated_at',
        'created_at',
    ];

}
