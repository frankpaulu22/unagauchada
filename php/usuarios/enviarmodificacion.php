<?php
	include('../conexion.php');

	if(!isset($_POST['email'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php 
	}
?>

<?php
    $user = "SELECT * FROM usuarios  WHERE id_usuario='$_SESSION['usuario']'";
    
    $resultado = mysqli_query($conexion, $user);
    
    $usuario = mysqli_fetch_assoc($resultado);
    
    ?>
<?php
	$email = $_POST['email'];

	$seleccionar = "SELECT * FROM usuarios WHERE email='$email'"; 
    $existe = mysqli_query($conexion, $seleccionar) or die ('Problemas en la consulta'. mysql_error());

    if(mysqli_num_rows($existe)>0 && $email <> $usuario['email'] ) {
    	?>   
	    <script>
	        alert('La direccion de email ya esta registrada');
	        window.location.href='/php/usuarios/modificar.php';
	    </script>  
	    <?php
    }
    else {

		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$clave = $_POST['clave'];
		$fecha = $_POST['fecha'];
		$telefono = $_POST['telefono'];
        
        if($_FILES['imagen']['tmp_name']!=""){
		    if($_FILES['imagen']['size'] > 500000) {
		        ?>
		        <script>
		            alert('El tama\u00f1o de la imagen es muy grande');
		            window.location.href="/php/gauchada/nueva.php?usid=<?php echo $usrid; ?>";
		        </script>
		        <?php
		    }
		    else {
		        foreach($img as $extension) {
		            if($_FILES['imagen']['type'] == $extension) {
		                $extvalida=1;
		                break;
		            }
		            else {
		                $extvalida=0;
		            }
		        }
		    }
		    if($extvalida == 0) {
		        ?>
		        <script>
		            alert('La extension de la imagen no es un tipo de imagen valido');
		            window.location.href='/php/gauchada/nueva.php?usid=<?php echo $usrid; ?>';
		        </script>
		        <?php
		    }
		    else{
		    	$foto = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
		    	$extension = $_FILES['imagen']['type'];

		$insertar = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', email = '$email', clave = '$clave', nacimiento = '$fecha', telefono = '$telefono', foto = '$foto', extension = '$extension' WHERE usuarios.id_usuario = $usuario['id_usuario']";
	    $resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

	?>   
	    <script>
	        alert('Registro completado');
	        window.location.href='/index.php';
	    </script>    
	<?php       
	}

?>	