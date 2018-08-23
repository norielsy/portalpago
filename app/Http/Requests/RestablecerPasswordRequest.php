<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RestablecerPasswordRequest extends Request {

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
			'pwd1' => 'required|min:6|max:15|confirmed',
			'pwd1_confirmation' => 'required|min:6|max:15' ,
		];
	}

	public function messages()
	{
		return [
			'pwd1.required' => 'La clave ingresada no corresponde.',
			'pwd1_confirmation.required' => 'El campo de confirmación es obligatorio',
			'pwd1_confirmation' => 'El campo de confirmación es obligatorio',
		];
	}

}
