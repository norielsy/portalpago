<?php

namespace App\Helper;

class Rut
{
    public static function rut($rut)
    {
        $rut = str_replace(['.', '-'], '', $rut);
        return number_format(substr($rut, 0, -1), 0, "", ".") . '-' . substr($rut, strlen($rut) - 1, 1);
    }
}
