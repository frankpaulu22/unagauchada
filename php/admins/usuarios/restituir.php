<?php
	$userid= $_GET['id'];
	include('../../conexion.php');

	$updat= "UPDATE admins SET estado='0' WHERE id_admin='$userid'";
	$cons= mysqli_query($conexion, $updat);

?>
	<script>
		alert('Cuenta restaurada exitosamente');
		window.location.href='/php/admins/usuarios.php';
	</script>