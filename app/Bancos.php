<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Bancos extends Model
{
    protected $table = 'bancos';
    protected $primaryKey = 'idBancos';


    public static function tabla(){
        $rubros = Bancos::where('eliminado','0');
        return $rubros;
    }

    public static function buscar($id){
        return Bancos::where('idBancos',$id)->first();
    }

    public static function eliminar($id){
        return Bancos::where('idBancos',$id)
            ->update(array(
                'eliminado' => 1
            ));
    }

    public static function insert($nombre){
        $tabla = new Bancos();
        $tabla->nombre = $nombre;
        $tabla->save();
        return $tabla->idBancos;
    }

    public static function editar($id,$nombre){
        return Bancos::where('idBancos',$id)
            ->update(array(
                'nombre' => $nombre
            ));
    }
}
?>