<?php 
	include("conexion.php");
	$usrid = $_GET['usid']; 
	$consulcredi = "SELECT * FROM usuarios WHERE id_usuario=$usrid";
	$resulcredi = mysqli_query($conexion, $consulcredi);	
	$totcredi = mysqli_fetch_assoc($resulcredi);
	echo 'Usted tiene: ', $totcredi['creditos'],' creditos';
?>
	<form action='/php/enviarcompra.php?usid=<?php echo $usrid ?>' method='POST'">
		<input type='text' name='numtarjeta' placeholder='Numero de tarjeta*'>
	    <input type='text' name='cantcredi' placeholder='Cantidad de creditos*'>
	    <input type='submit' value='Comprar'>
	</form>