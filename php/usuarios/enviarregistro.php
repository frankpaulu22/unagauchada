<?php
	include('../conexion.php');

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$email = $_POST['email'];
	$clave = $_POST['clave'];
	$fecha = $_POST['fecha'];
	$telefono = $_POST['telefono'];

	$insertar = "INSERT INTO usuarios(nombre, apellido, email, clave, nacimiento, telefono) VALUES ('$nombre', '$apellido', '$email', '$clave', '$fecha', '$telefono')";
    $resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

?>   
    <script>
        alert('Bienvenido');
        window.location.href='/index.php';
    </script>       