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
            'name'      => 'required|string|min:3|max:50',
            'surname'   => 'required|string|min:3|max:50',
            'status_id' => 'required',
            'birthdate' => 'required',
            'gender'    => 'required',
            'province'  => 'required',
        ];

        if($this->filled('password'))
        {
            $rules['password'] = ['confirmed','min:6'];
        }

        // Si es diferente a Post
        if($this->method() !== 'PUT')
        {
            $rules ['email']    = 'required|string|email|max:255|unique:users,email,' . $this->id;
            $rules ['nickname'] = 'required|string||min:3|max:50|unique:users,nickname' . $this->id;            
            $rules ['phone']    = 'required|string|unique:users,phone' . $this->id;   
            // $rules ['membership']   = 'required|string|min:3|max:50|unique:users,membership' . $this->id;           
                    
        }

        return $rules;  

        // $rules = [
        //     'name'      => 'required|string|max:255',
        //     'surname'   => 'required|string|max:255',
        //     'nickname'  => 'required|string|max:255',
        //     'status_id' => 'required',
        //     'datepicker'=> 'required',
        //     'gender'    => 'required',
        //     'province'  => 'required',
        //     'phone'     => ['required','string',Rule::unique('users')->ignore($this->route('user')->id)],
        //     'email'     => ['required','string','max:255',Rule::unique('users')->ignore($this->route('user')->id)]
        // ];
      
        // if($this->filled('password'))
        // {
        //     $rules['password'] = ['confirmed','min:6'];
        // }
        
        // return $rules;
    }

    public function messages()
    {
        return [
            'nickname.required' => 'Debe introducir un nickname.',
            'nickname.unique'   => 'Este nickname ya ha sido registrado.',
            'nickname.min'      => 'El nickname debe contener al menos 3 caracteres.',
            'nickname.max'      => 'El nickname debe contener un maximo 50 caracteres.',

            'name.required'     => 'Debe introducir un nombre de usuario.',
            'name.min'          => 'El nombre de usuario debe contener al menos 3 caracteres.',
            'name.max'          => 'El nombre de usuario debe contener un maximo 50 caracteres.',

            'surname.required'  => 'Debe introducir un apellido para el usuario',
            'surname.min'       => 'El apellido de usuario debe contener al menos 3 caracteres.',
            'surname.max'       => 'El apellido de usuario debe contener un maximo 50 caracteres.',                   

            'email.required'    => 'Debe introducir un correo electronico.',        
            'email.unique'      => 'Este email ya ha sido registrado.',  

            'phone.required'    => 'Debe introducir un numero de telefono valido.',
            'phone.unique'      => 'El numero de telefono del usuario ya ha sido registrado.',

            'province.required'   => 'Debe seleccionar una provincia.',        
            'gender.required'     => 'Debe seleccionar un genero.',        
            'birthdate.required'  => 'Debe seleccionar una fecha.',        
            'status_id.required'  => 'Debe seleccionar un estado.',
           
        ];
    }
}
