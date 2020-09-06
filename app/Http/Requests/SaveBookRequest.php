<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaveBookRequest extends FormRequest
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
            'let_author'    => 'required|alpha|min:3|max:3',
            'let_title'     => 'required|alpha||min:3|max:3',            
            'year'          => 'required',
            'acquired'      => 'required',
        ];
     
        if($this->method() !== 'PUT')
        {          
            $rules ['creators_id']          = 'required|string' . $this->id;  
            $rules ['document_subtypes_id'] = 'required' . $this->id;  
            $rules ['generate_books_id']    = 'required' . $this->id;  
            $rules ['lenguages_id']         = 'required' . $this->id;
            $rules ['generate_subjects_id'] = 'required' . $this->id;    
            $rules ['isbn']                 = 'required|string|min:17|unique:books,isbn' . $this->id;
            $rules ['photo']                = 'nullable|image|mimes:jpeg,bmp,png,jpg'. $this->id;
            // $rules ['issn']                 = 'nullable|string|min:17|unique:periodical_publications,issn'. $this->id;
            // $rules ['issn']                 = 'exclude_unless:document_subtypes_id,4|string|min:13|unique:periodical_publications,issn'. $this->id;
        }
 
        return $rules;  
    }

    public function messages()
    {
        return [
            'title.required'                    => 'Debe introducir un Título para Catalogar un Documento.',    
            'let_author.alpha'                  => 'Solo debe introducir letras para el campo Siglas Autor.',         
            'let_author.required'               => 'El campo Siglas Autor es requerido.',        
            'let_author.min'                    => 'El campo Siglas Autor debe contener 3 caracteres como minimo',        
            'let_author.max'                    => 'El campo Siglas Autor no debe ser mayor a 3 caracteres',    
            'let_title.alpha'                   => 'Solo debe introducir letras para el campo Siglas Título.',               
            'let_title.required'                => 'El campo Siglas Título es requerido.',  
            'let_title.min'                     => 'El campo Siglas Título debe contener 3 caracteres como minimo',        
            'let_title.max'                     => 'El campo Siglas Título no debe ser mayor a 3 caracteres',       
            'isbn.required'                     => 'Debe introducir Isbn para Catalogar un Documento.',  
            'isbn.min'                          => 'Isbn debe contener una longitud minima de 17 caracteres.',            
            'photo.mimes'                       => 'La imagen debe ser del tipo jpeg, bmp, png, jpg.',                    
            'creators_id.required'              => 'Debe seleccionar o ingresar un Autor.',           
            'document_subtypes_id.required'     => 'Debe seleccionar un Subtipo para Catalogar un Documento.',   
            'generate_books_id.required'        => 'Debe seleccionar un Género para Catalogar un Documento.',          
            'lenguages_id.required'             => 'Debe seleccionar un Idioma para Catalogar un Documento.',          
            'generate_subjects_id.required'     => 'Debe seleccionar Cdu para Catalogar un Documento.',
            'year.required'                     => 'Debe introducir Año para catalogar un documento.',        
            'acquired.required'                 => 'Debe introducir Fecha de adquisición para catalogar un documento.',   
        ];
    }
}
