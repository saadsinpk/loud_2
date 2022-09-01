<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PollOptionResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'option' => $this->name,
            'voting' => $this->getAvgVoting(),
            'total_vote' => $this->totalVote(),
        ];
    }

}
