<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistrarRequest extends Request
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
            'passwordp' => 'required|min:6|confirmed',
            'passwordp_confirmation' => 'required|min:6|max:50' ,
            'nombre' => 'required|min:3|max:50',
            /*'direccion' => 'required|min:3|max:50',
            //'telefono' => 'digits_between:6,9',
            'comuna' => 'required|min:3|max:50',
            'celular' => 'digits_between:6,9',*/
            'email' => 'required|email|max:50',
            'email_confirmation' => 'required|email|max:50',
            'condiciones' => 'required'
        ];
    }
}
