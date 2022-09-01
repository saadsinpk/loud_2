<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        // if(user::where("id", $this->id)->first()->hasRole('user')) {
        //     $role = 'user';
        // } else {
        //     $role = 'admin';
        // }
        return [
            'id' => $this->id,
            'name' => ucwords($this->name),
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'age' => $this->age,
            // 'role' => $role,
            'profile_picture' => $this->profile_picture,
            'country' => $this->country,
            'city' => $this->city,
            'state' => $this->state,
            'lga' => $this->lga,
            'platform' => $this->platform,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
