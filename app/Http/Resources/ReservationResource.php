<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'car_id' => $this->car_id,
            'user_id' => $this->user_id,
            'agent_id' => $this->agent_id,
            'date_start' => $this->date_start,
            'date_back' => $this->date_back,
            'time_start' => $this->time_start,
            'time_back' => $this->time_back,
            'agenceBack_id' => $this->agenceBack_id,
            'confiremed' => $this->confiremed,
        ];
    }
}
