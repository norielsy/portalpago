<?php
namespace App\Http\Controllers;
use App\ContenidoEmail;
use App\Extras\SendEmail;
use App\Extras\Utilidades;
use App\HistorialEmail;
use App\Http\Requests\RegistrarRequest;
use App\Regiones;
use App\Usuarios;
use App\Rubros;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RegistroController extends  Controller
{
    public function index(){
        if (Auth::check()) {
            return redirect(asset("/dashboard"));
        }
        $regiones = Regiones::all();
        $rubros = Rubros::all();
        return view('portal/registro',compact('regiones','rubros'));
    }

    public function postRegistro(RegistrarRequest $request){
        $rut = $request->input('rut');
        $request["rut"] = Utilidades::modificar_rut($rut);
        $rs = Usuarios::buscar_usuario_por_rut($request["rut"]);
        $email = Usuarios::buscar_usuario_por_email($request->input('email'));
        if($rs != null && $rs->eliminado == 0) {
            return Redirect::back()->withErrors(['El Rut ya se encuentra registrado']);
        }else if($rs != null && $rs->eliminado == 1){
            $ok = Usuarios::reactivar_usuario($rs->idUsuarios);
            SendEmail::nuevo_registro($request->input('email'),$request->input('nombre') . " " . $request->input('apellido'));
            Session::flash('ok','Te enviaremos un e-mail para confirmar tu registro en nuestra plataforma. <br> <hr><strong>Recuerda:</strong> por políticas de seguridad de tu servicio de e-mail, este pode ser derivado a la carpeta de “Correos no deseados”. <br> Revísala en caso de que nuestro e-mail tarde mucho en llegar.
                ');
            return redirect()->to('/');
        }else if($email != null){
            return Redirect::back()->withErrors(['El email ya se encuentra registrado']);
        }else{
            $usuario = Usuarios::create($request->all());
            if($usuario){
                SendEmail::nuevo_registro($request->input('email'),$request->input('nombre') . " " . $request->input('apellido'));
                Session::flash('ok','Te enviaremos un e-mail para confirmar tu registro en nuestra plataforma. <br> <hr><strong>Recuerda:</strong> por políticas de seguridad de tu servicio de e-mail, este pode ser derivado a la carpeta de “Correos no deseados”. <br> Revísala en caso de que nuestro e-mail tarde mucho en llegar.');
            }
            return redirect()->to('/');
        }
    }
}
