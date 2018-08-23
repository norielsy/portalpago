<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ImagenPortal extends Model
{
    protected $table = 'img_portal';
    protected $primaryKey = 'idimg_portal';

    public static function buscar($id){
        return ImagenPortal::where('idimg_portal',$id)->first();
    }

    public static function listar(){
        return ImagenPortal::orderby('idimg_portal','desc')
                    ->where('eliminado',0);
    }

    public static function eliminar($id){
        $rs = ImagenPortal::where('idimg_portal',$id)
            ->update(array(
                'eliminado' => 1
            ));
        return $rs;
    }

    public static function editar($id,$titulo,$descripcion,$link){
        $rs = ImagenPortal::where('idimg_portal',$id)
            ->update(array(
                'titulo' => $titulo,
                'link' => $link,
                'descripcion' => $descripcion,
            ));
        return $rs;
    }

    public static function editar_imagen($id,$path){
        $rs = ImagenPortal::where('idimg_portal',$id)
            ->update(array(
                'path_imagen' => $path
            ));
        return $rs;
    }

    public static function agregar($titulo,$path,$descripcion){
        $tabla = new ImagenPortal();
        $tabla->titulo = $titulo;
        $tabla->path_imagen = $path;
        $tabla->descripcion = $descripcion;
        $tabla->save();
        return $tabla->idimg_portal;
    }


}
?>