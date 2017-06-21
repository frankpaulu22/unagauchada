<?php
	include("../conexion.php");
	$respuesta= $_POST['respuesta'];
	$gauid= $_POST['gaid'];

	$insertar= "UPDATE comentarios SET respuesta= '$respuesta'";
	$consulta= mysqli_query($conexion, $insertar);

?>
	<script>
		alert('Su respuesta a sido publicada');
		window.location.href='/php/gauchada/detalle.php?ga=<?php echo $gauid; ?>';
	</script>