<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactoRequest extends Request {

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
			'motivo' => 'required|min:3|max:100',
			'celular' => 'required|min:9|max:9',
			'rut' => 'required|rut',
			'nombre' => 'required|min:3|max:100',
			'email' => 'required|email|max:70',
			'mensaje' => 'required|min:3|max:500'
		];
	}

}
