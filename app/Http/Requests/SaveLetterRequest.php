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
        return [
            'title'     => 'required|string|unique:generate_letters',
            'body'      => 'required|string',
            'excerpt'   => 'required|string'
        ];
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
