<?php
	$userid= $_GET['id'];
	include('../../conexion.php');

	$updat= "UPDATE admins SET estado='1' WHERE id_admin='$userid'";
	$cons= mysqli_query($conexion, $updat);


	?>
		<script>
			alert('Cuenta eliminada exitosamente');
			window.location.href='/php/admins/usuarios.php';
		</script>
	<?php

