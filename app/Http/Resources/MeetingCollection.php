<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MeetingCollection extends ResourceCollection {

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = MeetingResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'data' => $this->collection,
            'pagination' => [
                'size' => $this->perPage(),
                'total' => $this->total(),
                'current' => $this->currentPage(),
            ],
        ];
    }

}
