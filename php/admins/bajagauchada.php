<?php
	include('../conexion.php');

	$gauid= $_GET['gaid'];
	$usid= $_GET['usid'];

    $restar= '1';
	$update= "UPDATE gauchadas SET borrada= 1 WHERE id_gauchada='$gauid'";
	$consulta= mysqli_query($conexion, $update);

	$select= "SELECT * FROM usuarios WHERE id_usuario='$usid'";
	$consulta1= mysqli_query($conexion, $select);
	$usuario= mysqli_fetch_array($consulta1);
	$user= $usuario['email'];
        

?>
	<script>
	    alert('Se elimino la gauchada y se envio un email a <?php echo $user; ?> informando el incumplimiento de las normas del sitio.');
	    window.location.href='/index.php';
	</script>
<?php