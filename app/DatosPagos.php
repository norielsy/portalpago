<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class DatosPagos extends Model
{
    protected $table = 'datos_pago';
    protected $primaryKey = 'iddatos_pago';

    public static function agregar_editar_pago($id_usuario,$banco,$tipo_cuenta,$nro_cuenta){
        $rs = DatosPagos::where('idUsuarios',$id_usuario)
                            ->first();
        if($rs){
           return DatosPagos::where('idUsuarios',$id_usuario)
                        ->update(
                            array(
                                'banco' => $banco,
                                'tipo_cuenta' => $tipo_cuenta,
                                'nro_cuenta' => $nro_cuenta
                            ));
        }else{

            $tabla = new DatosPagos();
            $tabla->idUsuarios = $id_usuario;
            $tabla->banco = $banco;
            $tabla->tipo_cuenta = $tipo_cuenta;
            $tabla->nro_cuenta = $nro_cuenta;
            return $tabla->save();
        }
    }

    public static function buscar_pago($id_usuario){
        return DatosPagos::where('idUsuarios',$id_usuario)->first();
    }
}
?>