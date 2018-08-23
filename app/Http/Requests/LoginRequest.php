<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginRequest extends Request
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
            'rut' => 'required|rut',
            'passwordp' => 'required|min:6|max:16',
        ];
    }

    public function messages()
    {
        //if($this->input('passwordp') != null || !empty($this->input('passwordp'))){
            return [
                'passwordp.required' => 'La clave ingresada no corresponde.'
            ];
        /*}else{
            return [
                'passwordp.required' => ''
            ];
        }*/
    }
}
