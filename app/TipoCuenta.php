<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model
{
    protected $table = 'tipo_cuenta';
    protected $primaryKey = 'idTipoCuenta';


    public static function listar(){
        $data = TipoCuenta::where('eliminado',0);
        return $data;
    }

    public static function buscar($id){
        return TipoCuenta::where('idTipoCuenta',$id)->first();
    }

    public static function agregar($cuenta){
        $tabla = new TipoCuenta();
        $tabla->descripcion = $cuenta;
        $tabla->eliminado = 0;
        $tabla->editable = 1;
        $tabla->save();
        return $tabla->idTipoCuenta;
    }

    public static function eliminar($id){
        return TipoCuenta::where('idTipoCuenta',$id)
                    ->update(array(
                       'eliminado' => 1
                    ));
    }

    public static function editar($id,$pago){
        return TipoCuenta::where('idTipoCuenta',$id)
                    ->update(array(
                        'descripcion' => $pago
                    ));
    }

}
?>