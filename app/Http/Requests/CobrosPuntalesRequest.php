<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CobrosPuntalesRequest extends Request
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

    public function all()
    {
        $data = parent::all();
        if( $data['monto'] != null) {
            $data['monto'] = str_replace('.','',$data['monto']);
        }
        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'empresa' => 'required|min:3|max:50',
            'rut_empresa' => 'required|rut|rut_session',
            'email' => 'required|email',
            'monto' => 'required|integer|min:1|max:999999999',
            'fecha_vencimiento' => 'required|date_format:d/m/Y',
            'voucher' => 'mimes:jpeg,bmp,png,pdf'
        ];
    }
    public function messages()
    {
        return [
            'rut_session' => 'No puedes agregarte a ti mismo(rut)'
        ];
    }

}
