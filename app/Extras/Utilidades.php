<?php

namespace App\Extras;

use App\Bancos;
use App\TipoCuenta;

class Utilidades
{
    static function formatoFechaDB($fecha)
    {
        $date = str_replace('/', '-', $fecha);
        return date('Y-m-d', strtotime($date));
    }

    static function formatoFechaDBTime($fecha)
    {
        $date = str_replace('/', '-', $fecha);
        return date('Y-m-d H:i', strtotime($date));
    }

    static function ImprimirFecha($fecha){
        return date('d/m/Y', strtotime($fecha));
    }

    static function ImprimirFechaHora($fecha){
        return date('d/m/Y H:i', strtotime($fecha));
    }

    static function UltimoAcceso($fecha){
        return "Su último acceso fue el ".date('d/m/Y',strtotime($fecha))." a las ".date('H:i',strtotime($fecha))." hrs.";
    }

    static function mes_actual(){
        return date('m');
    }

    static function Moneda($valor){
        return number_format($valor, 0, '', '.');
    }

    static function ValidarRut($value){
        $rut = $value;
        if( empty( $rut ) ) return false;

        if (!preg_match("/(\d{7,8})-([\dK])/", strtoupper($rut), $aMatch)) {
            return false;
        }
        $sRutBase = substr(strrev($aMatch[1]) , 0, 8 );
        $sCodigoVerificador = $aMatch[2];
        $iCont = 2;
        $iSuma = 0;
        for ($i = 0;$i<strlen($sRutBase);$i++) {
            if ($iCont>7) {
                $iCont = 2;
            }
            $iSuma+= ($sRutBase{$i}) *$iCont;
            $iCont++;
        }
        $iDigito = 11-($iSuma%11);
        $sCaracter = substr("-123456789K0", $iDigito, 1);
        return ($sCaracter == $sCodigoVerificador);
    }

    static function ValidarEmail($value){
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    static function EsNumero($value){
        if(is_numeric($value)){
            return true;
        }
        return false;
    }

    static function StringValido($value){
        if (strlen(trim($value)) == 0) {
            return false;
        }
        return true;
    }

    static function ValidarFecha($value){
        if(strpos($value,'/') === false){
            return false;
        }else {
            list($dd, $mm, $yyyy) = explode('/', $value);
            if (!checkdate($mm, $dd, $yyyy)) {
                return false;
            }
            return true;
        }

    }

    static function errorMensajeLoop($fila,$mensajes){
        $return = "";
        $return .= "El excel tiene error(es) en la fila ".$fila. " : <br/>";
        $return .= "<ul>";
        foreach($mensajes as $data){
            $return .= "<li>".$data."</li>";
        }
        $return .= "</ul>";
        return $return;
    }

    static function modificar_rut($rut){
        return str_replace('.','',$rut);
    }

    static function email_mask($email) {
        return preg_replace('/(?<=.).(?=.*@)/u','*',$email);
    }

    static function insert_moneda($monto){
        return str_replace('.','',$monto);
    }

    static function lista_bancos(){
        return Bancos::tabla()->lists('nombre', 'nombre');
    }

    static function tipo_cuenta(){
        //$data = TipoCuenta::listar()->lists('descripcion', 'descripcion');
        //return $data;
        return array(
            'Cuenta Corriente' => 'Cuenta Corriente',
            'Cuenta Vista' => 'Cuenta Vista',
            'Chequera Electrónica' => 'Chequera Electrónica',
            'Cuenta de Ahorro' => 'Cuenta de Ahorro'
        );
    }

    static function generar_id_unico($etiqueta,$id){
        //return $etiqueta."-".$id."-".uniqid();
        return $etiqueta."P".$id."".uniqid();
    }
}
?>