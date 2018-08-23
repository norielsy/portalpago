<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class AnuncioPortal extends Model
{
    protected $table = 'anuncio_portal';
    protected $primaryKey = 'idanuncio_portal';

    public static function obtenerAnuncio($id){
        return AnuncioPortal::where('idanuncio_portal',$id)->first();
    }

    public static function actualizar($id,$inicio,$termino,$mensaje){
        return AnuncioPortal::where('idanuncio_portal',$id)
                            ->update(array(
                                'fecha_inicio' => $inicio,
                                'fecha_termino' => $termino,
                                'mensaje' => $mensaje
                            ));
    }

    public static function mostrarAnuncio($fecha_actual){
        $data = AnuncioPortal::where('fecha_inicio', '<=', $fecha_actual)
                ->where('fecha_termino', '>=', $fecha_actual)
                ->get()->toArray();
        return $data;
    }
}
?>