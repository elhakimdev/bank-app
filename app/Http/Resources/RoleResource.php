<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            "id"                        => $this->id,
            "name"                      => $this->name,
            "guard_name"                => $this->guard_name,
            "created_at"                => date_format($this->created_at, 'D-M-Y h:i:s'),
            "updated_at"                => date_format($this->updated_at, 'D-M-Y h:i:s'),
            "relations"                     => [
                "assigned_permissions"      => new PermissionCollection($this->whenLoaded('permissions'))
            ]
        ];
    }
}
