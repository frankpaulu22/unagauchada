<?php
	include('../conexion.php');

	if(!isset($_POST['email'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php 
	}

	$email = $_POST['email'];

	$seleccionar = "SELECT * FROM usuarios WHERE email='$email'"; 
    $existe = mysqli_query($conexion, $seleccionar) or die ('Problemas en la consulta'. mysql_error());

    if(mysqli_num_rows($existe)>0) {
    	?>   
	    <script>
	        alert('La direccion de email ya esta registrada');
	        window.location.href='/php/usuarios/registro.php';
	    </script>  
	    <?php
    }
    else {

		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$clave = $_POST['clave'];
		$fecha = $_POST['fecha'];
		$telefono = $_POST['telefono'];

		$insertar = "INSERT INTO usuarios(nombre, apellido, email, clave, nacimiento, telefono) VALUES ('$nombre', '$apellido', '$email', '$clave', '$fecha', '$telefono')";
	    $resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

	?>   
	    <script>
	        alert('Registro completado');
	        window.location.href='/index.php';
	    </script>    
	<?php       
	}

?>	