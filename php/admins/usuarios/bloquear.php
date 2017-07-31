<?php
	$userid= $_GET['id'];
	include('../../conexion.php');

	$updat= "UPDATE usuarios SET baneado='1' WHERE id_usuario='$userid'";
	$cons= mysqli_query($conexion, $updat);

	$select= "SELECT * FROM usuarios WHERE id_usuario= '$userid'";
	$consulta= mysqli_query($conexion, $select);
	$user= mysqli_fetch_assoc($consulta);
	$email= $user['email'];


	?>
		<script>
			alert('Se ah enviado un email a <?php echo $email; ?> indicando el incumplimiento de las normas de usuario');
		</script>
		<script>
			alert('Cuenta baneada exitosamente');
			window.location.href='/php/admins/usuarios.php';
		</script>
	<?php

