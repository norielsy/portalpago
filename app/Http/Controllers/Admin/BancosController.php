<?php
namespace App\Http\Controllers\Admin;
use App\Bancos;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgregarBancoRequest;
use App\Http\Requests\AgregarRubro;
use App\Http\Requests\EditarBanco;
use App\Http\Requests\EditarRubro;
use Illuminate\Http\Request;
use App\PagarCuentas;
use App\Rubros;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BancosController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index(){
        $tabla = Bancos::tabla();
        $tabla = $tabla->paginate(10);
        return view('admin/Bancos/index',compact('tabla'));
    }

    public function buscar(Request $request){
        $id = $request->input('id');
        if(is_numeric($id)){
            echo Bancos::buscar($id);
        }
    }

    public function eliminar(Request $request){
        $id = $request->input('id_delete');
        if(is_numeric($id)){
            Bancos::eliminar($id);
            return Redirect::back()->with('message','Banco eliminado con éxito');
        }else{
            return Redirect::back();
        }
    }

    public function agregar(){
        return view('admin/Bancos/agregar');
    }

    public function agregarpost(AgregarBancoRequest $request){
        $banco = $request->input('banco');
        $rs = Bancos::insert($banco);
        if($rs){
            Session::flash('message','Banco agregado correctamente');
        }
        return Redirect::back();
    }

    public function editar(EditarBanco $request){
        $banco = $request->input('banco');
        $id = $request->input('id_edit');

        $rs = Bancos::editar($id,$banco);
        if($rs){
            Session::flash('message','Banco editado correctamente');
        }
        return Redirect::back();
    }

}
?>