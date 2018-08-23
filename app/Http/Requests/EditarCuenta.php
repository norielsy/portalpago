<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditarCuenta extends Request {

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
			'nombre' => 'required|min:3|max:50',
			'comuna' => 'required|min:3|max:50',
			//'apellido' => 'required|min:3|max:50',
			//'razon_social' => 'required|min:3|max:50',
			'direccion' => 'required|min:3|max:50',
			//'telefono' => 'required|digits_between:6,8',
			'celular' => 'digits_between:9,9',
			'email' => 'required|email|max:50',
		];
	}

}
