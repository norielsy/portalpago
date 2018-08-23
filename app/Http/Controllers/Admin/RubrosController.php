<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgregarRubro;
use App\Http\Requests\EditarRubro;
use Illuminate\Http\Request;
use App\PagarCuentas;
use App\Rubros;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RubrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index(){
        $tabla = Rubros::tabla();
        $tabla = $tabla->paginate(10);
        return view('admin/Rubros/index',compact('tabla'));
    }

    public function buscar(Request $request){
        $id = $request->input('id');
        if(is_numeric($id)){
            echo Rubros::buscar($id);
        }
    }

    public function eliminar(Request $request){
        $id = $request->input('id_delete');
        if(is_numeric($id)){
            Rubros::eliminar($id);
            return Redirect::back()->with('message','Rubro eliminado con éxito');
        }else{
            return Redirect::back();
        }
    }

    public function agregar(){
        return view('admin/Rubros/agregar');
    }

    public function agregarpost(AgregarRubro $request){
        $rubro = $request->input('rubro');
        $rs = Rubros::insert($rubro);
        if($rs){
            Session::flash('message','Rubro agregado correctamente');
        }
        return redirect('admincp/rubros');
    }

    public function editar(EditarRubro $request){
        $rubro = $request->input('rubro');
        $id = $request->input('id_edit');

        $rs = Rubros::editar($id,$rubro);
        if($rs){
            Session::flash('message','Rubro editado correctamente');
        }
        return Redirect::back();
    }

}
?>