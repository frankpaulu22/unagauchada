<?php
	include('../conexion.php');
	session_start();

	if(!isset($_POST['email'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php 
	}
?>

<?php
	$usr= $_SESSION['usuario'];
    $user = "SELECT * FROM usuarios WHERE id_usuario='$usr'";
    
    $resultado = mysqli_query($conexion, $user);
    
    $usuario = mysqli_fetch_assoc($resultado);

    $claveold= $_POST['claveold'];

    if($usuario['clave'] <> $claveold){
		?>
		    <script>
		            alert('La clave es incorrecta');
		            window.location.href="/php/usuarios/modificar.php?usid=<?php echo $_SESSION['usuario']; ?>";
		        </script>
		        <?php
    }
    else {
    
		$email = $_POST['email'];
		$nombre = $_POST['nombre'];
		$clave = $_POST['clave'];
		$apellido = $_POST['apellido'];
		$fecha = $_POST['fecha'];
		$telefono = $_POST['telefono'];

		if($_FILES['imagen']['tmp_name']!=""){
			$foto = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
			$extension = $_FILES['imagen']['type'];
			$insertar = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', email = '$email', clave = '$clave', nacimiento = '$fecha', telefono = '$telefono', foto = '$foto', extension = '$extension' WHERE usuarios.id_usuario = '$usr'";
		    $resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

		}
		else {

			$insertar = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', email = '$email', clave = '$clave', nacimiento = '$fecha', telefono = '$telefono' WHERE usuarios.id_usuario = '$usr'";
	    	$resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());
		}

	?>   
	    <script>
	        alert('Modificacion completada');
	        window.location.href='/php/usuarios/miperfil.php';
	    </script>    
	<?php  

    
	}
?>	