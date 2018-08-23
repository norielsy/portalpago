<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Logaccesos extends Model
{
    protected $table = 'logaccesos';
    protected $primaryKey = 'IDLogAcceso';

    public static function total_ultimo_mes($mes){

        return Logaccesos::where(DB::raw('MONTH(created_at)'),$mes)
                            ->where(DB::raw('YEAR(created_at)'),date("Y"))
                            ->count();
    }

    public static function lista_usuarios_ultimo_mes_excel($mes){
        /*
         * SELECT U.email,U.nombre,U.rut, L.*
                        FROM logaccesos L
                        INNER JOIN usuarios U ON L.idUsuarios = U.idUsuarios
                        WHERE MONTH(L.created_at) = 2 AND YEAR(L.created_at) = 2017
                        ORDER BY DAY(L.created_at) DESC ,HOUR(L.created_at) DESC
         */
        $data = Logaccesos::join('usuarios','usuarios.idUsuarios','=','logaccesos.idUsuarios')
                ->where(DB::raw('MONTH(logaccesos.created_at)'),$mes)
                ->where(DB::raw('YEAR(logaccesos.created_at)'),date("Y"))
                ->select('usuarios.rut','usuarios.email','usuarios.nombre','logaccesos.*')
                ->orderBy('logaccesos.created_at', 'desc');

        return json_decode(json_encode($data->get()),true);
    }
}
?>