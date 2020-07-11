<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class SaveFormatRequest extends FormRequest
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
            'genre_format' => 'required|string|unique:generate_formats'
        ];
    }

    public function messages()
    {
        return [

            'genre_format.required'  => 'Debe introducir un formato.',            
            'genre_format.unique'    => 'El formato fotográfico ya ha sido registrado.'
        ];
    }
}
