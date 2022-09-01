<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollOptions extends Model
{
    use HasFactory;

    protected $table = "poll_options";
    protected $fillable = [
        'poll_id',
        'name'
    ];


    public function totalVote() {
        $optionTotal = Vote::where('poll_option_id', $this->id)->count();
        return $optionTotal;
        
        // $total = Vote::where('poll_id', $this->poll_id)->count();

        // return $total ? ($optionTotal / $total) * 100 : 0;
    }

    public function getAvgVoting() {
        $optionTotal = Vote::where('poll_option_id', $this->id)->count();
        $total = Vote::where('poll_id', $this->poll_id)->count();

        return $total ? ($optionTotal / $total) * 100 : 0;
    }
}
