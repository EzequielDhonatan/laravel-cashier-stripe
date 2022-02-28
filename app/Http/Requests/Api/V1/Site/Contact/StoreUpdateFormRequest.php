<?php

namespace App\Http\Requests\Api\V1\Site\Contact;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFormRequest extends FormRequest
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

            'name'      => 'required|string|min:3|max:100',
            'email'     => 'required|email|max:200',
            'subject'   => 'required|string|min:3|max:200',
            'message'   => 'required|string|min:3|max:255'

        ]; // return

    } // rules

} // StoreUpdateFormRequest
