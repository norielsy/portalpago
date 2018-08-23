<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditarUsuarioDeudorRequest extends Request {

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
			'id_edit' => 'required|integer',
			'nombre' => 'required|min:3|max:45',
			'direccion' => 'required|min:3|max:200',
			//'telefono' => 'required|digits_between:6,8',
			'celular' => 'required|digits_between:6,9',
			'email' => 'required|email|max:70',
			'rut_hijo' => 'required_if:tipo_usuario,operativo,consultivo|rut|exists:usuarios,rut',
		];
	}

}
