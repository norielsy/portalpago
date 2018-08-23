<?php
namespace App\Http\Controllers\Admin;
use App\Cobros;
use App\Extras\Utilidades;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgregarUsuarioAdmin;
use App\Http\Requests\EditarUsuarioDeudorRequest;
use App\NominasDetalles;
use App\Regiones;
use App\Rubros;
use App\Usuarios;
use App\VistaCobradores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index(Request $request){
        $rut = str_replace('.','',$request->input('rut'));
        $type = $request->input('type');
        $tabla = Usuarios::TablaAdminUsuarios($rut,$type);
        $tabla = $tabla->paginate(10);

        $regiones = Regiones::all();
        $rubros = Rubros::all();

        return view('admin/Usuarios/index',compact('tabla','regiones','rubros'));
    }

    public function buscar(Request $request){
        $rut = $request->input('rut');
        $rs = Usuarios::buscar_usuario_por_rut($rut);
        $x  = Usuarios::count_deudas_por_rut($rut);
        $rs["total_deudas"] = $x;
        echo $rs;
    }

    public function buscarnoregistrados(Request $request){
        $id = $request->input('rut');
        $from = $request->input('from');
        $rut = $request->input('rutno');
        
        if(is_numeric($id)){
            $rs = Usuarios::buscar_usuario_noregistrado($id,$from);
            $x  = Usuarios::count_deudas_por_rut($rut);
            $rs["total_deudas"] = $x;
            echo $rs;
        }
    }

    public function editar_no_registrado(Request $request){
        $email  = $request->input('email');
        $nombre = $request->input('nombre_empresa');
        $rut    = $request->input('rut_noregistrado');
        Cobros::editar_no_registrado($rut,$email,$nombre);
        NominasDetalles::editar_no_registrado($rut,$email,$nombre);
        return Redirect::back()->with('message','Usuario editado con éxito');
    }

    public function editar_deudor(EditarUsuarioDeudorRequest $request){

        $id = $request->input('id_edit');
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $celular = $request->input('celular');
        $direccion = $request->input('direccion');
        $IDRegion = $request->input('IDRegion');
        $idrubros = $request->input('idrubros');
        $tipo_usuario = $request->input('tipo_usuario');
        $rut_hijo = $request->input('rut_hijo');

        $apellido = $request->input('apellido');
        $razon_social = $request->input('razon_social');
        //echo $direccion;
        Usuarios::editar($id,$nombre,$email,$telefono,$celular,$direccion,$IDRegion,$idrubros,$tipo_usuario,$rut_hijo,$apellido,$razon_social);
        return Redirect::back()->with('message','Usuario editado con éxito');
    }

    public function eliminar(Request $request){
        $id = $request->input('id_delete');
        if(is_numeric($id)){
            Usuarios::eliminar($id);
            return Redirect::back()->with('message','Usuario eliminado con éxito');
        }else{
            return Redirect::back();
        }
    }

    public function agregar(){
        $regiones = Regiones::all();
        $rubros = Rubros::all();
        return view('admin/Usuarios/agregar',compact('regiones','rubros'));
    }

    public function agregar_post(AgregarUsuarioAdmin $request){

        $rut = $request->input('rut');
        $request["rut"] = Utilidades::modificar_rut($rut);
        $rs = Usuarios::buscar_usuario_por_rut($request["rut"]);
        $email = Usuarios::buscar_usuario_por_email($request->input('email'));

        if($rs != null){
            return Redirect::back()->withErrors(['El Rut ya se encuentra registrado']);
        }else if($email != null){
            return Redirect::back()->withErrors(['El email ya se encuentra registrado']);
        }else{
            $idUsuario = Usuarios::crear_usuario_admin(
                $request->input('nombre'),
                $request->input('email'),
                $request->input('telefono'),
                $request->input('celular'),
                $request->input('passwordp'),
                $request->input('rut'),
                $request->input('direccion'),
                $request->input('IDRegion'),
                $request->input('idrubros'),
                '',
                ''
            );

            $tipo_usuario = $request->input('tipo_usuario');

            if(!is_numeric($tipo_usuario)){
                $idPerfil = 1;
                if($tipo_usuario == "operativo") {
                    $idPerfil = 2;
                }
                $obj = Usuarios::buscar_usuario_por_rut($request->input('rut_hijo'));
                VistaCobradores::crear($obj['idUsuarios'],$idUsuario,$idPerfil,1);
            }

            return Redirect::back()->with('message','Usuario registrado con éxito');
        }

    }

}
?>