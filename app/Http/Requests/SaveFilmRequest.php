<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFilmRequest extends FormRequest
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
            $rules ['genre_film']   = 'required|string|unique:generate_films'. $this->id;
        }

        return $rules;

        
    }

    public function messages()
    {
        return [

            'genre_film.required'  => 'Debe introducir un género.',            
            'genre_film.unique'    => 'El género cinematográfico ya ha sido registrado.'
        ];
    }
}
