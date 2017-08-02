<?php
	$rangoid= $_GET['id'];
	include('../../conexion.php');

	$select= "SELECT * FROM rangos ORDER BY min";
	$consulta= mysqli_query($conexion, $select);

	$select1= "SELECT * FROM rangos ORDER BY min";
	$consulta1= mysqli_query($conexion, $select1);

	$primero= mysqli_fetch_assoc($consulta1);

	$rango= mysqli_fetch_array($consulta);

	while($rango['id_rango'] <> $rangoid){
		$antid= $rango['id_rango'];
		$rango= mysqli_fetch_array($consulta);
		$maxdeleteado= $rango['max'];
		$deletear= $rango['id_rango'];
	}

		if($rango['id_rango'] == $rangoid && $rango['id_rango'] == $primero['id_rango']){
			$borrarid= $rango['id_rango'];
			$borrarmin= $rango['min'];
			$rango= mysqli_fetch_array($consulta);
			$idrango= $rango['id_rango'];

			$delet= "DELETE FROM rangos WHERE id_rango= $borrarid";
			$delete= mysqli_query($conexion, $delet);

			$updat= "UPDATE rangos SET min='$borrarmin' WHERE id_rango='$idrango'";
			$cons= mysqli_query($conexion, $updat);
		}
		else{
			$delet= "DELETE FROM rangos WHERE id_rango= $deletear";
			$delete= mysqli_query($conexion, $delet);

			$updat= "UPDATE rangos SET max='$maxdeleteado' WHERE id_rango='$antid'";
			$cons= mysqli_query($conexion, $updat);

		}

	?>
		<script>
			alert('Rango eliminado exitosamente');
			window.location.href='/php/admins/rangos.php';
		</script>
	<?php

