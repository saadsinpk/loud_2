<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $table = "meeting";

    protected $fillable = [
        'ended',
        'streamid',
        'streamtitle',
        'hostimage',
        'hostname',
        'updated_at',
        'created_at',
    ];

}
