<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveLiteratureRequest extends FormRequest
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
            $rules ['genre_book']   = 'required|string|unique:generate_books'. $this->id;
        }

        return $rules;
        
    }

    public function messages()
    {
        return [

            'genre_book.required'  => 'Debe introducir un género.',            
            'genre_book.unique'    => 'El género literario ya ha sido registrado.'
        ];
    }
}
