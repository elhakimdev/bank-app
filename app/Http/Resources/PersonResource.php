<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            "id"                         => $this->id,
            "first_name"                 => $this->firstname,
            "last_name"                  => $this->lastname,
            "full_name"                  => $this->firstname . ' ' . $this->lastname,
            "phone_number"               => $this->phone,
            "address"                    => $this->address,
            "created_at"                 => date_format($this->created_at, 'D-M-Y h:i:s'),
            "updated_at"                 => date_format($this->updated_at, 'D-M-Y h:i:s'),
            "relations"                  => [
                "user"                   => new UserResource($this->whenLoaded('user'))
            ]
        ];
    }
}
