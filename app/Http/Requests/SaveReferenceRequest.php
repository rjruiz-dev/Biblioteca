<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveReferenceRequest extends FormRequest
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
            'reference_description'  => 'required|string|unique:generate_references',          
        ];
    }

    public function messages()
    {
        return [

            'reference_description.required'  => 'Debe introducir una referencia.',            
            'reference_description.unique'    => 'La referencia ya ha sido registrada.'
        ];
    }
}
