<?php
	if(isset($_POST['titulo'])){
		include('../conexion.php');

		$titulo= $_POST['titulo'];
		$categoria= $_POST['categoria'];
		$ciudad= $_POST['ciudad'];
		$descripcion= $_POST['descripcion'];
		$usrid= $_POST['userid'];
		if($_FILES['imagen']['tmp_name']!=""){
			$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
		    $extension = $_FILES['imagen']['type'];
		}
		else {
			$ruta= "logo.png";
			$imagen = addslashes(file_get_contents($ruta));
			$extension = "image/png";
			echo $imagen;
		}

	    $restar= '1';

		$insertar = "INSERT INTO gauchadas(idusuario, idcategoria, idciudad, titulo, descripcion, foto, extension) VALUES ('$usrid', '$categoria', '$ciudad', '$titulo', '$descripcion', '$imagen', '$extension')";
	    $resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

		$update = "UPDATE usuarios SET creditos=creditos - '$restar' WHERE id_usuario=$usrid";
	    $updcreditos = mysqli_query($conexion, $update) or die ('Problemas en la consulta'. mysql_error());

?>   
	    <script>
	        alert('Se publico la gauchada');
	        window.location.href='/index.php';
	    </script>      
<?php
	}
    else {
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php   
    }   