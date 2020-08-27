<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendNotificationRequest extends FormRequest
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
            'recipients' => 'required',
            'subject' => 'required',
            'body' => 'required'
        ];
    }

    public function messages(){
        return [
            'recipients.required' => 'Nezadali ste príjemcov správy.',
            'subject.required' => 'Nezadali ste predmet správy.',
            'body.required' => 'Nezadali ste text správy.'
        ];
    }
}
