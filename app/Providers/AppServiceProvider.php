<?php namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Validator::extend('rut', function($attribute, $value, $parameters) {
			$rut = $value;
			$rut = str_replace('.','',$rut);

			if( empty( $rut ) ) return false;

			if (!preg_match("/(\d{7,8})-([\dK])/", strtoupper($rut), $aMatch)) {
				return false;
			}
			$sRutBase = substr(strrev($aMatch[1]) , 0, 8 );
			$sCodigoVerificador = $aMatch[2];
			$iCont = 2;
			$iSuma = 0;
			for ($i = 0;$i<strlen($sRutBase);$i++) {
				if ($iCont>7) {
					$iCont = 2;
				}
				$iSuma+= ($sRutBase{$i}) *$iCont;
				$iCont++;
			}
			$iDigito = 11-($iSuma%11);
			$sCaracter = substr("-123456789K0", $iDigito, 1);
			return ($sCaracter == $sCodigoVerificador);
		});

		Validator::extend('rut_session', function($attribute, $value, $parameters) {
			$rut = $value;
			$rut = str_replace('.','',$rut);

			if( empty( $rut ) ) return false;

			if($rut == Session::get('rut')){
				return false;
			}else{
				return true;
			}
		});

		Validator::extend('validar_excel', function($attribute, $value, $parameters) {
			$extension = $value->guessClientExtension();
			$peso = $value->getClientSize();

			if( ($extension == "xlsx" || $extension == "xls") && (int)$peso < 1048576){
				return true;
			}else{
				return false;
			}
			return false;
		});

		Validator::extend('validar_imagen', function($attribute, $value, $parameters) {
			$extension = $value->guessClientExtension();
			$peso = $value->getClientSize();

			if( ($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "gif") && (int)$peso < 1048576){
				return true;
			}else{
				return false;
			}
			return false;
		});

		Validator::extend('validar_adjunto_portal', function($attribute, $value, $parameters) {
			$extension = $value->getClientOriginalExtension();
			$peso = $value->getClientSize();
			if( ($extension == "xls" || $extension == "pdf" || $extension == "csv") && (int)$peso < 1048576){
				return true;
			}else{
				return false;
			}
			return false;
		});
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
