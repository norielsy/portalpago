<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditarPublicidad extends Request {

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
			'fecha_inicio' => 'required|date_format:d/m/Y',
			'fecha_fin' => 'required|date_format:d/m/Y|after:fecha_inicio',
			'descripcion' => 'required|min:3|max:249'
		];
	}

	public function messages()
	{
		return [
			'validar_imagen' => 'Formato: jpg,jpeg,png,gif - Tamaño máximo: 1mb'
		];
	}

}
