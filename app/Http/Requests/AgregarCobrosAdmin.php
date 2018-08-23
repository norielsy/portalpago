<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AgregarCobrosAdmin extends Request {

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
			'rut_cobrador' => 'required|rut|exists:usuarios,rut',
			'empresa' => 'required|min:3|max:100',
			'rut_empresa' => 'required',
			'email' => 'required|email|max:70',
			'monto' => 'required|integer|min:1|max:999999999',
			'fecha_vencimiento' => 'required|date_format:d/m/Y'
		];
	}

}
