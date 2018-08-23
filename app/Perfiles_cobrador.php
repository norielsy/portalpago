<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Perfiles_cobrador extends Model
{
    protected $table = 'perfiles_cobrado';
    protected $primaryKey = 'idperfiles_cobrado';

    static function lista(){
        return Perfiles_cobrador::select();
    }
}
?>