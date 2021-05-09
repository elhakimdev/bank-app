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
            "id"                        => $this->id,
            "firstname"                 => $this->firstname,
            "lastname"                  => $this->lastname,
            "fullname"                  => $this->firstname . ' ' . $this->lastname,
            "created_at"                => date_format($this->created_at, 'D-M-Y h:i:s'),
            "updated_at"                => date_format($this->updated_at, 'D-M-Y h:i:s'),
            "relations"                 => [
                "user" => $this->user
            ]
        ];
    }
}
