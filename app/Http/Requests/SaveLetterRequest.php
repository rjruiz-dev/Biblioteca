<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveLetterRequest extends FormRequest
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
            $rules ['title']    = 'required|string|unique:generate_letters'. $this->id;
            $rules ['body']     = 'required|string'. $this->id;
            $rules ['excerpt']  = 'required|string'. $this->id;
           
        }

        return $rules;
      
    }

    public function messages()
    {
        return [
            'title.required'  => 'Debe introducir un titulo.',            
            'title.unique'    => 'El titulo ya ha sido registrado.',
            'body.required'   => 'Debe intorducir un contenido para la carta.',   
            'excerpt.required'=> 'Debe introducir la despedida para la carta.'  
        ];
    }
}
