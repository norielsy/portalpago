<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditarDetalleNomina extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	public function all()
	{
		$data = parent::all();
		if( $data['monto'] != null) {
			$data['monto'] = str_replace('.','',$data['monto']);
		}
		return $data;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'rut_traspaso' => 'rut',
			'email_traspaso' => 'email|max:70',
			'id_nomina' => 'required|integer',
			'nombre' => 'required|min:3|max:45',
			'rut' => 'required|rut|max:20',
			'email' => 'required|email|max:70',
			'monto' => 'required|integer|min:1|max:999999999',
			'fecha_vencimiento' => 'required|date_format:d/m/Y'
		];
	}

}
