<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = 'tipo_pagos';
    protected $primaryKey = 'idTipoPago';


    public static function listar(){
        $data = Pagos::where('eliminado',0);
        return $data;
    }

    public static function buscar($id){
        return Pagos::where('idTipoPago',$id)->first();
    }

    public static function agregar($forma_pago){
        $tabla = new Pagos();
        $tabla->descripcion = $forma_pago;
        $tabla->eliminado = 0;
        $tabla->editable = 1;
        $tabla->save();
        return $tabla->idTipoPago;
    }

    public static function eliminar($id){
        return Pagos::where('idTipoPago',$id)
                    ->update(array(
                       'eliminado' => 1
                    ));
    }

    public static function editar($id,$pago){
        return Pagos::where('idTipoPago',$id)
                    ->update(array(
                        'descripcion' => $pago
                    ));
    }

}
?>