<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditarPortal extends Request {

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
			'id_edit' => 'required',
			'titulo' => 'required|min:3|max:45',
			'descripcion' => 'required|min:3|max:249'
		];
	}

}
