<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property text $hash
 * @property text $data
 * @property dateTime $expires
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */
class Ticket extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'hash',
        'data',
        'expires',
    ];

    protected $table = 'tickets';
}
