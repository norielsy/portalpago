<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class NominasDetalles extends Model
{
    protected $table = 'nominasdetalle';
    protected $primaryKey = 'idnominasdetalle';
    protected $fillable = ['idnominas','nombre','rut','email','monto','descripcion'];
    protected $hidden = ['nominasdetalle.created_at', 'nominasdetalle.updated_at','eliminado'];

    public static function buscar_nomina($idnomina,$idUsuario){
        return NominasDetalles::join('nominas','nominas.idnominas','=','nominasdetalle.idnominas')
            ->where('idnominasdetalle',$idnomina)
            ->where('idUsuarios',$idUsuario)
            ->select("*","nominasdetalle.fecha_vencimiento","nominasdetalle.descripcion")
            ->first();
    }
    public static  function editar_detalle_nomina($id_detalle_nomina,$idUsuarios,$nombre,$rut,$descripcion,$fecha_vencimiento,$email,$monto){
        $rs = NominasDetalles::where('idnominasdetalle',$id_detalle_nomina)
            ->update(array(
                'nombre' => $nombre,
                'rut' => $rut,
                'nominasdetalle.descripcion' => $descripcion,
                'nominasdetalle.fecha_vencimiento' => $fecha_vencimiento,
                'email' => $email,
                'monto' => $monto
            ));
    }
    public static function pagarcuenta($idCuenta,$monto,$fecha_pago,$nro_transaccion,$idtipopago){
        $rs = NominasDetalles::where('idnominasdetalle',$idCuenta)
            ->update(array(
                'monto_pago' => $monto,
                'fecha_pago' => $fecha_pago,
                'pagado' => 1,
                'nro_transaccion' => $nro_transaccion,
                'idTipoPago' => $idtipopago
            ));
        $nomina = NominasDetalles::where('idnominasdetalle',$idCuenta)->first();
        $total_pagadas = NominasDetalles::where('idnominas',$nomina->idnominas)
                                            ->where('pagado',1)
                                            ->count();
        $total_detalle = NominasDetalles::where('idnominas',$nomina->idnominas)->count();

        if($total_detalle == $total_pagadas){
            Nominas::where('idnominas',$nomina->idnominas)
                            ->update(array(
                               'todo_pagado' => 1
                            ));
        }
        return $rs;
    }
    public static function editar_no_registrado($rut,$email,$empresa){
        return NominasDetalles::where('rut',$rut)
                ->update(array(
                    'email' => $email,
                    'nombre' => $empresa
                ));
    }

    public static function buscar_detalle_no_pagado($id){
        return NominasDetalles::join('nominas','nominas.idnominas','=','nominasdetalle.idnominas')
            ->join('usuarios','usuarios.idUsuarios','=','nominas.idUsuarios')
            ->where('idnominasdetalle',$id)
            ->where('nominasdetalle.eliminado',0)
            ->select('usuarios.nombre as reg_nombre','usuarios.apellido as reg_apellido','nominasdetalle.fecha_vencimiento','nominasdetalle.monto','idnominasdetalle as ID','usuarios.rut as rut_cobrador','nominasdetalle.rut','nominasdetalle.nombre','nominasdetalle.email','nominasdetalle.descripcion','usuarios.idUsuarios','usuarios.rut','idunico_pago as codigo_transaccion')
            ->first();
    }

    public static function buscar_detalle_pagado($id){
        return NominasDetalles::join('nominas','nominas.idnominas','=','nominasdetalle.idnominas')
            ->join('usuarios','usuarios.idUsuarios','=','nominas.idUsuarios')
            ->where('idnominasdetalle',$id)
            ->where('nominasdetalle.eliminado',0)
            ->select('usuarios.nombre as reg_nombre','usuarios.apellido as reg_apellido','nominasdetalle.fecha_vencimiento','nominasdetalle.monto','idnominasdetalle as ID','usuarios.rut as rut_cobrador','nominasdetalle.rut','nominasdetalle.nombre','nominasdetalle.email','nominasdetalle.descripcion','nominasdetalle.fecha_pago','nominasdetalle.nro_transaccion')
            ->first();
    }

    public static function pagar_cuenta_no_pagada($id,$rut,$monto,$fecha_pago,$nro_transaccion,$idTipoPago){
        return NominasDetalles::where('idnominasdetalle',$id)
            ->where('rut',$rut)
            ->orWhere('rut_traspaso', $rut)
            ->update(array(
                'monto' => $monto,
                'fecha_pago' => $fecha_pago,
                'nro_transaccion' => $nro_transaccion,
                'idTipoPago' => $idTipoPago,
                'pagado' => 1
            ));
    }

    public static function eliminar($id){
        return NominasDetalles::where('idnominasdetalle',$id)
            ->update(array(
               'eliminado' => 1
            ));
    }

    public static function adjuntar_doc_nomina($idUsuarios,$id,$url_path){
        $rs = NominasDetalles::where('nominasdetalle.idnominasdetalle',$id)
            ->update(array(
                'url_adjunto' => $url_path
            ));
        return $rs;
    }

    public static function editar_traspaso_detalle($id,$rut,$email){
        return NominasDetalles::where('idnominasdetalle',$id)
                            ->update(array(
                                'rut_traspaso' => $rut,
                                'email_traspaso' => $email
                            ));
    }

    public static function update_idunico_pago($id,$data){
        return NominasDetalles::where('idnominasdetalle',$id)
            ->update(array(
                'idunico_pago' => $data
            ));
    }
}
?>