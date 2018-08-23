<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditarBancoRequest extends Request {

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
			'banco' => 'required|min:3|max:100',
			'tipo_cuenta' => 'required|min:3|max:80',
			'nro_cuenta' => 'required|min:6|max:110',
		];
	}

}
