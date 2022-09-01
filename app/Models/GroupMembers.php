<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMembers extends Model
{
    use HasFactory;

    protected $table = "group_members";

    protected $fillable = [
        'group_id',
        'member_id',
        'updated_at',
        'created_at',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }

}
