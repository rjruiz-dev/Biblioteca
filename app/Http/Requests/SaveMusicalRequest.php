<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMusicalRequest extends FormRequest
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
            'genre_music' => 'required|string|unique:generate_musics'
        ];
    }

    public function messages()
    {
        return [

            'genre_music.required'  => 'Debe introducir un género.',            
            'genre_music.unique'    => 'El género literario ya ha sido registrado.'
        ];
    }


}
