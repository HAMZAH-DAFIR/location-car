<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:50'],
            'carNumber' => ['required', 'integer'],
            'horse' => ['required', 'integer'],
            'kilometers' => ['required', 'integer'],
            'dor' => ['required', 'integer'],
            'fuel' => ['required', 'string', 'max:20'],
            'type' => ['required', 'string', 'max:5'],
            'luggage' => ['required', 'integer'],
            'status' => ['required', 'in:available,reserved,crash,reforme,inavalable'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'agence_id' => ['required', 'integer', 'exists:agences,id'],
            'in_agaence' => ['required'],
        ];
    }
}
