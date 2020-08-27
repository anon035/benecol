<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
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
            'event_type' => 'required',
            'category_id' => 'required',
            'is_present' => 'required'
        ];
    }

    public function messages(){
        return [
            'event_type.required' => 'Nevybrali ste typ udalosti.',
            'category_id.required' => 'Nevybrali ste kategóriu.',
            'is_present.required' => 'Nevybrali ste žiadnych účastníkov.'
        ];
    }
}
