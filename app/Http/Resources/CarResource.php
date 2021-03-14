<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'model' => $this->model,
            'carNumber' => $this->carNumber,
            'horse' => $this->horse,
            'kilometers' => $this->kilometers,
            'dor' => $this->dor,
            'fuel' => $this->fuel,
            'type' => $this->type,
            'luggage' => $this->luggage,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'agence_id' => $this->agence_id,
            'in_agaence' => $this->in_agaence,
        ];
    }
}
