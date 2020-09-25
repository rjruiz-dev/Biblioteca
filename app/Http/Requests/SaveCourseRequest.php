<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCourseRequest extends FormRequest
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
            $rules ['course_name']  = 'required|string|unique:courses'. $this->id;
            $rules ['group']        = 'required|string'. $this->id;
        }

        return $rules;

    }

    public function messages()
    {
        return [
            'course_name.required'  => 'Debe introducir un nombre.',            
            'course_name.unique'    => 'El nombre ya ha sido registrado.',
            'group.required'        => 'Debe seleccionar una opción.'     
        ];
    }
}
