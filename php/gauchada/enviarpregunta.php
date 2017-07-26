<?php
	include("../conexion.php");
	$pregunta= $_POST['pregunta'];
	$userid= $_POST['usid'];
	$gauid= $_POST['gaid'];

	$insertar= "INSERT INTO comentarios(idgauchada, idusuario, pregunta, respuesta) VALUES ('$gauid', '$userid', '$pregunta', '')";
	$consulta= mysqli_query($conexion, $insertar);

?>
	<script>
		alert('Su pregunta a sido publicada');
		window.location.href='/php/gauchada/detalle.php?ga=<?php echo $gauid; ?>&preg=';
	</script>