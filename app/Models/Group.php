<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = "groups";

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'access',
        'media',
        'updated_at',
        'created_at',
    ];

    public function groupmember() {
        return $this->hasMany(GroupMembers::class, 'group_id', 'id');
    }

}
