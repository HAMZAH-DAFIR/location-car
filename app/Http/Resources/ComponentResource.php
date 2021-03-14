<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComponentResource extends JsonResource
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
            'name' => $this->name,
            'serie' => $this->serie,
            'type' => $this->type,
            'color' => $this->color,
            'quantite' => $this->quantite,
            'price' => $this->price,
        ];
    }
}
