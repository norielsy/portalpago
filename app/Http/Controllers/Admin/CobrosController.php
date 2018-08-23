<?php
namespace App\Http\Controllers\Admin;
use App\Cobros;
use App\Extras\Utilidades;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgregarCobrosAdmin;
use App\Http\Requests\AgregarNominaAdmin;
use App\Usuarios;
use App\Extras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CobrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function agregar(){
        return view('admin/Cobros/agregar');
    }

    public function agregar_nomina(){
        return view('admin/Cobros/agregar_nomina');
    }

    public function agregar_nomina_post(AgregarNominaAdmin $request){

        $empresa = $request->input('empresa');
        $file = $request->file('excel');
        $fecha_vencimiento_m = $request->input('fecha_vencimiento');
        $inputFileName = $file->getRealPath();
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 2; $row <= $highestRow; $row++) {
            $errores = false;
            $mensajes = array();


            $rowData = $sheet->rangeToArray('A' . $row . ':E' . $row, NULL, TRUE, FALSE);

            $rut = $rowData[0][0];
            $email = $rowData[0][1];
            $monto = $rowData[0][2];
            $fecha_vencimiento = $rowData[0][3];
            $fecha_vencimiento = \PHPExcel_Style_NumberFormat::toFormattedString($fecha_vencimiento, 'DD/MM/YYYY');
            $nombre = $rowData[0][4];

            if(!Extras\Utilidades::ValidarRut($rut)){
                $errores = true;
                $mensajes[] = "Rut no válido";
            }

            if(!Extras\Utilidades::ValidarEmail($email)){
                $errores = true;
                $mensajes[] = "Email no válido";
            }

            if(!Extras\Utilidades::EsNumero($monto)){
                $errores = true;
                $mensajes[] = "Monto no válido";
            }

            if(!Extras\Utilidades::StringValido($nombre)){
                $errores = true;
                $mensajes[] = "Nombre no válido";
            }

            if(!Extras\Utilidades::ValidarFecha($fecha_vencimiento)){
                $errores = true;
                $mensajes[] = "Fecha no válida, día-mes-año";
            }

            if($errores){
                $msg = Extras\Utilidades::errorMensajeLoop($row,$mensajes);
                Session::flash('error_excel',$msg);
                return Redirect::back();
                break;
            }
        }

        $obj = Usuarios::buscar_usuario_por_rut($request->input('rut_cobrador'));

        $ultimo_id_registro_excel = 0;
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':F' . $row, NULL, TRUE, FALSE);
            $rut = $rowData[0][0];
            $email = $rowData[0][1];
            $monto = $rowData[0][2];
            $fecha_vencimiento = $rowData[0][3];
            $fecha_vencimiento = \PHPExcel_Style_NumberFormat::toFormattedString($fecha_vencimiento, 'DD/MM/YYYY');
            $nombre = $rowData[0][4];
            $descripcion = $rowData[0][5];

            if($row == 2){
                $tabla_nominas = new Nominas();
                $tabla_nominas->empresa = $empresa;

                $tabla_nominas->idUsuarios = $obj['idUsuarios'];

                $tabla_nominas->descripcion = $request->input('descripcion');
                $tabla_nominas->fecha_vencimiento = Extras\Utilidades::formatoFechaDB($fecha_vencimiento_m);

                $tabla_nominas->save();
                $ultimo_id_registro_excel = $tabla_nominas->idnominas;
                $DetalleNomina = new NominasDetalles();
                $DetalleNomina->idnominas = $tabla_nominas->idnominas;
                $DetalleNomina->email = $email;
                $DetalleNomina->monto = $monto;
                $DetalleNomina->nombre = $nombre;
                $DetalleNomina->fecha_vencimiento = Extras\Utilidades::formatoFechaDB($fecha_vencimiento);
                $DetalleNomina->descripcion = $descripcion;
                $DetalleNomina->rut = $rut;
                $DetalleNomina->save();
            }else if($ultimo_id_registro_excel > 0){
                $DetalleNomina = new NominasDetalles();
                $DetalleNomina->idnominas = $ultimo_id_registro_excel;
                $DetalleNomina->email = $email;
                $DetalleNomina->monto = $monto;
                $DetalleNomina->nombre = $nombre;
                $DetalleNomina->fecha_vencimiento = Extras\Utilidades::formatoFechaDB($fecha_vencimiento);
                $DetalleNomina->descripcion = $descripcion;
                $DetalleNomina->rut = $rut;
                $DetalleNomina->save();
            }
        }
        Session::flash('ok','Excel cargado correctamente');
        return Redirect::back();
    }

    public function agregar_post(AgregarCobrosAdmin $request){

        $obj = Usuarios::buscar_usuario_por_rut($request->input('rut_cobrador'));

        $empresa = $request->input('empresa');
        $rut = $request->input('rut_empresa');
        $fecha_vencimiento = $request->input('fecha_vencimiento');

        $tabla_cobros = new Cobros();
        $tabla_cobros->empresa = $empresa;

        $tabla_cobros->idUsuarios = $obj['idUsuarios'];
        $tabla_cobros->rut_empresa = $rut;
        $tabla_cobros->email = $request->input('email');
        $tabla_cobros->monto = $request->input('monto');
        $tabla_cobros->fecha_vencimiento = Utilidades::formatoFechaDB($fecha_vencimiento);
        $tabla_cobros->descripcion = $request->input('descripcion');

        $tabla_cobros->save();
        return Redirect::back()->with('message','Cobro agregado con éxito');
    }

    public function buscar(Request $request){
        $obj = Usuarios::buscar_usuario_por_rut($request->input('rut'));
        echo json_encode($obj);
    }

    public function pagadas(){
        return view('admin/Cobros/cobros_pagadados');
    }

    public function pendientes(){
        return view('admin/Cobros/cobros_pendientes');
    }
}
?>