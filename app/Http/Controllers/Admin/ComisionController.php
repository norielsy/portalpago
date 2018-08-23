<?php namespace App\Http\Controllers\Admin;

use App\Configuration;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ComisionController extends Controller
{


    public function index()
    {
        $comision = Configuration::where(['nombre_configuracion' => "comision"])->first();
        $uf = file_get_contents("http://mindicador.cl/api/uf");
        $uf = json_decode($uf);
        return view('admin.UF.index', ['comision' => $comision, 'uf' => $uf->serie[0]]);
    }

    public function comisionSave()
    {
        if (Request::has('pesos')) {
            $pesos = Request::get('pesos');
            $comision = Configuration::where('nombre_configuracion', '=', "comision")->first();
            if (!$comision) {
                $comision = new Configuration();
                $comision->nombre_configuracion = "comision";

            }
            $comision->valor_configuracion = $pesos;
            $comision->save();

            return Redirect::back();
        } else {
            return Redirect::back()->withError('No se ha enviado datos');
        }

    }
}
