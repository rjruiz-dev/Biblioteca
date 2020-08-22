<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaveCopyRequest extends FormRequest
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
     
        if($this->method() !== 'PUT')
        {          
            $rules ['registry_number']  = 'required|numeric|unique:copies,registry_number' . $this->id;              
            $rules ['status_copy_id'] = 'required' . $this->id;             
        }
 
        return $rules;  
    }

    public function messages()
    {
        return [
            'registry_number.required'  => 'Debe introducir un Número de Registro para un Ejemplar.',  
            // 'registry_number.min'       => 'El campo Número de Registro debe contener 5 Números como minimo',        
            // 'registry_number.max'       => 'El campo Número de Registro  no debe ser mayor a 5 números',              
            'registry_number.unique'    => 'El Número de Registro ya ha sido Registrado.',               
            'status_copy_id.required' => 'Debe Seleccionar un Estado para un Ejemplar.',
        ];
    }
}
