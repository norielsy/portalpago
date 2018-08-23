<?php

include "connect.php";

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


