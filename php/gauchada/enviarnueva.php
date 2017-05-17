<?php
	include('../conexion.php');

	$titulo= $_POST['titulo'];
	$categoria= $_POST['categoria'];
	$ciudad= $_POST['ciudad'];
	$descripcion= $_POST['descripcion'];
	$usrid= $_GET['usid'];
	$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    $extension = $_FILES['imagen']['type'];
    $restar= '1';

    echo $usid;

	$insertar = "INSERT INTO gauchadas(idusuario, idcategoria, idciudad, titulo, descripcion, foto, extension) VALUES ('$usrid', '$categoria', '$ciudad', '$titulo', '$descripcion', 'imagen', 'extension')";
    $resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

	$update = "UPDATE usuarios SET creditos=creditos - '$restar' WHERE id_usuario=$usrid";
    $updcreditos = mysqli_query($conexion, $update) or die ('Problemas en la consulta'. mysql_error());

?>   
    <script>
        alert('Se publico la gauchada');
        window.location.href='/index.php';
    </script>       