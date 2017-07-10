<?php
	include('../conexion.php');

	$gauid= $_GET['gaid'];
	$usid= $_GET['usid'];
	$caducidad= date("Y-m-d");

	$consulta = "SELECT * FROM gauchadas WHERE id_gauchada='$gauid'";
    $resultado = mysqli_query($conexion, $consulta);
    $gauchada= mysqli_fetch_array($resultado);

    if($gauchada['idpostulante'] != 0 or $gauchada['expiracion'] < $caducidad) {
?>   
	    <script>
	        alert('No puede eliminar esta gauchada');
	        window.location.href='/php/gauchada/detalle.php?ga=<?php echo $gauid; ?>';
	    </script>
<?php
    }
    else {

    	$restar= '1';
		$update= "UPDATE gauchadas SET borrada= 1 WHERE id_gauchada='$gauid'";
		$consulta= mysqli_query($conexion, $update);

		$update2 = "UPDATE usuarios SET creditos=creditos + '$restar' WHERE id_usuario=$usid";
		$updcreditos2 = mysqli_query($conexion, $update2) or die ('Problemas en la consulta'. mysql_error());

?>
	    <script>
	        alert('Se elimino la gauchada');
	        window.location.href='/index.php';
	    </script>
<?php
	}