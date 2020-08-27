<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactMailRequest extends FormRequest
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
            'email' => 'required',
            'msg' => 'required',
            'subject' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Nezadali ste meno.',
            'surname.required' => 'Nezadali ste priezvisko.',
            'email.required' => 'Nezadali ste email.',
            'msg.required' => 'Nezadali ste správu.',
            'subject.required' => 'Nezadali ste predmet správy.'
        ];
    }
}
