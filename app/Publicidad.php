<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
    protected $table = 'publicidad';
    protected $primaryKey = 'idpublicidad';

    public static function buscar($id){
        return Publicidad::where('idpublicidad',$id)
                        ->selectRaw('titulo,descripcion,DATE(fecha_inicio) as fecha_inicio,DATE(fecha_termino) as fecha_termino,link')
                        ->first();
    }

    public static function eliminar($id){
        $rs = Publicidad::where('idpublicidad',$id)
                    ->update(array(
                        'eliminado' => 1
                    ));
        return $rs;
    }

    public static function editar($id,$titulo,$descripcion,$fecha_inicio,$fecha_termino,$link){
        $rs = Publicidad::where('idpublicidad',$id)
                        ->update(array(
                            'titulo' => $titulo,
                            'descripcion' => $descripcion,
                            'fecha_inicio' => $fecha_inicio,
                            'fecha_termino' => $fecha_termino,
                            'link' => $link
                        ));
        return $rs;
    }

    public static function editar_imagen($id,$path){
        $rs = Publicidad::where('idpublicidad',$id)
                            ->update(array(
                               'path_imagen' => $path
                            ));
        return $rs;
    }

    public static function agregar($titulo,$path,$descripcion,$fecha_inicio,$fecha_fin,$link){
        $tabla = new Publicidad();
        $tabla->titulo = $titulo;
        $tabla->path_imagen = $path;
        $tabla->descripcion = $descripcion;
        $tabla->fecha_inicio = $fecha_inicio;
        $tabla->fecha_termino = $fecha_fin;
        $tabla->link = $link;
        $tabla->save();
        return $tabla->idpublicidad;
    }

    public static function listar(){
        return Publicidad::orderby('idpublicidad','desc')
                        ->where('eliminado',0);
    }

    public static function listPortal($fecha_actual){
        $data = Publicidad::where('eliminado',0)
            ->where('fecha_inicio', '<=', $fecha_actual)
            ->where('fecha_termino', '>=', $fecha_actual)
            ->get()->toArray();
        //$data = $data[0];
        return $data;
    }

}
?>