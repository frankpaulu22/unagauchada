<?php
	$userid= $_GET['usid'];
	include('../conexion.php');

	$updat= "UPDATE usuarios SET baneado='2' WHERE id_usuario='$userid'";
	$cons= mysqli_query($conexion, $updat);

	session_start();
	session_unset();
	session_destroy();

	?>
		<script>
			alert('Cuenta eliminada exitosamente');
			window.location.href='/index.php';
		</script>
	<?php

