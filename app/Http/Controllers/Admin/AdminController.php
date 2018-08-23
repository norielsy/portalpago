<?php
namespace App\Http\Controllers\Admin;
use App\AnuncioPortal;
use App\Cobros;
use App\Extras\SendEmail;
use App\Extras\Utilidades;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarAnuncio;
use App\Http\Requests\LoginRequest;
use App\Logaccesos;
use App\PagarCuentas;
use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Util;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin',['except' => ['login','login_post']]);
    }

    public function index(){
        $mes_actual = Utilidades::mes_actual();
        $total_usuarios = Usuarios::total_usuarios_mes($mes_actual);
        $total_deudas_pagadas = Cobros::total_deudas_pagadas($mes_actual);
        $total_deudas_pendientes = Cobros::total_cobros_pendientes($mes_actual);

        $total_login_activos = Logaccesos::total_ultimo_mes($mes_actual);
        $total_deudores_activos = Cobros::deudores_activos($mes_actual);
        $total_pagadores_activos = Cobros::pagadores_activos($mes_actual);

        $anuncio = AnuncioPortal::obtenerAnuncio(1);
        return view('admin/index',compact('total_usuarios','total_deudas_pagadas','total_deudas_pendientes','total_login_activos','total_deudores_activos','total_pagadores_activos','anuncio'));
    }

    public function anuncio(ActualizarAnuncio $request){
        $inicio = Utilidades::formatoFechaDBTime($request->input('inicio'));
        $termino = Utilidades::formatoFechaDBTime($request->input('termino'));
        $mensaje = $request->input('mensaje');
        $rs = AnuncioPortal::actualizar(1,$inicio,$termino,$mensaje);
        if($rs){
            Session::flash('ok','Anuncio actualizado');
            return Redirect::back();
        }else{
            return Redirect::back()->withErrors([
                'error' => 'Error al modificar el anuncio',
            ]);
        }
    }

    public function login(){
        return view('admin/login');
    }

    public function login_post(LoginRequest $request){
        $rut =  str_replace('.','',$request->input('rut'));
        $usuario = Usuarios::where('rut',$rut)->where('admin',1)->first();

        if ($usuario && Hash::check($request->input('passwordp'), $usuario->passwordp)) {
            Auth::loginUsingId($usuario->idUsuarios);
            Session::put('nombre', $usuario->nombre);
            Session::put('id',$usuario->idUsuarios);
            Session::put('rut',$usuario->rut);


            /* VISTA COBRADOR */
            Session::put('idvista_cobrador',0);
            Session::put('permiso_cobrador',0);
            Session::put('rut_padre',0);
            /* FIN VISTA */

            $last = Logaccesos::orderBy('created_at', 'desc')->first();

            $log = new Logaccesos();
            $log->IP = $request->getClientIp();
            $log->idUsuarios = $usuario->idUsuarios;
            $log->save();

            if(is_null($last)){
                Session::put('ultimo_acceso',$log->created_at);
            }else{
                Session::put('ultimo_acceso',$last->created_at);
            }

            return redirect('/admincp');
        }else{
            return redirect::back()->withErrors([
                'error_login' => 'Email y/o contraseña inválido, intente nuevamente',
            ]);
        }
    }

    public function exportar_log_acceso(){
        $mes_actual = Utilidades::mes_actual();
        $data = array(
            'mes_actual' => $mes_actual
        );

        Excel::create('LogUsuarioMensual', function($excel) use ($data) {
            $excel->sheet('LogUsuarioMensual', function($sheet) use ($data) {
                $rs = Logaccesos::lista_usuarios_ultimo_mes_excel($data['mes_actual']);
                $sheet->fromArray($rs);
                $sheet->setAutoFilter();
            });
        })->export('xls');
    }
    public function testemail(){

        $data = array(
            'nombre' => 'David',
            'to' => 'david.cuello@r2da.com',
            'mensaje' => 'Mensaje de prueba',
            'titulo' => 'Mensaje de prueba'
        );
        $a = Mail::queue('emails.email_nuevoregistro', $data, function ($message) use ($data) {
            $message->from('noreply@portaldepagos.cl', $data['titulo']);
            $message->to( $data['to'] )->subject('Portal de pagos');
        });
        return $a;

    }
}
?>