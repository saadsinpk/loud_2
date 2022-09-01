<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory ,SoftDeletes;
    protected $guarded = [];

    public function hasBranch()
    {
        return $this->hasOne(Branch::class , 'id' , 'branch_id');
    }

    public function hasRole(){
        return $this->hasOne(Role::class, 'id' , 'lead_asign');
    }
}
