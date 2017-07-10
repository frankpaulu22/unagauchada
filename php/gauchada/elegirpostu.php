<?php
	include('../conexion.php');
	$posid= $_GET['po'];
    $gaid= $_GET['gau'];

    $consulta2 = "SELECT * FROM usuarios WHERE id_usuario='$posid'";
    $resultado2= mysqli_query($conexion, $consulta2);
	$postulantes= mysqli_fetch_array($resultado2);
	$apellido= $postulantes['apellido'];
    $nombre= ' '.$postulantes['nombre'];
    $email= $postulantes['email'];


    echo "Se enviara un email a la direccion ".$email." para indicarle a ".$apellido." ".$nombre." que ah sido seleccionado para realizar la gauchada";


	$selecpostu = "UPDATE gauchadas SET idpostulante='$posid' WHERE id_gauchada='$gaid'";
	$consulta = mysqli_query($conexion, $selecpostu);
	echo "</br>";
	echo "</br>";
	echo "</br>";
?>
	<a href="javascript:window.close();">Listo</a> 
