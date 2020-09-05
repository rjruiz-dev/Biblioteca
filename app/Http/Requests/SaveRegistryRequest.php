<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaveRegistryRequest extends FormRequest
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
            'name'      => 'required|string',
            'surname'   => 'required|string',
            'birthdate' => 'required',                         
        ];
     
        if($this->method() !== 'PUT')
        {          
            $rules ['email']     = 'required|string|email|max:255|unique:users,email' . $this->id;
            $rules ['nickname']  = 'required|string||min:3|max:50|unique:users,nickname' . $this->id;  
        }
 
        return $rules; 
    }

    public function messages()
    {
        return [
            'email.required'    => 'Debe introducir un correo electronico.',        
            'email.unique'      => 'Este email ya ha sido registrado.', 
            
            'nickname.required' => 'Debe introducir un nickname.',
            'nickname.unique'   => 'Este nickname ya ha sido registrado.',
            
        ];
    }
}
