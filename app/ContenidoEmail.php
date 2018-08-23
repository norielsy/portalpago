<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ContenidoEmail extends Model
{
    protected $table = 'contenido_email_mensaje';
    protected $primaryKey = 'idcontenido_email_mensaje';

    public static function listar(){
        $data = ContenidoEmail::where('eliminado',0);
        return $data;
    }

    public static function buscar($id){
        $data = ContenidoEmail::where('idcontenido_email_mensaje',$id)
                                ->where('eliminado',0)
                                ->first();
        return $data;
    }

    public static function editar($id,$titulo,$mensaje){
        return ContenidoEmail::where('idcontenido_email_mensaje',$id)
                            ->update(array(
                                'titulo' => $titulo,
                                'texto' => $mensaje
                            ));
    }
}
?>