<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdjuntarDocumentoPortal extends Request {

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
			'doc' => 'required|validar_adjunto_portal',
		];
	}

	public function messages()
	{
		return [
			'validar_adjunto_portal' => 'Formato: excel,pdf - Tamaño máximo: 1mb'
		];
	}

}
