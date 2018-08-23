<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PagarCuentas extends Request {

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
			'monto_pop' => 'required|integer',
			'metodo_pago' => 'required',
			//'nro_transaccion_pop' => 'required_if:metodo_pago,1|min:3|max:80',
			'fecha_pago_pop' => 'required|date_format:d/m/Y'
		];
	}

	public function messages()
	{
		return [
			'nro_transaccion_pop.required' => 'El campo número de transacción tiene que ser numérico',
			'monto_pop.required' => 'El campo monto tiene que ser numérico',
			'fecha_pago_pop.required' => 'El campo fecha de pago es inválido, ej: día/mes/año',
		];
	}
}
