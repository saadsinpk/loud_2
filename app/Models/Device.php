<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $device_id
 * @property string $device_type
 * @property string $firebase_token
 * @property string $os_version
 * @property boolean $visitor
 * @property int $user_id
 * @property date $created_at
 * @property date $updated_at
 */

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'device_type',
        'firebase_token',
        'os_version',
        'visitor',
        'user_id'
    ];

    protected $table = 'devices';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
