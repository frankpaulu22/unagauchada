<?php
	include('php/conexion.php');

	$consulta = "DROP TABLE ciudad";
    $resultado = mysqli_query($conexion, $consulta);


?>