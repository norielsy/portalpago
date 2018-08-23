<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CobrosNominaRequest extends Request
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
            'excel' => 'required',
            'empresa' => 'required|min:3|max:50',
            //'fecha_vencimiento' => 'required|date_format:d/m/Y',
            'excel' => 'required|validar_excel',
            'voucher' => 'mimes:jpeg,bmp,png,pdf'
        ];
    }
}
