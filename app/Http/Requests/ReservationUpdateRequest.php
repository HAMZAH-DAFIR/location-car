<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'car_id' => ['required', 'integer', 'exists:cars,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'agent_id' => ['integer', 'exists:agents,id'],
            'date_start' => ['required', 'unique:reservations,date_start'],
            'date_back' => ['required', 'unique:reservations,date_back'],
            'time_start' => ['required', 'integer', 'unique:reservations,time_start'],
            'time_back' => ['required', 'integer', 'unique:reservations,time_back'],
            'agenceBack_id' => ['required', 'integer', 'exists:agenceBacks,id'],
            'confiremed' => ['required'],
        ];
    }
}
