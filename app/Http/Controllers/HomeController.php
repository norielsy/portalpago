<?php

namespace App\Http\Controllers;

use App\Cobros;
use App\ContenidoEmail;
use App\DatosPagos;
use App\Extras\SendEmail;
use App\Extras\Utilidades;
use App\HistorialEmail;
use App\Http\Requests\ConsultarCobrosRut;
use App\Http\Requests\ContactoRequest;
use App\Http\Requests\EditarBancoRequest;
use App\Http\Requests\EditarCuenta;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RestablecerPasswordRequest;
use App\Regiones;
use App\Rubros;
use App\User;
use App\Usuarios;
use App\Logaccesos;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use League\Flysystem\Exception;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'login', 'recuperar_password', 'view_restablecer_password', 'reset_post_password', 'consultar', 'resultados', 'editar_cuenta', 'active', 'contacto', 'contacto_post', 'contacto_login', 'resultadosGet']]);
    }

    public function index()
    {
        return view('portal/inicio');
    }

    public function editar_mi_cuenta()
    {
        $user = Auth::user();
        if (Input::has('r')) Session::put('r', Input::get('r'));
        return view('logueado.completar_datos')->with(['userInfo' => $user]);
    }

    public function editar_cuenta(Request $request)
    {
        $nombre = $request->input('nombre');
        //$apellido = $request->input('apellido');
        $email = $request->input('email');
        //$telefono = $request->input('telefono');
        $celular = $request->input('celular');
        //$razon_social = $request->input('razon_social');
        $direccion = $request->input('direccion');
        $comuna = $request->input('comuna');
        $IDRegion = $request->input('IDRegion');
        $idrubros = $request->input('idrubros');

        $rs = Usuarios::where('idUsuarios', Session::get('id'))->first();
        //dd($rs);
        $rs->nombre = $nombre;
        $rs->email = $email;
        $rs->comuna = $comuna;
        $rs->celular = $celular;
        $rs->direccion = $direccion;
        $rs->IDRegion = $IDRegion;
        $rs->idrubros = $idrubros;
        $rs->save();
        /*->update(array(
            'nombre' => $nombre,
            //'apellido' => $apellido,
            'email' => $email,
            //'telefono' => $telefono,
            'comuna' => $comuna,
            'celular' => $celular,
            //'razon_social' => $razon_social,
            'direccion' => $direccion,
            'IDRegion' => $IDRegion,
            'idrubros' => $idrubros
        ));*/

        Session::flash('ok', 'Datos actualizados correctamente');

        if ($rs) {
            Session::put('nombre', $nombre);
            Session::put('mi_nombre', $nombre);
            //Session::put('mi_apellido', $apellido);
            Session::put('email', $email);
            Session::put('direccion', $direccion);
            //Session::put('telefono',$telefono);
            Session::put('comuna', $comuna);
            Session::put('celular', $celular);
            Session::put('idrubros', $idrubros);
            Session::put('IDRegion', $IDRegion);
            //Session::put('razon_social', $razon_social);

            SendEmail::edicion_cuenta($request->input('email'), Session::get('nombre'));

            $this->editar_cuenta_bancaria($request);

            if (!empty(Session::get('r'))) {
                return redirect(Session::get('r'))->with('ok', 'Datos actualizados correctamente');
            }

            Session::flash('ok', 'Datos actualizados correctamente');

            return Redirect::back()->with('ok', 'Datos actualizados correctamente');
        } else {
            return Redirect::back()->withErrors([
                'Error' => 'Hubo un error al modificar los datos, por favor intente nuevamente',
            ]);
        }

    }

    public function login(LoginRequest $request)
    {
        $rut = str_replace('.', '', $request->input('rut'));
        $usuario = Usuarios::where('rut', $rut)->where('eliminado', 0)->first();
        if (!is_null($usuario)) {
            if ($usuario->activo == 1) {
                if ($usuario && Hash::check($request->input('passwordp'), $usuario->passwordp)) {
                    Auth::loginUsingId($usuario->idUsuarios);

                    Session::put('cerrar_publicidad', 0);
                    Session::put('nombre', $usuario->nombre);
                    Session::put('id', $usuario->idUsuarios);
                    Session::put('rut', $usuario->rut);
                    Session::put('mi_nombre', $usuario->nombre);
                    Session::put('mi_apellido', $usuario->apellido);
                    Session::put('email', $usuario->email);
                    Session::put('direccion', $usuario->direccion);
                    Session::put('nro_direccion', $usuario->nro_direccion);
                    Session::put('referencia', $usuario->referencia);
                    Session::put('complemento', $usuario->complemento);
                    //Session::put('telefono', $usuario->telefono);

                    Session::put('comuna', $usuario->comuna);
                    Session::put('celular', $usuario->celular);
                    Session::put('idrubros', $usuario->idrubros);
                    Session::put('IDRegion', $usuario->IDRegion);
                    Session::put('razon_social', $usuario->razon_social);

                    Session::put('lista_regiones', Regiones::all());
                    Session::put('lista_rubros', Rubros::all());

                    /* VISTA COBRADOR */
                    Session::put('idvista_cobrador', 0);
                    Session::put('permiso_cobrador', 0);
                    Session::put('rut_padre', 0);
                    /* FIN VISTA */


                    /* DATOS BANCARIOS */
                    $b = DatosPagos::buscar_pago($usuario->idUsuarios);
                    if ($b) {
                        Session::put('banco', $b->banco);
                        Session::put('nro_cuenta', $b->nro_cuenta);
                        Session::put('tipo_cuenta', $b->tipo_cuenta);
                    } else {
                        Session::put('banco', "");
                        Session::put('nro_cuenta', "");
                        Session::put('tipo_cuenta', "");
                    }
                    /* FIN DATOS BANCARIOS */


                    $last = Logaccesos::orderBy('created_at', 'desc')->first();
                    $log = new Logaccesos();
                    $log->IP = $request->getClientIp();
                    $log->idUsuarios = $usuario->idUsuarios;
                    $log->save();

                    if (is_null($last)) {
                        Session::put('ultimo_acceso', $log->created_at);
                    } else {
                        Session::put('ultimo_acceso', $last->created_at);
                    }

                    return redirect('/dashboard');
                } else {
                    return redirect('/')->withErrors([
                        'error_login' => 'Contraseña inválida, intente nuevamente',
                    ]);
                }
            } else {
                return redirect('/')->withErrors([
                    'error_login' => 'Debes activar tu cuenta',
                ]);
            }
        } else {
            return redirect('/')->withErrors([
                'error_login' => 'El Rut ingresado no se encuentra registrado. Regístrate, por favor.
                ',
            ]);
        }
    }

    public function cerrar_publicidad(Request $request)
    {
        $rs = $request->get('cerrar');
        if ($rs) {
            Session::put('cerrar_publicidad', 1);
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function cambiar_password(Request $request)
    {

        $password_actual = $request->get('password_1');
        $nuevo_passowrd = $request->get('nueva_password');
        if (strlen(trim($nuevo_passowrd)) < 6) {
            return redirect('/')->withErrors([
                'Contraseña' => 'La contraseña debe tener mínimo de 7 caracteres.',
            ]);
        }

        $usuario = Usuarios::where('idUsuarios', Session::get('id'))->first();
        if ($usuario && !Hash::check($password_actual, $usuario->passwordp)) {
            return redirect('/')->withErrors([
                'Contraseña' => 'La contraseña ingresada no coincide con la actual.',
            ]);
        }
        Usuarios::where('idUsuarios', Session::get('id'))
        ->update(['passwordp' => Hash::make($nuevo_passowrd)]);

        SendEmail::aviso_cambio_clave($usuario);

        Session::flash('ok', 'Se ha cambiado la contraseña correctamente.');
        return redirect('/');
    }

    public function recuperar_password(Request $request)
    {
        $rut = str_replace('.', '', $request->input('rut'));
        $rs = Usuarios::buscar_usuario_por_rut($rut);
        if ($rs) {
            $bool = SendEmail::recuperar_password($rs->email);
            if ($bool) {
                Session::flash('ok', 'Se ha enviado un email a <b>' . Utilidades::email_mask($rs->email) . '</b> con los pasos a seguir para restablecer su contraseña.');
                return Redirect::back();
            } else {
                return Redirect::back()->withErrors([
                    'Contraseña' => 'Hubo un error al enviar el email para restablecer su contraseña, intente nuevamente',
                ]);
            }
        } else {
            return redirect('/')->withErrors([
                'Email' => 'El rut ingresado no se encuentra registrado',
            ]);
        }
    }

    public function view_restablecer_password(Request $request)
    {
        $expira = $request->input('exp');
        $email = $request->input('f');
        try {
            $veri = Crypt::decrypt($email);
            if (Utilidades::ValidarEmail($veri)) {
                return view('portal/restablecer_password', compact('email'));
            } else {
                return redirect('/');
            }
        } catch (Exception $ex) {
            return redirect('/');
        }

    }

    public function reset_post_password(RestablecerPasswordRequest $request)
    {
        $password = $request->input('pwd1');
        $email = Crypt::decrypt($request->input('f'));
        $password = \Hash::make($password);
        $rs = Usuarios::cambiar_password($email, $password);
        if ($rs) {
            Session::flash('ok', 'Se ha cambiado la contraseña correctamente');
        }
        return redirect('/');
    }

    public function consultar()
    {
        return view('portal/consultarcobro/buscar');
    }

    public function resultados(ConsultarCobrosRut $request)
    {
        $rut = $request->input('rut');

        $data = null;

        if ($rut != null) {
            $rut = Utilidades::modificar_rut($rut);
            $data = Cobros::MisNoPagadas($rut, null, null, null, null);
            if ($data != null) {
                $data = $data->paginate(10);
            }
        }
        return view('portal/consultarcobro/resultado', compact('data', 'rut'));
    }

    public function resultadosGet(Request $request)
    {
        $token = $request->get("token");
        $rut = base64_decode($token);
        $data = null;
        if ($rut != null) {
            $rut = str_replace('.', '', $rut);
            $data = Cobros::MisNoPagadas($rut, null, null, null, null);
            if ($data != null) {
                $data = $data->paginate(10);
            }
        }
        return view('portal/consultarcobro/resultado', compact('data', 'rut'));
    }

    public function descargar(Request $request)
    {
        $download = $request->input('download');
        $path = Crypt::decrypt($download);
        $file = '/'.$path;

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        } else {
            return Redirect::back();
        }
    }

    public function active(Request $request)
    {
        $data = $request->input('b');
        $mensaje = "Error al activar la cuenta, notifique al administrador";

        if (!is_null($data)) {
            $email = Crypt::decrypt($data);
            if (!empty($email)) {
                $estado = Usuarios::activar_usuario($email);
                if ($estado) {
                    $mensaje = ' <h1><strong>Bienvenido a <img src="http://www.portaldepagos.cl/public/images/logo_portaldepagos_verde.png">.</strong></h1> <h3>Facilitamos el día a día de quien Paga y de quien Cobra.  <br> <br>Tu cuenta fue activada con éxito.
                    A partir de ahora podrás utilizar todos nuestros servicios.    </h3>               <br><br>
                    ';
                }
            }
        }
        return view('portal/aceptar_solicitud', compact('mensaje'));
    }

    public function editar_cuenta_bancaria(Request $request)
    {
        $banco = $request->input('banco');
        $tipo_cuenta = $request->input('tipo_cuenta');
        $nro_cuenta = $request->input('nro_cuenta');
        if (empty($banco)) {
            $banco=Session::get('banco');
            if (empty($tipo_cuenta)) {
                $tipo_cuenta=Session::get('tipo_cuenta');
                if (empty($nro_cuenta)) {
                    $nro_cuenta=Session::get('nro_cuenta');
                }
            }
        }

        $rs = DatosPagos::agregar_editar_pago(Session::get('id'), $banco, $tipo_cuenta, $nro_cuenta);

        if ($rs) {
            Session::put('banco', $banco);
            Session::put('nro_cuenta', $nro_cuenta);
            Session::put('tipo_cuenta', $tipo_cuenta);

            SendEmail::edicion_cuenta(Session::get('email'), Session::get('nombre'));

            Session::flash('ok', 'Se han actualizado los datos de pago correctamente');
        }

        if (empty(Session::get('r'))) {
            return Redirect::back();
        }
    }

    public function contacto()
    {
        $nombre = "";
        $celular = "";
        $rut = "";
        $email = "";

        if (Session::get('nombre') != null) {
            $rut = Session::get('rut');
            $nombre = Session::get('mi_nombre') . " " . Session::get('mi_apellido');
            $celular = Session::get('celular');
            $email = Session::get('email');
        }
        $menu_activado = 4;
        return view('portal/contacto', compact('nombre', 'celular', 'rut', 'email', 'menu_activado'));
    }

    public function contacto_post(ContactoRequest $request)
    {
        $motivo = $request->input('motivo');
        $celular = $request->input('celular');
        $solucion_esperada = $request->input('solucion_esperada');
        $rut = $request->input('rut');
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $mensaje = $request->input('mensaje');
        $rs = SendEmail::enviar_email_contacto($motivo, $celular, $solucion_esperada, $rut, $nombre, $email, $mensaje);

        if ($rs) {
            Session::flash('ok', 'Mensaje enviado con éxito. Te contactaremos a la brevedad');
        }
        return Redirect::back();
    }

    public function contacto_login(LoginRequest $request)
    {
        $rut = str_replace('.', '', $request->input('rut'));
        $usuario = Usuarios::where('rut', $rut)->first();
        $pagina = $request->input('pagina');
        if (!is_null($usuario)) {
            if ($usuario->activo == 1) {
                if ($usuario && Hash::check($request->input('passwordp'), $usuario->passwordp)) {
                    Auth::loginUsingId($usuario->idUsuarios);

                    Session::put('cerrar_publicidad', 0);
                    Session::put('nombre', $usuario->nombre);
                    Session::put('id', $usuario->idUsuarios);
                    Session::put('rut', $usuario->rut);
                    Session::put('mi_nombre', $usuario->nombre);
                    Session::put('mi_apellido', $usuario->apellido);
                    Session::put('email', $usuario->email);
                    Session::put('direccion', $usuario->direccion);
                    Session::put('nro_direccion', $usuario->nro_direccion);
                    Session::put('referencia', $usuario->referencia);
                    Session::put('complemento', $usuario->complemento);
                    Session::put('telefono', $usuario->telefono);
                    Session::put('celular', $usuario->celular);
                    Session::put('idrubros', $usuario->idrubros);
                    Session::put('IDRegion', $usuario->IDRegion);
                    Session::put('razon_social', $usuario->razon_social);

                    Session::put('lista_regiones', Regiones::all());
                    Session::put('lista_rubros', Rubros::all());

                    /* VISTA COBRADOR */
                    Session::put('idvista_cobrador', 0);
                    Session::put('permiso_cobrador', 0);
                    Session::put('rut_padre', 0);
                    /* FIN VISTA */


                    /* DATOS BANCARIOS */
                    $b = DatosPagos::buscar_pago($usuario->idUsuarios);

                    if ($b) {
                        Session::put('banco', $b->banco);
                        Session::put('nro_cuenta', $b->nro_cuenta);
                        Session::put('tipo_cuenta', $b->tipo_cuenta);
                    } else {
                        Session::put('banco', null);
                        Session::put('nro_cuenta', null);
                        Session::put('tipo_cuenta', null);
                    }
                    /* FIN DATOS BANCARIOS */


                    $last = Logaccesos::orderBy('created_at', 'desc')->first();
                    $log = new Logaccesos();
                    $log->IP = $request->getClientIp();
                    $log->idUsuarios = $usuario->idUsuarios;
                    $log->save();

                    if (is_null($last)) {
                        Session::put('ultimo_acceso', $log->created_at);
                    } else {
                        Session::put('ultimo_acceso', $last->created_at);
                    }

                    if (is_null($pagina) || empty($pagina)) {
                        return redirect('/cuentas-por-pagar');
                    } else if ($pagina == "contacto") {
                        return redirect('/contacto');
                    }


                } else {
                    return redirect('/')->withErrors([
                        'error_login' => 'Contraseña inválida, intente nuevamente',
                    ]);
                }
            } else {
                return redirect('/')->withErrors([
                    'error_login' => 'Debes activar tu cuenta',
                ]);
            }
        } else {
            return redirect('/')->withErrors([
                'error_login' => 'El Rut ingresado no se encuentra registrado. Regístrate, por favor.
                ',
            ]);
        }
    }
}
