<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveLenguageRequest extends FormRequest
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
            $rules ['leguage_description']   = 'required|string|unique:lenguages'. $this->id;
        }

        return $rules;
        
    }

    public function messages()
    {
        return [

            'leguage_description.required'  => 'Debe introducir un nombre de idioma.',            
            'leguage_description.unique'    => 'El idioma ya ha sido registrado.'
        ];
    }
}
