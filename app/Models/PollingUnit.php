<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $lga_id
 * @property int $wards_id
 * @property string $accredited
 * @property string $registered_voters
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class PollingUnit extends Model
{
    use HasFactory , SoftDeletes ;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'accredited',
        'registered_voters',
        'lga_id',
        'wards_id'
    ];

    protected $table = 'polling_units';

    /**
     * Get election.
     */
    public function election()
    {
        return $this->morphOne(Election::class, 'model');
    }
    
    public function lga(){
        return $this->belongsTo(Lga::class);
    }

    public function ward(){
        return $this->belongsTo(Ward::class, 'wards_id');
    }

}
