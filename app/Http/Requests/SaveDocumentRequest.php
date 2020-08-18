<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveDocumentRequest extends FormRequest
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
            'title'         => 'required|string',
            'creators_id'   => 'required',        
        ];
     
        // if($this->method() !== 'PUT')
        // {
        //     $rules ['registry_number'] = 'required|numeric|unique:documents,registry_number' . $this->id;          
        // }
 
        return $rules;  

    }

    public function messages()
    {
        return [
            'title.required'            => 'Debe introducir un Título para catalogar un documento.',            
            'creators_id.required'      => 'Debe seleccionar un Autor/Director/Compositor.',            
            // 'registry_number.unique'    => 'Debe ingresar un Número de Registro para catalogar un documento.'
        ];
    }
}
