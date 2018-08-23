<?php
namespace App\Http\Controllers;
use App\ContenidoEmail;
use App\HistorialEmail;
use App\Http\Requests\RegistrarRequest;
use App\PagarCuentas;
use App\Perfiles_cobrador;
use App\TipoPagos;
use App\Usuarios;
use App\VistaCobradores;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Extras;
class CobradoresController extends  Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['confirmar']]);
    }

    public function index(Request $request)
    {
        $lista = Perfiles_cobrador::lista();
        $categorias_popup = $lista->lists('descripcion','idperfiles_cobrado');
        $tabla = VistaCobradores::tabla(Session::get('id'));
        $tabla = $tabla->paginate(10);
        $menu_activado = 3;
        return view('logueado/cobradores/index',compact('categorias_popup','tabla','menu_activado'));
    }

    public function json_verificar_cobrador(Request $request){
        $rut = Extras\Utilidades::modificar_rut($request->input('rut_cobrador'));
        $rs = Usuarios::buscar_usuario_por_rut($rut);
        if(Session::get('rut') == $rut){
            echo json_encode(array('estado' => 8, 'm' => 'No puedes agregarte como cobrador, intenta con otro rut.' ));
        }else if(!is_null($rs)){
            $rs2 = VistaCobradores::verificar_usuarios(Session::get('id'),$rs->idUsuarios);
            if(!is_null($rs2)){
                echo json_encode(array('estado' => 7 ,'m' => 'El rut '.$request->input('rut'). ' ya se encuentra asignado'));
            }else{
                $last_id = VistaCobradores::crear(Session::get('id'),$rs->idUsuarios,$request->input('perfil_cobrador'));
                $a = Extras\SendEmail::enviar_email_cobrador($last_id,$rs,Session::get('nombre'),Session::get('id'));
                if($a){
                    echo json_encode(array('estado' => 1 ,'m' => 'La notificación de registro fue enviada con éxito'));
                }else{
                    echo json_encode(array('estado' => $a,'m' => 'Hubo un error al enviar el mensaje de registro, intente nuevamente'));
                }
            }
        }else{
            echo json_encode(array('estado' => 9 , 'm' => 'El usuario registrado no existe. ¿deseas envíar una notificación de registro?'));
        }
    }

    public function enviar_email_registro(Request $request){
        $a = Extras\SendEmail::enviar_email_de_registro($request->input('email_notificacion_registro'),Session::get('id'),Session::get('nombre'));
        if($a){
            echo json_encode(array('estado' => 1 ,'m' => 'La notificación de registro fue enviada con éxito'));
        }else{
            echo json_encode(array('estado' => $a,'m' => 'Hubo un error al enviar el mensaje de registro, intente nuevamente'));
        }
    }

    public function delete(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        if(is_numeric($id)){
            VistaCobradores::eliminar(Session::get('id'),$id);
        }

        return Redirect::back();
    }

    public function edit(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $idperfil = $request->input('perfil');

        if(is_numeric($id) && is_numeric($idperfil)){
            VistaCobradores::editar(Session::get('id'),$id,$idperfil);
        }
        return Redirect::back();
    }

    public function confirmar(Request $request){
        $data = $request->input('b');
        $mensaje = "Hubo un error al aceptar la solicitud";

        if(!is_null($data)){
            $id = Crypt::decrypt($data);
            if(is_numeric($id)){
                $estado = VistaCobradores::confirmar($id);
                if($estado){
                    $mensaje = "Solicitud aceptada correctamente";
                }
            }
        }
        return view('portal/aceptar_solicitud',compact('mensaje'));
    }
}
?>