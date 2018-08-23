<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class TipoPagos extends Model
{
    protected $table = 'tipo_pagos';
    protected $primaryKey = 'idTipoPago';

    public static function listar_pagos(){
        return TipoPagos::where('eliminado',0)->get();
    }
}
?>