<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $lga_id
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class Ward extends Model
{
    use HasFactory , SoftDeletes ;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'lga_id'
    ];

    protected $table = 'wards';

    public function lga(){
        return $this->belongsTo(Lga::class);
    }

    public function pollingUnit(){
        return $this->hasMany(PollingUnit::class);
    }

}
