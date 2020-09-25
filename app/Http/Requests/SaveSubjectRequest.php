<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSubjectRequest extends FormRequest
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
            $rules ['subject_name'] = 'required|string|unique:generate_subjects'. $this->id;
            $rules ['cdu']          = 'required|string|unique:generate_subjects'. $this->id;
        }

        return $rules;
        
    }

    public function messages()
    {
        return [
            'subject_name.required' => 'Debe introducir un materia.',            
            'subject_name.unique'   => 'El materia ya ha sido registrada.',
            'cdu.required'          => 'Debe introducir un número de cdu.',     
            'cdu.unique'            => 'El número de cdu ya ha sido registrado.'
        ];
    }
}
