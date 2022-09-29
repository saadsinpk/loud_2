<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SenatorialDistrict extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'state_id',
    ];

    protected $table = 'senatorial_districts';

    public function state(){
        return $this->belongsTo(State::class , 'state_id');
    }

    public function federalConstituency(){
        return $this->hasMany(FederalConstituency::class);
    }

}
