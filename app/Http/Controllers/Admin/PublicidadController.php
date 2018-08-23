<?php
namespace App\Http\Controllers\Admin;
use App\Extras\Utilidades;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgregarPublicidad;
use App\Http\Requests\EditarPublicidad;
use App\PagarCuentas;
use App\Pagos;
use App\Publicidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PublicidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index(){
        $tabla = Publicidad::listar();
        $tabla = $tabla->paginate(10);
        return view('admin/Publicidad/index',compact('tabla'));
    }

    public function agregar_post(AgregarPublicidad $request){
        $titulo = $request->input('titulo');
        $file = $request->file('imagen');
        $descripcion = $request->input('descripcion');
        $link = $request->input('link');
        $fecha_inicio = Utilidades::formatoFechaDB($request->input('fecha_inicio'));
        $fecha_fin = Utilidades::formatoFechaDB($request->input('fecha_fin'));

        $extension = $file->getClientOriginalExtension();
        //$fileName = 'banner_interior.'.$extension;
        $fileName = Session::get('id').'-'.uniqid(rand(), true).'.'.$extension;

        if($file->move("public/images/p/", $fileName)){
            $rs = Publicidad::agregar($titulo,$fileName,$descripcion,$fecha_inicio,$fecha_fin,$link);
            if($rs){
                Session::flash('ok','Publicidad agregar correctamente');
            }
        }else{
            return Redirect::back()->withErrors('Error','Problema al guardar la imagen en el directorio');
        }
        return Redirect::back();
    }

    public function buscar(Request $request){
        $id = $request->input('id');
        if(is_numeric($id)){
            echo Publicidad::buscar($id);
        }
    }

    public function eliminar(Request $request){
        $id = $request->input('id_delete');
        if(is_numeric($id)){
            Publicidad::eliminar($id);
            return Redirect::back()->with('message','Publicidad eliminado con éxito');
        }else{
            return Redirect::back();
        }
    }

    public function editar(EditarPublicidad $request){
        $file = $request->file('doc');
        $titulo = $request->input('titulo');
        $descripcion = $request->input('descripcion');
        $id = $request->input('id_edit');
        $link = $request->input('link');
        $fecha_inicio = Utilidades::formatoFechaDB($request->input('fecha_inicio'));
        $fecha_fin = Utilidades::formatoFechaDB($request->input('fecha_fin'));

        $rs = Publicidad::editar($id,$titulo,$descripcion,$fecha_inicio,$fecha_fin,$link);
        if($rs){
            Session::flash('message','Publicidad editado correctamente');
        }
        if($file != null){
            $extension = $file->getClientOriginalExtension();
            if( ($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "gif")){
                $fileName = Session::get('id').'-'.uniqid(rand(), true).'.'.$extension;
                if($file->move("public/images/p/", $fileName)){
                    Publicidad::editar_imagen($id,$fileName);
                    Session::flash('message','Publicidad editado correctamente');
                }
            }else{
            }
        }
        return Redirect::back();
    }
}
?>