<?php
	include("../conexion.php");
	$respuesta= $_POST['respuesta'];
	$gauid= $_POST['gaid'];
    $coid= $_POST['comid'];

	$insertar= "UPDATE comentarios c SET respuesta= '$respuesta' WHERE c.id_comentario = $coid";
	$consulta= mysqli_query($conexion, $insertar);

?>
	<script>
		alert('Su respuesta a sido publicada');
		window.location.href='/php/gauchada/detalle.php?ga=<?php echo $gauid; ?>';
	</script>