<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mechanic_id' => $this->mechanic_id,
            'damage_id' => $this->damage_id,
            'description' => $this->description,
            'totalprice' => $this->totalprice,
        ];
    }
}
