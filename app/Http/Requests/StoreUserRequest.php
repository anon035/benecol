<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required', 
            'surname' => 'required', 
            'email' => 'required|unique:users', 
            'registration_number' => 'required|unique:users', 
            'phone_number' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Nezadali ste meno.',
            'surname.required' => 'Nezadali ste priezvisko.',
            'email.required' => 'Nezadali ste email.',
            'email.unique' => 'Email už existuje.',
            'registration_number.required' => 'Nezadali ste registračné číslo.',
            'registration_number.unique' => 'Registračné číslo už existuje.',
            'phone_number.required' => 'Nezadali ste telefónne číslo.'
        ];
    }
}
