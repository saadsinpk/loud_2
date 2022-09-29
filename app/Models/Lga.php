<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $state_id
 * @property int $federal_constituency_id
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class Lga extends Model
{
    use HasFactory , SoftDeletes ;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'state_id',
        'federal_constituency_id',
    ];

    protected $table = 'lgas';


    public function state(){
        return $this->belongsTo(State::class , 'state_id');
    }

    public function federalConstituency(){
        return $this->belongsTo(FederalConstituency::class , 'federal_constituency_id');
    }

    public function wards(){
        return $this->hasMany(Ward::class);
    }

    public function pollingUnit(){
        return $this->hasMany(PollingUnit::class);
    }

}
