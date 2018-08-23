<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class HistorialEmail extends Model
{
    protected $table = 'historial_envio_email';
    protected $primaryKey = 'idhistorial_envio_email';


    public static function listar($id_usuario){
        $data = HistorialEmail::join('usuarios','usuarios.idUsuarios','=','historial_envio_email.idUsuarios')
                    ->where('historial_envio_email.idUsuarios',$id_usuario);
        return $data;
    }

    public static function agregar($titulo,$mensaje,$idUsuarios,$para,$tipo_email){
        $tabla = new HistorialEmail();
        $tabla->mensaje = $titulo;
        $tabla->texto = $mensaje;
        $tabla->idUsuarios = $idUsuarios;
        $tabla->para = $para;
        $tabla->tipo_email = $tipo_email;
        $tabla->save();
        return $tabla->idTipoPago;
    }

    public static function agregar_de($titulo,$mensaje,$idUsuarios,$para,$tipo_email,$de){
        $tabla = new HistorialEmail();
        $tabla->mensaje = $titulo;
        $tabla->texto = $mensaje;
        $tabla->idUsuarios = $idUsuarios;
        $tabla->para = $para;
        $tabla->tipo_email = $tipo_email;
        $tabla->de = $de;
        $tabla->save();
        return $tabla->idTipoPago;
    }

}
?>