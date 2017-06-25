<?php
	if(isset($_POST['titulo'])){
		include('../conexion.php');
		$img = array('image/jpg', 'image/jpeg', 'image/png');
		$restar= '1';
		$titulo= $_POST['titulo'];
		$categoria= $_POST['categoria'];
		$ciudad= $_POST['ciudad'];
		$descripcion= $_POST['descripcion'];
		$expiracion= $_POST['expiracion'];
		$usrid= $_POST['userid'];
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
		        foreach($img as $extension1) {
		            if($_FILES['imagen']['type'] == $extension1) {
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
		    	$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
		    	$extension1 = $_FILES['imagen']['type'];
		    	
                if (empty($_FILES['imagen3']['tmp_name'])){
                    if(empty($_FILES['imagen2']['tmp_name'])){
                        $insertar = "INSERT INTO gauchadas(idusuario, idcategoria, idciudad, titulo, descripcion, expiracion, foto1, extension1) VALUES ('$usrid', '$categoria', '$ciudad', '$titulo', '$descripcion', '$expiracion', '$imagen', '$extension1')";
                    }
                    else{
                        $imagen2 = addslashes(file_get_contents($_FILES['imagen2']['tmp_name']));
		    	$extension2 = $_FILES['imagen2']['type'];
                        $insertar = "INSERT INTO gauchadas(idusuario, idcategoria, idciudad, titulo, descripcion, expiracion, foto1, extension1, foto2, extension2) VALUES ('$usrid', '$categoria', '$ciudad', '$titulo', '$descripcion', '$expiracion', '$imagen', '$extension1', '$imagen2', '$extension2')";
                    }
                }
                else{
                    $imagen3 = addslashes(file_get_contents($_FILES['imagen3']['tmp_name']));
		    	$extension3 = $_FILES['imagen3']['type'];
                    $insertar = "INSERT INTO gauchadas(idusuario, idcategoria, idciudad, titulo, descripcion, expiracion, foto1, extension1, foto2, extension2, foto3, extension3) VALUES ('$usrid', '$categoria', '$ciudad', '$titulo', '$descripcion', '$expiracion', '$imagen', '$extension1', '$imagen2', '$extension2', '$imagen3', '$extension3')";
                }
		    	
			    $resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

				$update = "UPDATE usuarios SET creditos=creditos - '$restar' WHERE id_usuario=$usrid";
			    $updcreditos = mysqli_query($conexion, $update) or die ('Problemas en la consulta'. mysql_error());
		    }
		}
		else {
			$ruta= "logo.png";
			$imagen = addslashes(file_get_contents($ruta));
			$extension1 = "image/png";
			$insertar = "INSERT INTO gauchadas(idusuario, idcategoria, idciudad, titulo, descripcion, expiracion, foto, extension1) VALUES ('$usrid', '$categoria', '$ciudad', '$titulo', '$descripcion', '$expiracion', '$imagen', '$extension1')";
		    $resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

			$update = "UPDATE usuarios SET creditos=creditos - '$restar' WHERE id_usuario=$usrid";
		    $updcreditos = mysqli_query($conexion, $update) or die ('Problemas en la consulta'. mysql_error());
		}

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