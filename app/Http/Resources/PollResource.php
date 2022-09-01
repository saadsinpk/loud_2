<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PollResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'hide_creator_detail' => $this->hide_creator_detail,
            'is_people_share' => $this->is_people_share,
            'ends_in' => $this->ends_in,
            'options' => PollOptionResource::collection($this->options),
            'total_votes' => $this->totalVote(),
            'user' => new UserResource($this->user)
        ];
    }

}
