<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AgregarUsuarioAdmin extends Request {

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
			'passwordp' => 'required|min:6|max:15|confirmed',
			'passwordp_confirmation' => 'required|min:6|max:15' ,
			'nombre' => 'required|min:3|max:50',
			//'apellido' => 'required|min:3|max:50',
			'direccion' => 'required|min:3|max:200',
			//'razon_social' => 'required|min:3|max:50',
			//'telefono' => 'required|digits_between:6,8',
			'celular' => 'required|digits_between:6,9',
			'email' => 'required|email|max:70',
			'rut_hijo' => 'required_if:tipo_usuario,operativo,consultivo|rut|exists:usuarios,rut',
		];
	}

	public function attributes()
	{
		return[
			'passwordp_confirmation' => 'Confirmar Contraseña es obligatorio' ,
			'passwordp' => 'Contraseña es obligatorio',
			'rut_hijo' => 'Rut asociado ',
		];

	}

}
