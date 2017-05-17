<?php
	include('conexion.php');

	$usrid= $_GET['usid'];
	$cantcredi = $_POST['cantcredi'];

	$update = "UPDATE usuarios SET creditos= creditos + $cantcredi WHERE id_usuario=$usrid";
    $updcreditos = mysqli_query($conexion, $update) or die ('Problemas en la consulta'. mysql_error());

?>   
    <script>
        alert('Transaccion exitosa');
        window.location.href='/index.php';
    </script>       