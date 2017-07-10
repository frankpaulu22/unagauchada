<?php
	include('../conexion.php');
	$posid= $_GET['po'];
    $gaid= $_GET['gau'];

    $consulta = "SELECT * FROM gauchadas WHERE id_gauchada='$gaid'";
	$resultado= mysqli_query($conexion, $consulta);
	$gauchada= mysqli_fetch_array($resultado);
	if($gauchada['idpostulante'] == 0) {

		$consulta2 = "SELECT * FROM postulantes P INNER JOIN usuarios U WHERE P.idgauchada='$gaid' AND P.idusuario='$posid' AND P.idusuario=U.id_usuario";
		$resultado2= mysqli_query($conexion, $consulta2);
		$postulantes= mysqli_fetch_array($resultado2);

		$apellido= $postulantes['apellido'];
	    $nombre= ' '.$postulantes['nombre'];

	    echo 'Seguro desea elegir a '.$apellido.' '.$nombre.' para realizar la gauchada';
		echo "</br>";
		echo "</br>";
		echo 'Recuerde que al hacerlo estara rechazando a los candidatos: ';
		echo "</br>";


	    $consulta3 = "SELECT * FROM postulantes P INNER JOIN usuarios U WHERE P.idgauchada='$gaid' AND P.idusuario <> '$posid' AND P.idusuario=U.id_usuario";
	    $resultado3= mysqli_query($conexion, $consulta3);
	    $rechazados= ' ';
		while($postulantes2= mysqli_fetch_array($resultado3)) {
	        echo $postulantes2['apellido'].' '.$postulantes2['nombre'].'.';
	        echo "</br>";
		}   

	?> 

		<a href="javascript:window.close();">Cancelar</a>
		<a href="/php/gauchada/elegirpostu.php?po=<?php echo $postulantes['id_usuario']; ?>&gau=<?php echo $gaid; ?>">Aceptar</a>

	<?php
	}
	else {
		echo "Usted ya a elegido a alguien para realizar la gauchada";
		echo "</br>";
		echo "</br>";
		?>
		<a href="javascript:window.close();">Ok</a>
		<?php
	}
	?>