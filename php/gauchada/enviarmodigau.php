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
		$gauid= $_POST['gauid'];

				if(!empty($_FILES['imagen']['tmp_name'])){
                    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
  		    	    $extension = $_FILES['imagen']['type'];
  		    	    $img1= ", foto1='$imagen', extension1='$extension'";
                }
                else{
                    $imagen ='';
                    $extension = '';
                    $img1= "";
                }
                if(!empty($_FILES['imagen2']['tmp_name'])){
                    $imagen2 = addslashes(file_get_contents($_FILES['imagen2']['tmp_name']));
 		    	    $extension2 = $_FILES['imagen2']['type'];
 		    	    $img2= ", foto2='$imagen2', extension2='$extension2'";
                }
                else{
                    $imagen2 ='';
                    $extension2 = '';
                    $img2= "";
                }
                if(!empty($_FILES['imagen3']['tmp_name'])){
 		    	    $imagen3 = addslashes(file_get_contents($_FILES['imagen3']['tmp_name']));
 		    	    $extension3 = $_FILES['imagen3']['type'];
 		    	    $img3= ", foto3='$imagen3', extension3='$extension3'";
                }
                else{
                    $imagen3 ='';
                    $extension3 = '';
                    $img3= "";
                }
 		    	    $insertar = "UPDATE gauchadas SET idcategoria='$categoria', idciudad='$ciudad', titulo='$titulo', descripcion='$descripcion', expiracion='$expiracion' $img1 $img2 $img3 WHERE id_gauchada='$gauid'";
                
                    $resultado = mysqli_query($conexion, $insertar);
?>   
	    <script>
	        alert('Se modifico la gauchada');
	        window.location.href='/php/gauchada/detalle.php?ga=<?php echo $gauid; ?>&preg=';
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