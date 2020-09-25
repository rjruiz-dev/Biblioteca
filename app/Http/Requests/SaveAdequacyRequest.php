<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveAdequacyRequest extends FormRequest
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
        $rules = [ 
          
        ];        
        
        // Si es diferente a Post
        if($this->method() !== 'PUT')
        {   
            $rules ['adequacy_description']   = 'required|string|unique:adequacies'. $this->id;
        }

        return $rules;
        
    }

    public function messages()
    {
        return [

            'adequacy_description.required'  => 'Debe introducir una adecuacíon.',            
            'adequacy_description.unique'    => 'La adecuación ya ha sido registrada.'
        ];
    }
}
