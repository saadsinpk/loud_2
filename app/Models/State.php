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

class State extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $table = 'states';

    public function senatorialDistrict(){
        return $this->hasMany(SenatorialDistrict::class);
    }

    public function lga(){
        return $this->hasMany(Lga::class);
    }

    
}
