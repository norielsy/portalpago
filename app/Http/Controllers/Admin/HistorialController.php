<?php
namespace App\Http\Controllers\Admin;
use App\ContenidoEmail;
use App\Extras\SendEmail;
use App\HistorialEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgregarContenidoEmail;
use App\PagarCuentas;
use App\Pagos;
use App\Usuarios;
use App\VistaCobradores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HistorialController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    public function index(Request $request){
        $id = $request->input('b');
        $tabla = null;
        if($id != null){
            $tabla = HistorialEmail::listar($id);
            if($tabla != null){
                $tabla = $tabla->paginate(10);
            }
        }
        //$usuarios = Usuarios::lists('rut', 'idUsuarios');
        $usuarios = Usuarios::listar_usuarios();
        return view('admin/Historial/index',compact('tabla','id','usuarios'));
    }

    public function contenido(){
        $tabla = ContenidoEmail::listar();
        $tabla = $tabla->paginate(10);
        return view('admin/Historial/contenido',compact('tabla'));
    }

    public function buscar_contenido(Request $request){
        $id = $request->input('id');
        $rs = ContenidoEmail::buscar($id);
        echo $rs;
    }

    public static function editar(AgregarContenidoEmail $request){
        $titulo = $request->input('titulo');
        $mensaje = $request->input('mensaje');
        $id = $request->input('id_edit');

        $rs = ContenidoEmail::editar($id,$titulo,$mensaje);
        if($rs){
            return Redirect::back()->with('message','Se editó el contenido con éxito');
        }else{
            return Redirect::back();
        }

    }


    public function reenviar(Request $request){
        $idUsuarios = $request->input('u');
        $para = $request->input('p');
        $tipo_email = $request->input('email');
        $de = $request->input('de');

        $rs = Usuarios::buscar_usuario_por_id($idUsuarios);
        switch($tipo_email){
            case 1:
                SendEmail::recuperar_password($rs->email);
                break;

            case 2:
                $rb = Usuarios::buscar_usuario_por_email($para);
                $last_id = VistaCobradores::verificar_usuarios($idUsuarios,$rb->idUsuarios);
                SendEmail::enviar_email_cobrador($last_id,$rb->email,$rs->nombre,$rs->idUsuarios);
                break;

            case 3:
                SendEmail::enviar_email_de_registro($rs->email,$rs->id,$rs->nombre . " " . $rs->apellido);
                break;

            case 4:
                SendEmail::nuevo_registro($rs->email,$rs->nombre . " " .$rs->apellido);
                break;

            case 5:
                SendEmail::edicion_cuenta($rs->email,$rs->nombre . " " .$rs->apellido);
                break;

            case 6:
                $bs = Usuarios::buscar_usuario_por_id($de);
                SendEmail::aviso_nuevo_cobro($rs->email,$bs->nombre." ".$bs->apellido,$bs->idUsuarios);
                break;

            case 7:
                $bs = Usuarios::buscar_usuario_por_id($de);
                SendEmail::nuevo_archivo_adjunto($rs->email,$bs->nombre." ".$bs->apellido,$bs->idUsuarios);
                break;
        }
        return Redirect::back()->with('message','Email reenviado con éxito');
    }

}
?>