<?php
	if(isset($_POST['titulo'])){
		include('../conexion.php');
		$img = array('image/jpg', 'image/jpeg', 'image/png');
		$titulo= $_POST['titulo'];
		$categoria= $_POST['categoria'];
		$ciudad= $_POST['ciudad'];
		$descripcion= $_POST['descripcion'];
		$usrid= $_POST['userid'];
		if($_FILES['imagen']['tmp_name']!=""){
		    if($_FILES['imagen']['size'] > 500000) {
		        ?>
		        <script>
		            alert('El tama\u00f1o de la imagen es muy grande');
		            window.location.href="php/gauchada/nueva.php?usid=<?php echo $usrid; ?>";
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
		            window.location.href='php/gauchada/nueva.php?usid=<?php echo $usrid; ?>';
		        </script>
		        <?php
		    }
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