<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Nominas extends Model
{
    protected $table = 'nominas';
    protected $primaryKey = 'idnominas';

    protected $fillable = ['idUsuarios','empresa','descripcion','fecha_vencimiento'];

    public static function eliminar($id){
            Nominas::where('idnominas',$id)
                ->update(array(
                   'eliminado' => 1
                ));
    }

    public static function eliminar_nomina_hijos($id_nomina,$id_usuario){
        $rs = Nominas::where('idnominas', $id_nomina)
                ->where('idUsuarios',$id_usuario)
                ->update(array(
                    'eliminado' => 1
                ));

        if($rs){
            NominasDetalles::where('idnominas',$id_nomina)
                ->where('eliminado',0)
                ->where('pagado',0)
                ->update(array(
                    'eliminado' => 1
                ));
        }

    }
}
?>