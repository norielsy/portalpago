<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AgregarNominaAdmin extends Request {


	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'rut_cobrador' => 'required|rut|exists:usuarios,rut',
			'empresa' => 'required|min:3|max:70',
			'fecha_vencimiento' => 'required|date_format:d/m/Y',
			'excel' => 'required|validar_excel'
		];
	}

}
