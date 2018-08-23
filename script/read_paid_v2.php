<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function obtener_campo($msg, $str1, $str2, $offset1, $offset2){

		$pos1 = strpos($msg , $str1);
		$pos1 += $offset1;
		$txt = substr($msg, $pos1, 1000);
		$pos2 = strpos($txt , $str2);
		$pos2 = $pos2 - $offset2;

		$campo = substr($txt, 0, $pos2);
		$campo = str_replace(":", "", $campo);			
		$campo = trim($campo);
		$campo = str_replace("&nbsp;", "", $campo);		
		$campo = str_replace("*", "", $campo);
		$campo = str_replace("=", "", $campo);
		$campo = trim($campo);

		return $campo;
}

function obtener_tipo_a_pagar($id_transaccion){
	$data = explode('P',$id_transaccion);
	$total = count($data);
	return ($total >= 2) ? $data[0] : 0;
}

function obtener_id_descripcion($string) {
    $pattern = "/(P|p)ortal de pago?.*:\s?([^\s]+)/";
    preg_match($pattern, $string, $matches);
    $total = count($matches);
    return ($total > 2) ? $matches[2] : "codigo no encontrado";
}

ini_set("max_execution_time",360);
include "connect.php";





//MOSTRAR DATOS DE BD:
		$sql = "SELECT `id`, `host`, `value`, `bank`, `remite`, `dest_name`, `dest_bank`, `dest_account`, `dest_rut`, `detail`, `unix_time` ";
		$sql .= " FROM `transferencias_info` WHERE 1";

		$result=mysql_query($sql, $conexion);
		$last_udate = "";

		print "<table>";

		print "</tr>";
		print "<th>ID</th>";
		print "<th>HOST</th>";
		print "<th>MONTO</th>";
		print "<th>BANCO</th>";
		print "<th>DEPOSITANTE</th>";
		print "<th>DESTINATARIO</th>";
		print "<th>BANCO DESTINO</th>";
		print "<th>CUENTA DESTINO</th>";
		print "<th>RUT DESTINO</th>";
		print "<th>DETALLE</th>";
		print "<th>ID MAIL</th>";
		print "</tr>";

		while ($row=@mysql_fetch_array($result))
			{
				print "<tr>";
				$id = $row["id"];
				$host = $row["host"];
				$valor = $row["value"];
				$banco = $row["bank"];
				$remite = $row["remite"];
				$dest_name = $row["dest_name"];
				$dest_bank = $row["dest_bank"];
				$dest_account = $row["dest_account"];
				$dest_rut = $row["dest_rut"];
				$detail = $row["detail"];

			  	$last_udate = $row["unix_time"];

			  	print "<td> $id </td>";
			  	print "<td> $host </td>";
			  	print "<td> $valor </td>";
			  	print "<td> $banco </td>";
			  	print "<td> $remite </td>";
			  	print "<td> $dest_name </td>";
			  	print "<td> $dest_bank </td>";
			  	print "<td> $dest_account </td>";
			  	print "<td> $dest_rut </td>";
			  	print "<td> $detail </td>";
			  	print "<td> $last_udate </td>";

			  	
			  	print "</tr>";

			}



@mysql_close($conexion);

?>


