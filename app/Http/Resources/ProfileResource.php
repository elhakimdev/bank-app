<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            "first_name"            => $this->first_name,
            "last_name"             => $this->last_name,
            "full_name"             => $this->first_name . " " . $this->last_name,
            "gender"                => $this->gender,
            "address"               => $this->address,
            "phone_number"          => $this->phone_number,
            "created_at"            => date_format($this->created_at, 'D-M-Y h:i:s'),
            "updated_at"            => date_format($this->updated_at, 'D-M-Y h:i:s'),
            "relations"             => [
                "user"              => new UserResource($this->whenLoaded('user'))
            ]
        ];
    }
}
