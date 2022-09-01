<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $table = "polls";

    protected $fillable = [
        'user_id',
        'question',
        'hide_creator_detail',
        'is_people_share',
        'ends_in',
        'view_count',
        'is_free'
    ];

    public function votes() {
        return $this->hasMany(Vote::class, 'poll_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the options.
     */
    public function options() {
        return $this->hasMany(PollOptions::class, 'poll_id');
    }
    public function totalVote() {
        $total = Vote::where('poll_id', $this->id)->count();
        return $total;
    }
    

}
