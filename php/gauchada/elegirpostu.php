<?php
	include('../conexion.php');
    $posid= $_GET['po'];
    $gaid= $_GET['gau'];
    if(!isset($_GET['gau']) or !isset($_GET['po'])){
?> 
    	<script>
            window.location.href='/index.php';
        </script> 
<?php   
	}
	else {
		$selecpostu = "UPDATE gauchadas SET idpostulante='$posid' WHERE id_gauchada='$gaid'";
		$consulta = mysqli_query($conexion, $selecpostu);
	}
?>
	<form action='/index.php' method="POST">
		<input type="text" name="correo">
		<input type="submit" name="Enviar">
	</form>