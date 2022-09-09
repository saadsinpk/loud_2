<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Role_Permissions;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        $role=$this->roles;
        if(isset($role->toArray()[0])) {
            $role_id=$role->toArray()[0]['id'];
            $role_name=$role->toArray()[0]['name'];
        } else {
            $role_id=0;
            $role_name = 'No Roles Selected';
        }
        $permission_names=Role_Permissions::where("role_id","=",$role_id)->with("permission")->get();
        $permission_name = array();
        foreach ($permission_names as $permission_name_key => $permission_name_value) {
            $permission_name[] = $permission_name_value->permission->name;
        }

        return [
            'id' => $this->id,
            'name' => ucwords($this->name),
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'age' => $this->age,
            'roles' => array("name"=>$role_name,"permissions"=>$permission_name),
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
