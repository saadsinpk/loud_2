<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'state' => $this->state,
            'lga' => $this->lga,
            'category' => $this->category,
            'title' => $this->title,
            'media' => $this->media,
            'message' => $this->message,
            'is_anonymous' => $this->is_anonymous,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'user' => $this->is_anonymous === 'NO' ? new UserResource($this->user) : null
        ];
    }

}
