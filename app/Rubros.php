<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Rubros extends Model
{
    protected $table = 'rubros';
    protected $primaryKey = 'idrubros';


    public static function tabla(){
        $rubros = Rubros::where('eliminado','0');
        return $rubros;
    }

    public static function buscar($id){
        return Rubros::where('idrubros',$id)->first();
    }

    public static function eliminar($id){
        return Rubros::where('idrubros',$id)
                    ->update(array(
                        'eliminado' => 1
                    ));
    }

    public static function insert($nombre){
        $tabla = new Rubros();
        $tabla->nombre = $nombre;
        $tabla->save();
        return $tabla->idrubros;
    }

    public static function editar($id,$nombre){
        return Rubros::where('idrubros',$id)
                    ->update(array(
                        'nombre' => $nombre
                    ));
    }
}
?>