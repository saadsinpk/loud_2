<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'media' => $this->media,
            'created_at' => $this->created_at,
            'user' => new UserResource($this->user),
            'group' => new GroupResource($this->group),
            'totalComments' => $this->comment()->count(),
            'totalLikes' => $this->like()->count(),
            'totalDislikes' => $this->dislike()->count()
        ];
    }

}
