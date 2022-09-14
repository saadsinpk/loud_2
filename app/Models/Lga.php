<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
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
        //'status'
    ];

    protected $table = 'lgas';

    public function wards(){
        return $this->hasMany(Ward::class);
    }

    public function pollingUnit(){
        return $this->hasMany(PollingUnit::class);
    }

}
