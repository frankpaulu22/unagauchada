<?php
	$userid= $_GET['id'];
	include('../../conexion.php');

	$select= "SELECT * FROM admins WHERE estado='0'";
	$consulta= mysqli_query($conexion, $select);
	$cantidad= mysqli_num_rows($consulta);

	if($cantidad > 1){

		$updat= "UPDATE admins SET estado='1' WHERE id_admin='$userid'";
		$cons= mysqli_query($conexion, $updat);

		session_start();
		if($userid== $_SESSION['admin']){
			session_unset();
			session_destroy();
		}


		?>
			<script>
				alert('Cuenta eliminada exitosamente');
				window.location.href='/php/admins/usuarios.php';
			</script>
		<?php
	}
	else{
		?>
			<script>
				alert('Debe quedar almenos un administrador activo');
				window.location.href='/php/admins/usuarios.php';
			</script>
		<?php
	}

?>