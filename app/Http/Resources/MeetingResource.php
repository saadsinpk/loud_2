<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'ended' => $this->ended,
            'streamid' => $this->streamid,
            'streamtitle' => $this->streamtitle,
            'hostimage' => $this->hostimage,
            'hostname' => $this->hostname
        ];
    }

}
