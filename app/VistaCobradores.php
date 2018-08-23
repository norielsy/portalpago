<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class VistaCobradores extends Model
{
    protected $table = 'vistas_cobradores';
    protected $primaryKey = 'idVistaCobradores';


    public  static function verificar_usuarios($idMaestro,$idasignacion){
        return VistaCobradores::where('idUsuariosMaestro',$idMaestro)
                                ->where('idUsuarios',$idasignacion)
                                ->where('eliminado',0)
                                ->first();
    }


    public static function crear($idMaestro,$idasignacion,$idperfil,$confirmado = 0){
        $tabla = new VistaCobradores();
        $tabla->idUsuariosMaestro = $idMaestro;
        $tabla->idperfiles_cobrado = $idperfil;
        $tabla->idUsuarios = $idasignacion;
        $tabla->confirmado = $confirmado;
        $tabla->save();
        return $tabla->idVistaCobradores;
    }

    public static function tabla($idMaestro){
        return VistaCobradores::join('usuarios','usuarios.idUsuarios','=','vistas_cobradores.idUsuarios')
                                ->join('perfiles_cobrado','perfiles_cobrado.idperfiles_cobrado','=','vistas_cobradores.idperfiles_cobrado')
                                ->where('idUsuariosMaestro',$idMaestro)
                                ->where('vistas_cobradores.eliminado',0)
                                ->select('idVistaCobradores','email','rut','nombre','descripcion as perfil','vistas_cobradores.idperfiles_cobrado','confirmado');
    }

    public static function eliminar($idMaestro,$id){
        return VistaCobradores::where('idUsuariosMaestro',$idMaestro)
                                ->where('idVistaCobradores',$id)
                                ->update(array(
                                    'eliminado' => 1
                                ));
    }

    public static function editar($idMaestro,$idVista,$idperfil){
        return VistaCobradores::where('idUsuariosMaestro',$idMaestro)
                                ->where('idVistaCobradores',$idVista)
                                ->update(array(
                                    'idperfiles_cobrado' => $idperfil
                                ));
    }

    public static function confirmar($idVista){
        return VistaCobradores::where('idVistaCobradores',$idVista)
            ->update(array(
                'confirmado' => 1
            ));
    }

    public static function vistas($idUsuario){
        return VistaCobradores::join('usuarios','usuarios.idUsuarios','=','vistas_cobradores.idUsuariosMaestro')
            ->join('perfiles_cobrado','perfiles_cobrado.idperfiles_cobrado','=','vistas_cobradores.idperfiles_cobrado')
            ->where('vistas_cobradores.idUsuarios',$idUsuario)
            ->where('vistas_cobradores.eliminado',0)
            ->where('confirmado',1)
            ->selectRaw('CONCAT("Cobrador"," - ",usuarios.rut,"(",descripcion,")") as descripcion, idVistaCobradores');
    }

    public  static function buscar_permiso($id,$idUsuarios){
        return VistaCobradores::where('idVistaCobradores',$id)
                                ->where('idUsuarios',$idUsuarios)
                                ->where('eliminado',0)
                                ->where('confirmado',1)
                                ->select('idperfiles_cobrado','idUsuariosMaestro')->first();
    }
}
?>