<?php
	include('../../conexion.php');

	if(!isset($_POST['email'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php 
	}

	$email = $_POST['email'];

	$seleccionar = "SELECT * FROM admins WHERE email='$email'"; 
    $existe = mysqli_query($conexion, $seleccionar) or die ('Problemas en la consulta'. mysql_error());

    if(mysqli_num_rows($existe)>0) {
    	?>   
	    <script>
	        alert('La direccion de email ya esta registrada');
	        window.location.href='/php/admins/registro.php';
	    </script>  
	    <?php
    }
    else {

		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$clave = $_POST['clave'];       
        
		$insertar = "INSERT INTO admins(nombre, apellido, email, clave) VALUES ('$nombre', '$apellido', '$email', '$clave')";
	    $resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta2'. mysql_error());

	?>   
	    <script>
	        alert('Registro completado');
	        window.location.href='/index.php';
	    </script>    
	<?php       
	}

?>	