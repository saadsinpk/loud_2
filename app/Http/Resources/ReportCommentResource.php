<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportCommentResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'user' => new UserResource($this->user),
            'parent' => new ReportCommentResource($this->parent)
        ];
    }

}
