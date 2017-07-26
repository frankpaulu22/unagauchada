<?php
	include("../conexion.php");
	$comentid= $_POST['coment'];
	$gauid= $_POST['gaid'];
    $pregun= $_POST['pregun'];

	$borrar= "DELETE FROM comentarios WHERE id_comentario= $comentid";
	$consulta= mysqli_query($conexion, $borrar);


?>
    <script>
		window.location.replace('/php/gauchada/detalle.php?ga=<?php echo $gauid; ?>&preg=<?php echo $pregun; ?>');
	</script>