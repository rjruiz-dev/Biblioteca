<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SavePeriodicityRequest extends FormRequest
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

        if($this->method() !== 'PUT')
        {
            
            $rules ['periodicity_name'] = 'required|string|unique:periodicities,periodicity_name' . $this->id;                 
            
        }
        return $rules;
    }

    public function messages()
    {
        return [

            'periodicity_name.required'  => 'Debe introducir una periodicidad.',            
            'periodicity_name.unique'    => 'La periodicidad ya ha sido registrada.'
        ];
    }
}
