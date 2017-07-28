<?php
	include('../conexion.php');
	$posid= $_GET['po'];
    $gaid= $_GET['gau'];
    
    $consulta0 = "SELECT * FROM gauchadas WHERE id_gauchada='$gaid'";
    $resultado0= mysqli_query($conexion, $consulta0);
	$gauch= mysqli_fetch_array($resultado0);

    $consulta1 = "SELECT * FROM usuarios WHERE id_usuario=$gauch[idusuario]";
    $resultado1= mysqli_query($conexion, $consulta1);
	$usuario= mysqli_fetch_array($resultado1);
    
    $consulta2 = "SELECT * FROM usuarios WHERE id_usuario='$posid'";
    $resultado2= mysqli_query($conexion, $consulta2);
	$postulantes= mysqli_fetch_array($resultado2);
	$apellido= $postulantes['apellido'];
    $nombre= ' '.$postulantes['nombre'];
    $email= $postulantes['email'];


    echo "Se enviaran los siguientes e-mails:";
    echo "</br>";
    echo "A la direccion ".$email." :Estimado ".$apellido." ".$nombre." ah sido seleccionado para realizar la gauchada ".$gauch['titulo'];
    echo "</br>";
    echo "A la direccion ".$usuario['email']." :Estimado ".$usuario['nombre']." ".$usuario['apellido']." usted selecciono a ".$apellido." ".$nombre." para realizar la gauchada ".$gauch['titulo'];


	$selecpostu = "UPDATE gauchadas SET idpostulante='$posid' WHERE id_gauchada='$gaid'";
	$consulta = mysqli_query($conexion, $selecpostu);
	echo "</br>";
	echo "</br>";
	echo "</br>";
?>

    <script>
        window.opener.location.reload();
    </script>

	<a href="javascript:window.close();">Listo</a> 
