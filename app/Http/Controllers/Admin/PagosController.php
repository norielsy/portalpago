<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgregarFormaPago;
use App\PagarCuentas;
use App\Pagos;
use App\TipoCuenta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index(){
        $tabla = Pagos::listar();
        $tabla = $tabla->paginate(10);

        $tabla_cuenta = TipoCuenta::listar();
        $tabla_cuenta = $tabla_cuenta->paginate(10);
        return view('admin/Pagos/index',compact('tabla','tabla_cuenta'));
    }

    public function agregar(){
        return view('admin/Pagos/agregar');
    }

    public function agregarpost(AgregarFormaPago $request){
        $pago = $request->input('pago');
        if($pago != null){
            $rs = Pagos::agregar($pago);
            if($rs){
                return Redirect::back()->with('message','Forma de pago agregado con éxito');
            }else{
                return redirect::back()->withErrors([
                    'Agregar' => 'Hubo un error al agregar la forma de pago. Intente nuevamente',
                ]);
            }
        }
        return Redirect::back();
    }

    public function buscar(Request $request){
        $id = $request->input('id');
        if(is_numeric($id)){
            echo Pagos::buscar($id);
        }
    }

    public function eliminar(Request $request){
        $id = $request->input('id_delete');
        if(is_numeric($id)){
            $rs = Pagos::eliminar($id);
            if($rs){
                return Redirect::back()->with('message','Forma de pago eliminado con éxito');
            }else{
                return redirect::back()->withErrors([
                    'Agregar' => 'Hubo un error al eliminar la forma de pago. Intente nuevamente',
                ]);
            }
        }else{
            return Redirect::back();
        }
    }

    public function editar(Request $request){
        $id = $request->input('id_edit');
        $pago = $request->input('pago');
        if(is_numeric($id)){
            $rs = Pagos::editar($id,$pago);
            if($rs){
                return Redirect::back()->with('message','Forma de pago editado con éxito');
            }else{
                return redirect::back()->withErrors([
                    'Agregar' => 'Hubo un error al editar la forma de pago. Intente nuevamente',
                ]);
            }
        }else{
            return Redirect::back();
        }
    }






    /* ------------------------ TIPO CUENTA --------------------------------------*/




    public function agregarpost_cuenta(Request $request){
        $pago = $request->input('cuenta');
        if($pago != null){
            $rs = TipoCuenta::agregar($pago);
            if($rs){
                return Redirect::back()->with('message','Tipo de cuenta agregado con éxito');
            }else{
                return redirect::back()->withErrors([
                    'Agregar' => 'Hubo un error al agregar tipo de cuenta. Intente nuevamente',
                ]);
            }
        }
        return Redirect::back();
    }

    public function buscar_cuenta(Request $request){
        $id = $request->input('id');
        if(is_numeric($id)){
            echo TipoCuenta::buscar($id);
        }
    }

    public function eliminar_cuenta(Request $request){
        $id = $request->input('id_delete_cuenta');
        if(is_numeric($id)){
            $rs = TipoCuenta::eliminar($id);
            if($rs){
                return Redirect::back()->with('message','Tipo de cuenta eliminado con éxito');
            }else{
                return redirect::back()->withErrors([
                    'Agregar' => 'Hubo un error al eliminar tipo de cuenta. Intente nuevamente',
                ]);
            }
        }else{
            return Redirect::back();
        }
    }

    public function editar_cuenta(Request $request){
        $id = $request->input('id_edit_cuenta');
        $pago = $request->input('cuenta');
        if(is_numeric($id)){
            $rs = TipoCuenta::editar($id,$pago);
            if($rs){
                return Redirect::back()->with('message','Tipo de cuenta editado con éxito');
            }else{
                return redirect::back()->withErrors([
                    'Agregar' => 'Hubo un error al editar tipo de cuenta. Intente nuevamente',
                ]);
            }
        }else{
            return Redirect::back();
        }
    }

}
?>