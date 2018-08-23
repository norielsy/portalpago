<?php
namespace App\Http\Controllers\Admin;
use App\Extras\Utilidades;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditarPortal;
use App\Http\Requests\EditarPublicidad;
use App\ImagenPortal;
use App\PagarCuentas;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ImagenPortalController extends Controller
{
    public function __construct()
    {

        $this->middleware('isAdmin');
    }

    public function index(){

        $tabla = ImagenPortal::listar();
        $tabla = $tabla->paginate(10);
        return view('admin/Portal/index',compact('tabla'));
    }
    /*
    public function agregar_post(AgregarPublicidad $request){
        $titulo = $request->input('titulo');
        $file = $request->file('imagen');
        $descripcion = $request->input('descripcion');
        $fecha_inicio = Utilidades::formatoFechaDB($request->input('fecha_inicio'));
        $fecha_fin = Utilidades::formatoFechaDB($request->input('fecha_fin'));

        $extension = $file->getClientOriginalExtension();
        //$fileName = 'banner_interior.'.$extension;
        $fileName = Session::get('id').'-'.uniqid(rand(), true).'.'.$extension;

        if($file->move("public/images/portal/", $fileName)){
            $rs = ImagenPortal::agregar($titulo,$fileName,$descripcion,$fecha_inicio,$fecha_fin);
            if($rs){
                Session::flash('ok','Publicidad agregar correctamente');
            }
        }else{
            return Redirect::back()->withErrors('Error','Problema al guardar la imagen en el directorio');
        }
        return Redirect::back();
    }*/

    public function buscar(Request $request){
        $id = $request->input('id');
        if(is_numeric($id)){
            echo ImagenPortal::buscar($id);
        }
    }

    public function eliminar(Request $request){
        $id = $request->input('id_delete');
        if(is_numeric($id)){
            ImagenPortal::eliminar($id);
            return Redirect::back()->with('message','Publicidad eliminado con éxito');
        }else{
            return Redirect::back();
        }
    }

    public function editar(EditarPortal $request){
        $file = $request->file('doc');
        $titulo = $request->input('titulo');
        $descripcion = $request->input('descripcion');
        $link = $request->input('link');
        $id = $request->input('id_edit');

        $rs = ImagenPortal::editar($id,$titulo,$descripcion,$link);
        if($rs){
            Session::flash('message','Publicidad editado correctamente');
        }
        if($file != null){
            $extension = $file->getClientOriginalExtension();
            if( ($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "gif")){
                $fileName = Session::get('id').'-'.uniqid(rand(), true).'.'.$extension;
                if($file->move("public/images/portal/", $fileName)){
                    ImagenPortal::editar_imagen($id,$fileName);
                    Session::flash('message','Publicidad editado correctamente');
                }
            }else{
            }
        }
        return Redirect::back();
    }
}
?>