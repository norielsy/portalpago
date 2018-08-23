<?php
namespace App\Http\Controllers\Admin;
use App\Cobros;
use App\Extras\Utilidades;
use App\Http\Controllers\Controller;
use App\Nominas;
use App\NominasDetalles;
use App\PagarCuentas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class DeudasController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function pagadas(Request $request){

        $rut_deudor = $request->input('rut_deudor');
        $rut_cobrador = $request->input('rut_cobrador');

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        if(!empty($desde)) {
            $desde = Utilidades::formatoFechaDB($desde);
        }

        if(!empty($hasta)) {
            $hasta = Utilidades::formatoFechaDB($hasta);
        }

        $tabla = Cobros::ListaEmpresaPagadasAdmin($rut_deudor,$rut_cobrador,$desde,$hasta);
        $tabla = $tabla->paginate(10);
        return view('admin/Deudas/deudas_pagadas',compact('tabla'));
    }

    public function pagadas_export(Request $request){

        $rut_deudor = $request->input('rut_deudor');
        $rut_cobrador = $request->input('rut_cobrador');

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        if(!empty($desde)) {
            $desde = Utilidades::formatoFechaDB($desde);
        }

        if(!empty($hasta)) {
            $hasta = Utilidades::formatoFechaDB($hasta);
        }

        $data = array(
            'rut_deudor' => $rut_deudor,
            'rut_cobrador' => $rut_cobrador,
            'desde' => $desde,
            'hasta' => $hasta
        );

        Excel::create('Pagadas', function($excel) use ($data) {
            $excel->sheet('Pagadas', function($sheet) use ($data) {
                $rs = Cobros::ListaEmpresaPagadasAdminExcel($data['rut_deudor'],$data['rut_cobrador'],$data['desde'],$data['hasta']);
                $sheet->fromArray($rs);
                $sheet->setAutoFilter();
            });
        })->export('xls');
    }

    public function pagadas_buscar(Request $request){
        $id = $request->input('id');
        $tipo = $request->input('tipo');
        if(is_numeric($id) && is_numeric($tipo)){
            if($tipo == 1){
                echo Cobros::buscar_cobro_id_pagado($id);
            }else if($tipo == 2){
                echo NominasDetalles::buscar_detalle_pagado($id);
            }
        }
    }

    public function eliminar(Request $request){
        $id = $request->input('id_delete');
        $type = $request->input('id_type');
        if(is_numeric($id) && is_numeric($type)){
            if($type == 1){ // cobros
                Cobros::eliminar($id);
            }else if($type == 2){ //nominas
                NominasDetalles::eliminar($id);
            }
            return Redirect::back()->with('message','Deuda eliminada con éxito');
        }else{
            return Redirect::back();
        }
    }

    public function pendientes(Request $request){

        $rut_deudor = $request->input('rut_deudor');
        $rut_cobrador = $request->input('rut_cobrador');

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        if(!empty($desde)) {
            $desde = Utilidades::formatoFechaDB($desde);
        }

        if(!empty($hasta)) {
            $hasta = Utilidades::formatoFechaDB($hasta);
        }

        $tabla = Cobros::ListaPendientesAdmin($rut_deudor,$rut_cobrador,$desde,$hasta);
        $tabla = $tabla->paginate(10);
        return view('admin/Deudas/deudas_pendientes',compact('tabla'));
    }

    public function pendientes_export(Request $request){

        $rut_deudor = $request->input('rut_deudor');
        $rut_cobrador = $request->input('rut_cobrador');

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        if(!empty($desde)) {
            $desde = Utilidades::formatoFechaDB($desde);
        }

        if(!empty($hasta)) {
            $hasta = Utilidades::formatoFechaDB($hasta);
        }

        $data = array(
            'rut_deudor' => $rut_deudor,
            'rut_cobrador' => $rut_cobrador,
            'desde' => $desde,
            'hasta' => $hasta
        );

        Excel::create('Pendientes', function($excel) use ($data) {
            $excel->sheet('Pendientes', function($sheet) use ($data) {
                $rs = Cobros::ListaPendientesAdminExcel($data['rut_deudor'],$data['rut_cobrador'],$data['desde'],$data['hasta']);
                $sheet->fromArray($rs);
                $sheet->setAutoFilter();
            });
        })->export('xls');
    }

    public function pendientes_buscar(Request $request){
        $id = $request->input('id');
        $tipo = $request->input('tipo');
        if(is_numeric($id) && is_numeric($tipo)){
            if($tipo == 1){ //cobro
                echo Cobros::buscar_cobro_id_no_pago($id);
            }else if($tipo == 2){ //nomina
                echo NominasDetalles::buscar_detalle_no_pagado($id);
            }
        }
    }

    public function editar(Request $request){

        $id = $request->input('id_edit');
        $tipo = $request->input('tipo_edit');
        $rut = $request->input('rut_deudor_pen');
        $empresa = $request->input('empresa_deudor_pen');
        $email = $request->input('email_pen');
        $descripcion_pen = $request->input('descripcion_pen');
        $fecha_vencimiento = Utilidades::formatoFechaDB($request->input('fecha_vencimiento_pen'));
        $monto = $request->input('monto_pen');

        if($tipo == 1){ //cobros
            $rs = Cobros::where('idCobros',$id)
                ->update(array(
                    'rut_empresa' => $rut,
                    'empresa' => $empresa,
                    'email' => $email,
                    'descripcion' => $descripcion_pen,
                    'fecha_vencimiento' => $fecha_vencimiento,
                    'monto' => $monto
                ));

        }else if($tipo == 2){ //nominadetalle
            $rs = NominasDetalles::where('idnominasdetalle',$id)
                        ->update(array(
                            'rut' => $rut,
                            'nombre' => $empresa,
                            'email' => $email,
                            'descripcion' => $descripcion_pen,
                            'fecha_vencimiento' => $fecha_vencimiento,
                            'monto' => $monto
                        ));
        }
        if($rs){
            return Redirect::back()->with('message','Deuda editada con éxito');
        }else{
            return Redirect::back();
        }
    }
}
?>