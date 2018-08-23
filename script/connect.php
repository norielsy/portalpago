<?php


/*
$db_host="127.0.0.1";
$db_usuario="root";
$db_password="";
$db_nombre="portal_pagos";
*/

$db_host="localhost";
$db_usuario="pagotrans";
$db_password="pdppass#$";
$db_nombre="pagotrans";

$db_usuario2="pdpuser";
$db_password2="pdppass#$";
$db_nombre2="pdpdb"; /* Portal de pago*/
/*
$db_host="database.guaguashower.cl";
$db_usuario="vladimirguaguash";
$db_password="sabadote1801";
$db_nombre="guaguashower";
*/


$conexion = mysql_connect($db_host, $db_usuario, $db_password) or die(mysql_error());
//$conexion = @mysql_connect($db_host, $db_usuario, $db_password);
mysql_query("SET NAMES 'utf8'");
$db = mysql_select_db($db_nombre, $conexion) or die(mysql_error());

$conexion_portal = @mysql_connect($db_host, $db_usuario2, $db_password2) or die(mysql_error());
mysql_query("SET NAMES 'utf8'");
$db2 = mysql_select_db($db_nombre2, $conexion_portal) or die(mysql_error());
?>