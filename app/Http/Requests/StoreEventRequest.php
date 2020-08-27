<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'event_date' => 'required', 
            'event_type' => 'required', 
            'event_time' => 'required', 
        ];
    }

    public function messages(){
        return [
            'event_date.required' => 'Nezadali ste dátum udalosti.',
            'event_type.required' => 'Nevybrali ste druh udalosti.',
            'event_time.required' => 'Nezadali ste čas udalosti.'
        ];
    }
}
