<?php
namespace App\Extras;
use App\AnuncioPortal;
use App\ImagenPortal;
use App\Publicidad;

class Portal
{
    static function getPublicidad($id)
    {
        $rs = Publicidad::buscar($id);
        return "public/images/p/".$rs->path_imagen;
    }

    static function listPublicidad(){
        $fecha_actual = date('Y-m-d H:i:s');
        $data = Publicidad::listPortal($fecha_actual);
        return $data;
    }

    static function getImagenPortal($id){
        $rs = ImagenPortal::buscar($id);
        $data['titulo'] = $rs['titulo'];
        $data['imagen'] = $rs['path_imagen'];
        $data['link'] = $rs['link'];
        return $data;
    }

    public static function mostrarAnuncio(){
        $fecha_actual = date('Y-m-d H:i:s');
        $data = AnuncioPortal::mostrarAnuncio($fecha_actual);
        return $data;
    }
}
?>