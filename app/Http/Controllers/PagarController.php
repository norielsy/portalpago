<?php

namespace App\Http\Controllers;

use App\Cobros;
use App\DatosPagos;
use App\Extras;
use App\NominasDetalles;
use App\PagarCuentas;
use App\TipoPagos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PagarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $activar_pagar = 1;
        $buscar_rut = $request->input('rut');
        $buscar_rut = str_replace('.', '', $buscar_rut);
        $total = Cobros::total_deudas_no_pagadas_id(Session::get('rut'), date('Y-m-d'));
        $nopagadas = Cobros::MisNoPagadas(Session::get('rut'), $request->get('fecha'), $request->get('monto'), $request->get('empresa'), $buscar_rut);

        $nopagadas = $nopagadas->paginate(10);
        $ff = [];

        $nopagadas->each(function ($r) use (&$ff) {
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
            // }
            //return $r;
        });
        //dd($ff);
        //print_r($ff);
        $empresas = Cobros::MisNoPagadas_lista(Session::get('rut'));
        $empresas = $empresas->lists('empresa', 'empresa');

        $item_seleccionado = $request->get('empresa');
        $metodo_pago = TipoPagos::all();

        $menu_activado = 1;
        //dd($ff);
        return view('logueado/cuentas_por_pagar/cuentas_por_pagar', compact('activar_pagar', 'nopagadas', 'total', 'empresas', 'item_seleccionado', 'metodo_pago', 'buscar_rut', 'menu_activado', 'ff'));
    }

    public function pagadas(Request $request)
    {
        $buscar_rut = $request->input('rut');
        $buscar_rut = str_replace('.', '', $buscar_rut);
        $activar_pagar = 1;
        $pagadas = Cobros::MisPagadas(Session::get('rut'), $request->get('fecha'), $request->get('monto'), $request->get('empresa'), $buscar_rut);
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
        $pagadas = $pagadas->paginate(10);
        $empresas = Cobros::MisPagadas_lista(Session::get('rut'));
        $empresas = $empresas->lists('empresa', 'empresa');

        $item_seleccionado = $request->get('empresa');
        $menu_activado = 1;
        return view('logueado/cuentas_por_pagar/cuentas_por_pagar_pagadas', compact('activar_pagar', 'pagadas', 'empresas', 'item_seleccionado', 'buscar_rut', 'menu_activado', 'ff'));
    }

    public function buscar_cuenta(Request $request)
    {
        $id = $request->get('id');
        $tipo = $request->input('tipo');
        if (is_numeric($id)) {
            if ($tipo == 2) { //nominas
                $rs = NominasDetalles::buscar_detalle_no_pagado($id);
                $rs["tipo"] = "detallenomina";
                $rs["banco"] = DatosPagos::buscar_pago($rs->idUsuarios);
            } else if ($tipo == 1) { //cobros
                $rs = Cobros::buscar_detalle_no_pagado($id);
                $rs["tipo"] = "cobros";
                $rs["banco"] = DatosPagos::buscar_pago($rs->idUsuarios);
            }
            echo $rs;
        }
    }

    public function pagarcuenta(\App\Http\Requests\PagarCuentas $request)
    {
        $fecha_pago = $request->input('fecha_pago_pop');
        $fecha_pago = Extras\Utilidades::formatoFechaDB($fecha_pago);
        $monto = $request->input('monto_pop');
        $id_pago = $request->input('id_pago_pop');
        $nr_transaccion = $request->input('nro_transaccion_pop');
        $idtipopago = $request->input('metodo_pago');
        $id_tipo_from_pago = $request->input('tipo_pago');

        if ($id_tipo_from_pago == "detallenomina") {
            $rs = NominasDetalles::pagar_cuenta_no_pagada($id_pago, Session::get('rut'), $monto, $fecha_pago, $nr_transaccion, $idtipopago);
        } else if ($id_tipo_from_pago == "cobros") {
            $rs = Cobros::pagar_cuenta_no_pagada($id_pago, Session::get('rut'), $monto, $fecha_pago, $nr_transaccion, $idtipopago);
        }
        //$rs = PagarCuentas::pagarcuenta($id_pago,Session::get('id'),$monto,$fecha_pago,$nr_transaccion,$idtipopago);
        if ($rs) {
            Session::flash('ok', 'Cuenta pagada correctamente');
            return Redirect::back();
        } else {
            Session::flash('error', 'Hubo un error al pagar la cuenta, intente nuevamente');
            return Redirect::back();
        }
    }

    public function inicio(Request $request)
    {
        $nopagadas = Cobros::where([
            'rut_empresa' => Session::get('rut'),
            'pagado' => 0,
            'eliminado' => 0
        ])
        ->orderBy('fecha_vencimiento')
        ->get()
        ->take(10);

        $pagadas = Cobros::where([
            'rut_empresa' => Session::get('rut'),
            'pagado' => 1,
            'eliminado' => 0
        ])
        ->orderBy('fecha_vencimiento')
        ->get()
        ->take(10);

        return view('logueado.cuentas_por_pagar.index', [
            'pagadas' => $pagadas,
            'nopagadas' => $nopagadas,
            'menu_activado' => 1
        ]);
    }
}

?>
