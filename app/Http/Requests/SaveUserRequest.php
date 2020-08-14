<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaveUserRequest extends FormRequest
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

        if($this->filled('password'))
        {
            $rules['password'] = ['confirmed','min:6'];
        }

        // Si es diferente a Post
        if($this->method() !== 'PUT')
        {   
            $rules ['user_photo']   = 'nullable|image|mimes:jpeg,bmp,png,jpg'. $this->id;
            $rules ['status_id']    = 'required'. $this->id;
            $rules ['email']        = 'required|string|email|max:255|unique:users,email' . $this->id;
            $rules ['nickname']     = 'required|string||min:3|max:50|unique:users,nickname' . $this->id;                   
            $rules ['membership']   = 'required|numeric|min:000000|max:99999999|unique:users,membership' . $this->id;           
            
        }

        return $rules;  

    }

    public function messages()
    {
        return [
            'nickname.required' => 'Debe introducir un nickname.',
            'nickname.unique'   => 'Este nickname ya ha sido registrado.',
            'nickname.min'      => 'El nickname debe contener al menos 3 caracteres.',
            'nickname.max'      => 'El nickname debe contener un maximo 50 caracteres.',

            'user_photo.mimes'  => 'La imagen debe ser del tipo jpeg, bmp, png, jpg.',            

            'name.required'     => 'Debe introducir un nombre.',            
            'name.max'          => 'El nombre de usuario debe contener un maximo 100 caracteres.',  

            'email.required'    => 'Debe introducir un correo electronico.',        
            'email.unique'      => 'Este email ya ha sido registrado.',  

            'status_id.required'  => 'Debe seleccionar un estado.',
           
        ];
    }
}
