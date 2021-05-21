<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id"                    => $this->id,
            "name"                  => $this->name,
            "email"                 => $this->email,
            "email_verified_at"     => date_format($this->email_verified_at, 'D-M-Y h:i:s'),
            "created_at"            => date_format($this->created_at, 'D-M-Y h:i:s'),
            "updated_at"            => date_format($this->updated_at, 'D-M-Y h:i:s'),
            "relations"             => [
                "profiles"          => new ProfileResource($this->whenLoaded('profile')),
                "roles"             => new RoleCollection($this->whenLoaded('roles')),
                "permisssions"      => new PermissionCollection($this->whenLoaded('permissions')),
            ]
        ];
    }
}
