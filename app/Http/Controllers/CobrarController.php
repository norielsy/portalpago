<?php

namespace App\Http\Controllers;

use App\Cobros;
use App\DatosPagos;
use App\Extras;
use App\Http\Requests\AdjuntarDocumentoPortal;
use App\Http\Requests\CobrosNominaRequest;
use App\Http\Requests\EditarDetalleNomina;
use App\Http\Requests\EditarIndividual;
use App\Nominas;
use App\NominasDetalles;
use App\TipoPagos;
use App\Usuarios;
use App\VistaCobradores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use League\Flysystem\Exception;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class CobrarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cambiar_vista(Request $request)
    {
        $id = (int)$request->input('view');
        if (is_numeric($id) && $id > 0) {
            $rs = VistaCobradores::buscar_permiso($id, Session::get('id'));
            if (!is_null($rs)) {
                Session::put('idvista_cobrador', $id);
                Session::put('permiso_cobrador', $rs->idperfiles_cobrado);
                Session::put('rut_padre', $rs->idUsuariosMaestro);
            } else {
                Session::put('idvista_cobrador', 0);
                Session::put('permiso_cobrador', 0);
            }
        } else {
            Session::put('idvista_cobrador', 0);
            Session::put('permiso_cobrador', 0);
        }
        if ($request->ajax()) {
            return ['success' => true];
        }
        return Redirect::back();
    }

    public function indexCobro(Request $request)
    {
        Session::forget('r');
        $user = Auth::user();
        if (!$user->direccion || !$user->comuna || !$user->celular || !$user->IDRegion || !$user->idrubros) {
            return redirect(asset('/editarcuenta?r=' . URL::current()));
        }
        $datos_cuenta = DatosPagos::where('idUsuarios', $user->idUsuarios)->first();
        if (!$datos_cuenta) {
            return redirect(asset('/editarcuenta?r=' . URL::current()));
        }
        $buscar_rut = $request->input('rut');
        if (Session::get('idvista_cobrador') == 0) { //VISTA PADRE
            $pendientes = Cobros::ListaCobrosFiltros(Session::get('id'), $request->get('fecha'), $request->get('empresa'), null, $buscar_rut);
        } else {
            $pendientes = Cobros::ListaCobrosFiltros(Session::get('rut_padre'), $request->get('fecha'), $request->get('empresa'), Session::get('id'), $buscar_rut);
        }
        $pagadas = Cobros::ListaCobrosFiltrosPagados(Session::get('id'), null, null, null, null, null);
        $pendientes = $pendientes->take(10)->paginate(10);
        $pagadas = $pagadas->take(10)->paginate(10);
        return view('logueado.cobrar_cuentas.index_cobros', ['pagadas' => $pagadas, 'pendientes' => $pendientes, 'menu_activado' => 2]);
    }

    public function index(Request $request)
    {
        $buscar_rut = $request->input('rut');
        $buscar_rut = str_replace('.', '', $buscar_rut);
        $activar_cobrar = 1;
        $menu_cobro = 1;
        if (Session::get('idvista_cobrador') == 0) { // Usuario Padre
            $cobros = Cobros::nominas(Session::get('id'), $request->get('fecha'), $request->get('empresa'), null, $buscar_rut);
            $empresas = Cobros::ListaEmpresaNomina(Session::get('id'), false);
        } else {
            $cobros = Cobros::nominas(Session::get('rut_padre'), $request->get('fecha'), $request->get('empresa'), Session::get('id'), $buscar_rut);
            $empresas = Cobros::ListaEmpresaNomina(Session::get('rut_padre'), false);
        }
        $cobros = $cobros->paginate(10);

        $empresas = $empresas->lists('empresa', 'empresa');
        $item_seleccionado = $request->get('empresa');

        $vista = VistaCobradores::vistas(Session::get('id'));
        $vista = $vista->lists('descripcion', 'idVistaCobradores');

        $menu_activado = 2;
        return view('logueado/cobrar_cuentas/nominas/index', compact('cobros', 'activar_cobrar', 'empresas', 'item_seleccionado', 'vista', 'buscar_rut', 'menu_cobro', 'menu_activado'));
    }

    public function dashboard(Request $request)
    {
        $buscar_rut = $request->input('rut');
        if (Session::get('idvista_cobrador') == 0) { //VISTA PADRE
            $cobros_no_pagados = Cobros::ListaCobrosFiltros(Session::get('id'), $request->get('fecha'), $request->get('empresa'), null, $buscar_rut);
            $cobros_no_pagados = Cobros::ListarMisCobrosPendiente(Session::get('id'), null, null, null, null);

        } else {
            $cobros_no_pagados = Cobros::ListaCobrosFiltros(Session::get('rut_padre'), $request->get('fecha'), $request->get('empresa'), Session::get('id'), $buscar_rut);
            $cobros_no_pagados = Cobros::ListarMisCobrosPendiente(Session::get('rut_padre'), null, null, null, null);
        }
        $cobros_pagados = Cobros::ListaCobrosFiltrosPagados(Session::get('id'), null, null, null, null, null);
        $cobros_no_pagados = $cobros_no_pagados->get();
        $cobros_no_pagados = collect($cobros_no_pagados);
        $total_cobros_no_pagados = $cobros_no_pagados->count();
        $suma_cobros_no_pagados = number_format($cobros_no_pagados->sum('monto'), 0, ",", ".");
        //$cobros_no_pagados = $cobros_no_pagados;
        $cobros_no_pagados = $cobros_no_pagados->take(10);
        $total_cobros_pagados = $cobros_pagados->count();
        $suma_cobros_pagados = number_format($cobros_pagados->sum('monto'), 0, ",", ".");

        $deudas_no_pagadas = Cobros::where('rut_empresa', Session::get('rut'))->where('pagado', 0)->where('eliminado', 0)->get();
        $deudas_no_pagadas = Cobros::MisNoPagadas(Session::get('rut'), $request->get('fecha'), $request->get('monto'), $request->get('empresa'), $buscar_rut)->get();
        $deudas_no_pagadas = collect($deudas_no_pagadas);
        $suma_deudas_no_pagadas = number_format($deudas_no_pagadas->sum('monto'), 0, ",", ".");
        $total_deudas_no_pagadas = $deudas_no_pagadas->count();
        $deudas_no_pagadas = $deudas_no_pagadas->take(10);

        $deudas_pagadas = Cobros::where(['rut_empresa' => Session::get('rut'), 'pagado' => 1, 'eliminado' => 0])->get();
        $deudas_pagadas = Cobros::MisPagadas(Session::get('rut'), null, null, null, null);
        $suma_deudas_pagadas = number_format($deudas_pagadas->sum('monto'), 0, ",", ".");
        $total_deudas_pagadas = $deudas_pagadas->count();

        return view('logueado/dashboard', compact('cobros_no_pagados', 'total_cobros_no_pagados', 'suma_cobros_no_pagados', 'total_cobros_pagados', 'suma_cobros_pagados', 'deudas_no_pagadas', 'suma_deudas_no_pagadas', 'total_deudas_no_pagadas', 'suma_deudas_pagadas', 'total_deudas_pagadas'));
    }

    public function exportar_nomina_excel()
    {
        Excel::create('Exportación de nóminas', function ($excel) {
            $excel->sheet('Productos', function ($sheet) {

                if (Session::get('idvista_cobrador') == 0) { // Usuario Padre
                    $data = Cobros::excel_nomina(Session::get('id'), null);
                } else {
                    $data = Cobros::excel_nomina(Session::get('rut_padre'), Session::get('id'));
                }
                $sheet->fromArray($data);
                $sheet->setAutoFilter();
            });
        })->export('xls');
    }

    public function exportar_individuales_excel()
    {
        Excel::create('Cobros individuales', function ($excel) {
            $excel->sheet('Productos', function ($sheet) {
                if (Session::get('idvista_cobrador') == 0) { //VISTA PADRE
                    $data = Cobros::excel_individual(Session::get('id'), null);
                } else {
                    $data = Cobros::excel_individual(Session::get('rut_padre'), Session::get('id'));
                }
                $sheet->fromArray($data);
                $sheet->setAutoFilter();
            });
        })->export('xls');
    }

    public function exportar_pagadas()
    {
        Excel::create('Cobros Pagados', function ($excel) {
            $excel->sheet('Productos', function ($sheet) {
                $data = Cobros::excel_cobros_pagados(Session::get('id'));
                $sheet->fromArray($data);
                $sheet->setAutoFilter();
            });
        })->export('xls');
    }

    public function nominasdetalle($id, Request $request)
    {
        if (is_numeric($id)) {
            $activar_cobrar = 1;
            if (Session::get('idvista_cobrador') == 0) {
                $nombre = Nominas::where('idUsuarios', Session::get('id'))
                ->where('idnominas', $id)
                ->select('empresa')->first();
            } else {
                $nombre = Nominas::where('idUsuarios', Session::get('rut_padre'))
                ->where('idnominas', $id)
                ->select('empresa')->first();
            }

            if (!is_null($nombre)) {
                $nombre = $nombre->empresa;
                if (Session::get('idvista_cobrador') == 0) {
                    $detalles = Cobros::detallenominas($id, $request->get('monto'));
                } else {
                    $detalles = Cobros::detallenominasPadre($id, Session::get('rut'), $request->get('monto'));
                }
                $detalles = $detalles->paginate(10);
                $metodo_pago = TipoPagos::all();
                $menu_activado = 2;
                return view('logueado/cobrar_cuentas/nominas/detalle', compact('detalles', 'nombre', 'activar_cobrar', 'id', 'metodo_pago', 'menu_activado'));
            } else {
                return Redirect::back();
            }
        } else {
            return Redirect::back();
        }
    }

    public function puntales(Request $request)
    {
        Session::forget('r');
        $user = Auth::user();
        if (!$user->direccion || !$user->comuna || !$user->celular || !$user->IDRegion || !$user->idrubros) {
            return redirect(asset('/editarcuenta?r=' . URL::current()));
        }
        $datos_cuenta = DatosPagos::where('idUsuarios', $user->idUsuarios)->first();
        if (!$datos_cuenta) {
            return redirect(asset('/editarcuenta?r=' . URL::current()));
        }
        $activar_cobrar = 1;
        $buscar_rut = $request->input('rut');
        if (Session::get('idvista_cobrador') == 0) { //VISTA PADRE
            $pendientes = Cobros::ListaCobrosFiltros(Session::get('id'), $request->get('fecha'), $request->get('empresa'), null, $buscar_rut);
            $empresas = Cobros::ListaEmpresaPuntuales(Session::get('id'), 0, null);
        } else {
            $pendientes = Cobros::ListaCobrosFiltros(Session::get('rut_padre'), $request->get('fecha'), $request->get('empresa'), Session::get('id'), $buscar_rut);
            $empresas = Cobros::ListaEmpresaPuntuales(Session::get('rut_padre'), 0, Session::get('id'));
        }
        $pagadas = Cobros::ListaCobrosFiltrosPagados(Session::get('id'), null, null, null, null, null);
        $pendientes = $pendientes->paginate(10);
        $empresas = $empresas->lists('empresa', 'empresa');
        $item_seleccionado = $request->get('empresa');
        $metodo_pago = TipoPagos::all();
        //dd($pagadas->paginate(10));
        $pagadas = $pagadas->paginate(10);
        $vista = VistaCobradores::vistas(Session::get('id'));
        $vista = $vista->lists('descripcion', 'idVistaCobradores');

        $menu_cobro = 2;
        $menu_activado = 2;
        return view('logueado/cobrar_cuentas/individual/index', compact('pendientes', 'activar_cobrar', 'empresas', 'item_seleccionado', 'metodo_pago', 'vista', 'buscar_rut', 'menu_cobro', 'menu_activado', 'pagadas'));
    }

    public function pagadas(Request $request)
    {

        $buscar_rut = $request->input('rut');
        $buscar_rut = str_replace('.', '', $buscar_rut);
        $pagadas = Cobros::ListaCobrosFiltrosPagados(Session::get('id'), $request->get('fecha'), $request->get('empresa'), $buscar_rut, $request->get('vencimiento'), $request->get('monto'));
        $ff = [];
        collect($pagadas->get())->each(function ($r) use (&$ff) {
            $path = public_path() . '/images/voucher/' . $r->idCobros . '_voucher_individual*';
            // if ($r->idCobros == 95) {
            //dd(glob(public_path().'/images/voucher/'.$r->idCobros. '_voucher_*'));
            //dd($r);
            if (count(glob($path)) > 0) {
                //$path=public_path().'/images/voucher/'.$r->idCobros. '_voucher_*';
                $temporal = explode('public', glob($path)[0]);

                $ff[$r->idCobros] = 'public' . $temporal[1];
            }
            if ($r->adjunto) {
                $path = public_path() . '/images/voucher/' . $r->adjunto . '_voucher_nomina*';
                if (count(glob($path)) > 0) {
                    //$path=public_path().'/images/voucher/'.$r->idCobros. '_voucher_*';
                    $temporal = explode('public', glob($path)[0]);

                    $ff[$r->idCobros] = 'public' . $temporal[1];
                }
            }
        });
        //dd($ff);
        $pagadas = $pagadas->paginate(10);
        $empresas = Cobros::ListaEmpresaPagadas(Session::get('id'));
        $empresas = $empresas->lists('empresa', 'empresa');
        $item_seleccionado = $request->get('empresa');
        //dd($pagadas);
        $menu_cobro = 5;
        $menu_activado = 2;
        return view('logueado/cobrar_cuentas/pagadas/index', compact('pagadas', 'activar_cobrar', 'empresas', 'item_seleccionado', 'buscar_rut', 'menu_cobro', 'menu_activado', 'ff'));
    }

    public function puntualespost(Request $request)
    {
        $empresa = $request->input('empresa');
        $rut = Extras\Utilidades::modificar_rut($request->input('rut_empresa'));
        $fecha_vencimiento = $request->input('fecha_vencimiento');
        $datos_deudor = Usuarios::where("rut", $rut)->first();
        $tabla_cobros = new Cobros();
        $tabla_cobros->empresa = $empresa;

        if (Session::get('idvista_cobrador') != 0) {
            $tabla_cobros->idUsuarios = Session::get('rut_padre');
        } else {
            $tabla_cobros->idUsuarios = Session::get('id');
        }
        $tabla_cobros->rut_empresa = $rut;
        $tabla_cobros->email = $request->input('email');
        if ($datos_deudor) {
            $tabla_cobros->email = $datos_deudor->email;
        }
        $tabla_cobros->monto = str_replace('.', '', $request->input('monto'));
        $tabla_cobros->fecha_vencimiento = Extras\Utilidades::formatoFechaDB($fecha_vencimiento);
        $tabla_cobros->descripcion = $request->input('descripcion');


        if (Session::get('idvista_cobrador') != 0) {
            $tabla_cobros->idUsuarios_hijo = Session::get('id');
        }

        if((int) $tabla_cobros->monto <= 0){
            return Redirect::back()->withErrors(['El monto debe ser mayor a 0.']);
        }else {
            $date = Carbon::now();

            if($date > $tabla_cobros->fecha_vencimiento){
                return Redirect::back()->withErrors(['La Fecha de vencimiento debe ser mayor a la fecha de hoy.']);
            }else{
                $tabla_cobros->save();

                if (is_numeric($tabla_cobros->idCobros)) {

                    $codigo_banco = Extras\Utilidades::generar_id_unico("co", $tabla_cobros->idCobros);
                    Cobros::update_idunico_pago($tabla_cobros->idCobros, $codigo_banco);
                    if ($request->hasFile('voucher')) {
                        $file = $request->file('voucher');
                        $nombre_archivo = $tabla_cobros->idCobros . "_voucher_individual." . $file->getClientOriginalExtension();
                        $file->move(
                            base_path() . '/public/images/voucher/', $nombre_archivo
                        );
                        $archivo = '/public/images/voucher/' . $nombre_archivo;
                    }
                    $archivo = !empty($archivo) ? $archivo : null;
                    Extras\SendEmail::aviso_nuevo_cobro($request->input('email'), Session::get('nombre'), Session::get('id'), $fecha_vencimiento, $empresa, $archivo, $tabla_cobros->idCobros, $datos_deudor, $rut);
                }

                Session::flash('ok','El cobro ha sido realizado exitosamente.');
                return Redirect::back();
            }
        }
    }

    public function editar_puntuales(EditarIndividual $request)
    {
        $idcobro = $request->get('id_cobro');
        $empresa = $request->get('empresa');
        $rut_empresa = $request->get('rut_empresa');
        $email = $request->get('email');
        $monto = Extras\Utilidades::insert_moneda($request->get('monto'));
        $fecha_vencimiento = Extras\Utilidades::formatoFechaDB($request->get('fecha_vencimiento'));
        $descripcion = $request->get('descripcion');
        $datos_deudor = Usuarios::where("rut", $rut_empresa)->first();

        if((int) $request->get('monto') <= 0){
            return Redirect::back()->withErrors(['El monto debe ser mayor a 0.']);
        }else {
            $date = Carbon::now();

            if($date > $fecha_vencimiento){
                return Redirect::back()->withErrors(['La Fecha de vencimiento debe ser mayor a la fecha de hoy.']);
            }else{

                $id_usuario = (Session::get('idvista_cobrador') == 0) ? Session::get('id') : Session::get('rut_padre');

                $rs = Cobros::editarCobrosPuntuales($idcobro, $id_usuario, $empresa, $rut_empresa, $descripcion, $fecha_vencimiento, $email, $monto);

                Extras\SendEmail::aviso_cobro_editado($request->input('email'), Session::get('nombre'), Session::get('id'), $fecha_vencimiento, $monto, $rut_empresa, $empresa);

                Session::flash('ok', 'Cobro editado correctamente');

                $rut_traspaso = $request->input('rut_traspaso');
                $email_traspaso = $request->input('email_traspaso');

                if ($rut_traspaso != $rut_empresa) {
                    if ($rut_traspaso != Session::get('rut')) {
                        if ($rut_traspaso != null && $email_traspaso != null) {
                            $rs1 = Cobros::editar_traspaso_detalle($idcobro, $rut_traspaso, $email_traspaso);
                            if ($rs1) {
                                Session::flash('ok', 'Cobro editado correctamente.');
                            }
                        } else {
                            //return Redirect::back()->withErrors(['Error' => 'Falta ingresar datos en el traspaso']);
                        }
                    } else {
                        return Redirect::back()->withErrors(['Error' => 'No puedes agregar el traspaso a ti mismo']);
                    }
                } else {
                    return Redirect::back()->withErrors(['Error' => 'El rut ya se encuentra registrado']);
                }


                return Redirect::back();
            }
        }
    }

    public function editar_detalle_nomina(EditarDetalleNomina $request)
    {
        $id_nomina = $request->get('id_nomina');
        $id_nominadetalle = $request->get('id_nomina_detalle');
        $nombre = $request->get('nombre');
        $rut = $request->get('rut');
        $email = $request->get('email');
        $monto = Extras\Utilidades::insert_moneda($request->get('monto'));
        $fecha_vencimiento = Extras\Utilidades::formatoFechaDB($request->get('fecha_vencimiento'));
        $descripcion = $request->get('descripcion');
        $id_usuario = (Session::get('idvista_cobrador') == 0) ? Session::get('id') : Session::get('rut_padre');
        $rs = NominasDetalles::editar_detalle_nomina($id_nomina, $id_usuario, $nombre, $rut, $descripcion, $fecha_vencimiento, $email, $monto);

        $rut_traspaso = $request->get('rut_traspaso');
        $email_traspaso = $request->get('email_traspaso');

        if ($rs) {
            Session::flash('ok', 'Nomina editado correctamente.');
        }
        if ($rut_traspaso != $rut) {
            if ($rut_traspaso != Session::get('rut')) {
                if (strlen($rut_traspaso) > 0 && strlen($email_traspaso) > 0) {
                    $rs1 = NominasDetalles::editar_traspaso_detalle($id_nomina, $rut_traspaso, $email_traspaso);
                    if ($rs1) {
                        Session::flash('ok', 'Nomina editado correctamente.');
                    }
                } else {
                    //return Redirect::back()->withErrors(['Error' => 'Falta ingresar datos en el traspaso']);
                }
            } else {
                return Redirect::back()->withErrors(['Error' => 'No puedes agregar el traspaso a ti mismo.']);
            }
        } else {
            return Redirect::back()->withErrors(['Error' => 'El rut ya se encuentra registrado.']);
        }
        return Redirect::back();
    }

    public function buscar(Request $request)
    {
        $id = $request->get('id');
        if (is_numeric($id)) {
            if (Session::get('idvista_cobrador') == 0) {
                echo Cobros::buscar_cobro($id, Session::get('id'));
            } else {
                echo Cobros::buscar_cobro($id, Session::get('rut_padre'));
            }
        }
    }

    public function buscar_nomina(Request $request)
    {
        $id = $request->get('id');
        if (is_numeric($id)) {
            if (Session::get('idvista_cobrador') == 0) {
                echo NominasDetalles::buscar_nomina($id, Session::get('id'));
            } else {
                echo NominasDetalles::buscar_nomina($id, Session::get('rut_padre'));
            }
        }
    }

    public function puntalesdetalle($id, Request $request)
    {
        $activar_cobrar = 1;
        if (Session::get('idvista_cobrador') == 0) {
            $detalles = Cobros::detallepuntuales($id, Session::get('id'), $request->get('monto'));
        } else {
            $detalles = Cobros::detallepuntuales($id, Session::get('rut_padre'), $request->get('monto'));
        }
        $detalles = $detalles->paginate(10);
        $menu_activado = 2;
        return view('logueado/cobrar_cuentas/individual/detalle', compact('detalles', 'activar_cobrar', 'id', 'menu_activado'));
    }

    public function nominas(CobrosNominaRequest $request)
    {
        $empresa = $request->input('empresa');
        $file = $request->file('excel');
        //$fecha_vencimiento_m = $request->input('fecha_vencimiento');
        if (!$file->isReadable()) throw new Exception("No se puede leer el archivo");
        $inputFileName = $file->getRealPath();
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            echo $e->getTraceAsString();
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

            if (!Extras\Utilidades::ValidarRut($rut)) {
                $errores = true;
                $mensajes[] = "Rut no válido";
            }

            if (!Extras\Utilidades::ValidarEmail($email)) {
                $errores = true;
                $mensajes[] = "Email no válido";
            }

            if (!Extras\Utilidades::EsNumero($monto)) {
                $errores = true;
                $mensajes[] = "Monto no válido";
            }

            if (!Extras\Utilidades::StringValido($nombre)) {
                $errores = true;
                $mensajes[] = "Nombre no válido";
            }

            if (!Extras\Utilidades::ValidarFecha($fecha_vencimiento)) {
                $errores = true;
                $mensajes[] = "Fecha no válida, día-mes-año";
            }

            if ($rut == Session::get('rut')) {
                $errores = true;
                $mensajes[] = "No puedes agregarte el cobro a ti mismo";
            }

            if((int) $monto <= 0){
                $errores = true;
                $mensajes[] = "Los montos debe ser mayor a 0.";
            }

            $date = Carbon::now();

            if($date > $fecha_vencimiento){
                $errores = true;
                $mensajes[] = "Las Fechas de vencimiento deben ser mayor a la fecha de hoy.";
            }

            if ($errores) {
                $msg = Extras\Utilidades::errorMensajeLoop($row, $mensajes);
                Session::flash('error_excel', $msg);
                return Redirect::back();
                break;
            }
        }

        $array_data_ok = array();
        $ultimo_id_registro_excel = 0;
        $file = null;
        if ($request->hasFile('voucher')) {
            $file = $request->file('voucher');
        }
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':F' . $row, NULL, TRUE, FALSE);
            $rut = $rowData[0][0];
            $email = $rowData[0][1];
            $monto = $rowData[0][2];
            $fecha_vencimiento = $rowData[0][3];
            $fecha_vencimiento = \PHPExcel_Style_NumberFormat::toFormattedString($fecha_vencimiento, 'DD/MM/YYYY');
            $nombre = $rowData[0][4];
            $descripcion = $rowData[0][5];

            if ($row == 2) {
                $tabla_nominas = new Nominas();
                $tabla_nominas->empresa = $empresa;

                if (Session::get('idvista_cobrador') != 0) {
                    $tabla_nominas->idUsuarios = Session::get('rut_padre');
                } else {
                    $tabla_nominas->idUsuarios = Session::get('id');
                }
                $tabla_nominas->descripcion = $request->input('descripcion');
                //$tabla_nominas->fecha_vencimiento = Extras\Utilidades::formatoFechaDB($fecha_vencimiento_m);

                if (Session::get('idvista_cobrador') != 0) {
                    $tabla_nominas->idUsuarios_hijo = Session::get('id');
                }
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
                if (!empty($file)) {
                    $nombre_archivo = $tabla_nominas->idnominas . "_voucher_nomina." . $file->getClientOriginalExtension();
                    $archivo = base_path() . '/public/images/voucher/' . $nombre_archivo;
                    File::copy($file, $archivo);
                    Extras\SendEmail::aviso_nuevo_cobro($email, Session::get('nombre'), Session::get('id'), $fecha_vencimiento, $empresa, $archivo, null, $rut);
                } else {
                    Extras\SendEmail::aviso_nuevo_cobro($email, Session::get('nombre'), Session::get('id'), $fecha_vencimiento, $empresa, null, null, $rut);
                }
                $array_data_ok[] = $DetalleNomina->idnominasdetalle;
                $codigo_banco = Extras\Utilidades::generar_id_unico("no", $DetalleNomina->idnominasdetalle);
                NominasDetalles::update_idunico_pago($DetalleNomina->idnominasdetalle, $codigo_banco);


            } else if ($ultimo_id_registro_excel > 0) {
                $DetalleNomina = new NominasDetalles();
                $DetalleNomina->idnominas = $ultimo_id_registro_excel;
                $DetalleNomina->email = $email;
                $DetalleNomina->monto = $monto;
                $DetalleNomina->nombre = $nombre;
                $DetalleNomina->fecha_vencimiento = Extras\Utilidades::formatoFechaDB($fecha_vencimiento);
                $DetalleNomina->descripcion = $descripcion;
                $DetalleNomina->rut = $rut;
                $DetalleNomina->save();
                if (!empty($file)) {
                    $nombre_archivo = $ultimo_id_registro_excel . "_voucher_nomina." . $file->getClientOriginalExtension();
                    $archivo = base_path() . '/public/images/voucher/' . $nombre_archivo;
                    File::copy($file, $archivo);
                    Extras\SendEmail::aviso_nuevo_cobro($email, Session::get('nombre'), Session::get('id'), $fecha_vencimiento, $empresa, $archivo, null, null, $rut);
                } else {
                    Extras\SendEmail::aviso_nuevo_cobro($email, Session::get('nombre'), Session::get('id'), $fecha_vencimiento, $empresa, null, null, null, $rut);
                }
                Extras\SendEmail::aviso_nuevo_cobro($email, Session::get('nombre'), Session::get('id'), $fecha_vencimiento, $empresa, null, null, null, $rut);
                $array_data_ok[] = $DetalleNomina->idnominasdetalle;

                $codigo_banco = Extras\Utilidades::generar_id_unico("no", $DetalleNomina->idnominasdetalle);
                NominasDetalles::update_idunico_pago($DetalleNomina->idnominasdetalle, $codigo_banco);
            }
        }

        Session::flash('ok','Los cobros han sido registrados exitosamente.');

        return Redirect::back();
    }

    public function eliminarnomina(Request $request)
    {
        $id = $request->get('idnomina');
        if (is_numeric($id)) {
            $id_usuario = (Session::get('idvista_cobrador') == 0) ? Session::get('id') : Session::get('rut_padre');
            /*Nominas::where('idnominas', $id)
                    ->where('idUsuarios',$id_usuario)
                    ->update(['eliminado' => 1]);*/
                    Nominas::eliminar_nomina_hijos($id, $id_usuario);
                    Session::flash('ok', 'Se ha eliminado la nómina correctamente');
                }
                return Redirect::back();
            }

            public function eliminar_nomina_detalle(Request $request)
            {
                $idDetalle = $request->get('idnomina');
                $id = $request->get('id_params');
                if (is_numeric($idDetalle) && is_numeric($id)) {
                    $obj = NominasDetalles::where('idnominasdetalle', $idDetalle)->first();
                    $padre = Nominas::where('idnominas', $obj->idnominas)->first();
                    $id_usuario = (Session::get('idvista_cobrador') == 0) ? Session::get('id') : Session::get('rut_padre');
                    if ($padre != null && $padre->idUsuarios == $id_usuario) {
                        NominasDetalles::where('idnominasdetalle', $idDetalle)
                        ->update(['eliminado' => 1]);

                        $contar = NominasDetalles::where('idnominas', $obj->idnominas)->where('eliminado', 0)->count();
                        if ($contar <= 0) {
                            Nominas::where('idnominas', $obj->idnominas)->where('idUsuarios', $id_usuario)
                            ->update(['eliminado' => 1]);

                            Session::flash('ok', 'Se ha eliminado la nómina correctamente');
                            return Redirect::back();
                        }
                        Session::flash('ok', 'Se ha eliminado el detalle correctamente');
                    }
                }
                return Redirect::back();
            }

            public function eliminarcobro(Request $request)
            {
                $id = $request->get('idcobro');
                if (is_numeric($id)) {
                    $id_usuario = (Session::get('idvista_cobrador') == 0) ? Session::get('id') : Session::get('rut_padre');
                    Cobros::where('idCobros', $id)
                    ->where('idUsuarios', $id_usuario)
                    ->update(['eliminado' => 1]);
                    Session::flash('ok', 'Se ha eliminado el cobro correctamente');
                }
                return Redirect::back();
            }

            public function eliminar_cobro_detalle(Request $request)
            {
                $idDetalle = $request->get('idcobro');
                $id = $request->get('id_params');
                if (is_numeric($idDetalle) && is_numeric($id)) {
                    $obj = CobrosDetalles::where('idCobrosDetalle', $idDetalle)->first();
                    $padre = Cobros::where('idCobros', $obj->idCobros)->first();
                    $id_usuario = (Session::get('idvista_cobrador') == 0) ? Session::get('id') : Session::get('rut_padre');
                    if ($padre != null && $padre->idUsuarios == $id_usuario) {
                        CobrosDetalles::where('idCobrosDetalle', $idDetalle)
                        ->update(['eliminado' => 1]);

                        $contar = CobrosDetalles::where('idCobros', $obj->idCobros)->where('eliminado', 0)->count();
                        if ($contar <= 0) {
                            Cobros::where('idCobros', $obj->idCobros)->where('idUsuarios', $id_usuario)
                            ->update(['eliminado' => 1]);

                            Session::flash('ok', 'Se ha eliminado el cobro correctamente');
                            return redirect('/cuentas-cobrar-log/puntales');
                        }
                        Session::flash('ok', 'Se ha eliminado el detalle correctamente');
                    }
                }
                return Redirect::back();
            }


            public function pagarcuenta_puntuales(\App\Http\Requests\PagarCuentas $request)
            {
                $fecha_pago = $request->input('fecha_pago_pop');
                $fecha_pago = Extras\Utilidades::formatoFechaDB($fecha_pago);
                $monto = $request->input('monto_pop');
                $id_pago = $request->input('id_pago_pop');
                $nr_transaccion = $request->input('nro_transaccion_pop');
                $idtipopago = $request->input('metodo_pago');
                $id_usuario = (Session::get('idvista_cobrador') == 0) ? Session::get('id') : Session::get('rut_padre');
                $rs = Cobros::pagarcuenta($id_pago, $id_usuario, $monto, $fecha_pago, $nr_transaccion, $idtipopago);
                if ($rs) {
                    Session::flash('ok', 'Cuenta pagada correctamente');
                    return Redirect::back();
                } else {
                    Session::flash('error', 'Hubo un error al pagar la cuenta, intente nuevamente');
                    return Redirect::back();
                }
            }


            public function pagarcuenta_nominas(\App\Http\Requests\PagarCuentas $request)
            {
                $fecha_pago = $request->input('fecha_pago_pop');
                $fecha_pago = Extras\Utilidades::formatoFechaDB($fecha_pago);
                $monto = $request->input('monto_pop');
                $id_pago = $request->input('id_pago_pop');
                $nr_transaccion = $request->input('nro_transaccion_pop');
                $idtipopago = $request->input('metodo_pago');

                $rs = NominasDetalles::pagarcuenta($id_pago, $monto, $fecha_pago, $nr_transaccion, $idtipopago);
                if ($rs) {
                    Session::flash('ok', 'Cuenta pagada correctamente');
                    return Redirect::back();
                } else {
                    Session::flash('error', 'Hubo un error al pagar la cuenta, intente nuevamente');
                    return Redirect::back();
                }
            }

            public function pagadas_detalle($id, Request $request)
            {
                if (is_numeric($id)) {

                    $id_usuario = (Session::get('idvista_cobrador') == 0) ? Session::get('id') : Session::get('rut_padre');
                    $nombre = Nominas::where('idUsuarios', $id_usuario)
                    ->where('idnominas', $id)
                    ->select('empresa')->first();

                    if (!is_null($nombre)) {
                        $nombre = $nombre->empresa;
                        $detalles = Cobros::detallenominas_pagadas($id, $request->get('monto'));
                        $detalles = $detalles->paginate(10);
                        $menu_activado = 2;
                        return view('logueado/cobrar_cuentas/pagadas/detalle', compact('detalles', 'nombre', 'id', 'menu_activado'));
                    } else {
                        Redirect::back();
                    }
                } else {
                    return Redirect::back();
                }
            }

            public function adjuntar_doc_individual(AdjuntarDocumentoPortal $request)
            {
                $file = $request->file('doc');
                $id = $request->input('id_adjuntar');
                $extension = $file->getClientOriginalExtension();
                $fileName = Session::get('id') . '-' . uniqid(rand(), true) . '.' . $extension;
                if ($file->move("upload/individual", $fileName)) {
                    $rs = Cobros::adjuntar_doc(Session::get('id'), $id, $fileName);
                    if ($rs) {
                        $rs = Cobros::buscar_cobro($id, Session::get('id'));
                        Extras\SendEmail::nuevo_archivo_adjunto($rs->email, Session::get('nombre'), Session::get('id'));
                        Session::flash('ok', 'Documento adjuntado correctamente');
                        return Redirect::back();
                    }
                }
                return Redirect::back();
            }

            public function adjuntar_doc_nomina(AdjuntarDocumentoPortal $request)
            {
                $file = $request->file('doc');
                $id = $request->input('id_adjuntar');
                $extension = $file->getClientOriginalExtension();
                $fileName = Session::get('id') . '-' . uniqid(rand(), true) . '.' . $extension;
                if ($file->move("upload/individual", $fileName)) {
                    $rs = NominasDetalles::adjuntar_doc_nomina(Session::get('id'), $id, $fileName);
                    if ($rs) {
                        $rs = NominasDetalles::buscar_nomina($id, Session::get('id'));
                        Extras\SendEmail::nuevo_archivo_adjunto($rs->email, Session::get('nombre'), Session::get('id'));
                        Session::flash('ok', 'Documento adjuntado correctamente');
                        return Redirect::back();
                    }
                }
                return Redirect::back();
            }

            public function adjuntar_doc_nomina_masiva(AdjuntarDocumentoPortal $request)
            {
                $file = $request->file('doc');
        //$id = $request->input('id_adjuntar');
                $extension = $file->getClientOriginalExtension();
                $data = json_decode($request->input('id_adjuntar_nominas'));
                $total = 0;
                $fileName = Session::get('id') . '-' . uniqid(rand(), true) . '.' . $extension;
                if ($file->move("upload/individual", $fileName)) {
                    foreach ($data as $fila) {
                        $rs = NominasDetalles::adjuntar_doc_nomina(Session::get('id'), $fila, $fileName);
                        if ($rs) {
                            $total = $total + 1;
                    //$rs = NominasDetalles::buscar_nomina($id,Session::get('id'));
                    //Extras\SendEmail::nuevo_archivo_adjunto($rs->email,Session::get('nombre'),Session::get('id'));

                        }
                    }
                }
                Session::flash('ok', $total . ' Documento(s) adjuntado(s) correctamente');
                return Redirect::back();
            }

            public function todo(Request $request)
            {
                $item_seleccionado = $request->get('empresa');

                $empresa = $request->input('empresa');
                $rut = $request->input('rut');
                $rut = str_replace('.', '', $rut);

                $tabla = Cobros::ListarMisCobrosPendiente(Session::get('id'), $empresa, $rut, $request->get('fecha'), $request->get('monto'));
                $tabla = $tabla->paginate(10);
                $lista_empresas = Cobros::ComboboxMisCobrosPendiente(Session::get('id'));

                $metodo_pago = TipoPagos::listar_pagos();
                $id = 0;
                $menu_cobro = 3;
                $menu_activado = 2;
                return view('logueado/cobrar_cuentas/todo/index', compact('tabla', 'item_seleccionado', 'lista_empresas', 'metodo_pago', 'id', 'menu_cobro', 'menu_activado'));
            }

            public function exportar_todo()
            {
                $nombre_archivo = "Gestion_Pagos_" . Session::get('mi_nombre') . " " . Session::get('mi_apellido') . "_" . Extras\Utilidades::ImprimirFecha(date("Y-m-d"));
                Excel::create($nombre_archivo, function ($excel) {
                    $excel->sheet('Todo', function ($sheet) {
                        $data = Cobros::exportar_todo(Session::get('id'));
                        $sheet->fromArray($data);
                        $sheet->setAutoFilter();
                    });
                })->export('xls');
            }

            public function ajaxEmailByRut(Request $request)
            {
                $this->validate($request, [
                    'rut' => 'required'
                ]);

                try {
                    $rut = str_replace('.', '', $request->get('rut'));
                    $usuario = Usuarios::where('rut', $rut)->first();
                    if ($usuario == null) throw new \Exception("No se encontró rut");
                    $email = $usuario->email;
                } catch (\Exception $exception) {
                    return response()->json(['success' => false, 'message' => $exception->getMessage()]);
                }

                return response()->json(['success' => true, 'data' => $email]);
            }
        }
