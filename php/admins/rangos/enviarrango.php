<?php
	if(isset($_POST['nombre'])){
		include('../../conexion.php');
		$nombre= $_POST['nombre'];
		$puninicial= $_POST['puninicial'];
		$punfinal= $_POST['punfinal'];
		$numero= '1';

		$existe= "SELECT * FROM rangos WHERE nombre='$nombre'";
		$probar= mysqli_query($conexion, $existe);
		$existe= mysqli_fetch_assoc($probar);


			if(!empty($existe)){
?>
				<script>
					alert('El nombre de la reputacion ya existe');
					window.location.href='/php/admins/rangos/crear.php';
				</script>
<?php
			}
			$ultimo= "SELECT * FROM rangos ORDER BY max DESC";
			$elegir= mysqli_query($conexion, $ultimo);
			$last= mysqli_fetch_array($elegir);
			$lastid= $last['id_rango'];
			if($last['max'] < $puninicial or $last['max']==$punfinal && $last['min'] < $puninicial){
				$insertar2 = "UPDATE rangos SET max= '$puninicial' - '$numero' WHERE id_rango = '$lastid'";
				$resultado2 = mysqli_query($conexion, $insertar2) or die ('Problemas en la consulta'. mysql_error());

				$insertar3 = "INSERT INTO rangos(nombre, min, max) VALUES ('$nombre', '$puninicial', '$punfinal')";
				$resultado3 = mysqli_query($conexion, $insertar3) or die ('Problemas en la consulta'. mysql_error());

		?>
				<script>
					alert('Reputacion creada exitosamente');
					window.location.href='/php/admins/rangos.php';
				</script>
		<?php
			}
			else if($last['max'] < $punfinal){
				while($last['min'] >= $puninicial ){
					$idelrango= $last['id_rango'];

					$borrar= "DELETE FROM rangos WHERE id_rango= $idelrango";
					$borrado= mysqli_query($conexion, $borrar);
					$last= mysqli_fetch_array($elegir);
				}
				if($last['min']==$puninicial){
					$lastidrango= $last['id_rango'];
					$borrar2= "DELETE FROM rangos WHERE id_rango= $lastidrango";
					$borrado2= mysqli_query($conexion, $borrar2);
				}
				else{
					$lastidrango= $last['id_rango'];
					$insertar2 = "UPDATE rangos SET max='$puninicial'-$numero WHERE id_rango = '$lastidrango'";
					$resultado2 = mysqli_query($conexion, $insertar2) or die ('Problemas en la consulta'. mysql_error());
				}

				$insertar3 = "INSERT INTO rangos(nombre, min, max) VALUES ('$nombre', '$puninicial', '$punfinal')";
				$resultado3 = mysqli_query($conexion, $insertar3) or die ('Problemas en la consulta'. mysql_error());

		?>
				<script>
					alert('Reputacion creada exitosamente');
					window.location.href='/php/admins/rangos.php';
				</script>
		<?php

			}
			else{

				$select= "SELECT * FROM rangos ORDER BY min";
				$consulta= mysqli_query($conexion, $select);

				$rango= mysqli_fetch_array($consulta);

				while($rango['max'] <= $punfinal ){
					$idant= $rango['id_rango'];

					if($rango['min'] >= $puninicial && $rango['max'] <= $punfinal){
						$borrar= "DELETE FROM rangos WHERE id_rango= $idant";
						$borrado= mysqli_query($conexion, $borrar);
						$idant= $anterior;
					}

					$anterior= $idant;
					$rango= mysqli_fetch_array($consulta);
				}

				$idrango= $rango['id_rango'];
				$rango= mysqli_fetch_array($consulta);

				if(!empty($rango)){

					$insertar = "UPDATE rangos SET min= '$punfinal' + '$numero' WHERE id_rango = '$idrango'";
					$resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

					$insertar2 = "UPDATE rangos SET max= '$puninicial' - '$numero' WHERE id_rango = '$idant'";
					$resultado2 = mysqli_query($conexion, $insertar2) or die ('Problemas en la consulta'. mysql_error());

					$insertar3 = "INSERT INTO rangos(nombre, min, max) VALUES ('$nombre', '$puninicial', '$punfinal')";
					$resultado3 = mysqli_query($conexion, $insertar3) or die ('Problemas en la consulta'. mysql_error());
				}
				else{

					$insertar2 = "UPDATE rangos SET max= '$puninicial' - '$numero' WHERE id_rango = '$idrango'";
					$resultado2 = mysqli_query($conexion, $insertar2) or die ('Problemas en la consulta'. mysql_error());

					$insertar3 = "INSERT INTO rangos(nombre, min, max) VALUES ('$nombre', '$puninicial', '$punfinal')";
					$resultado3 = mysqli_query($conexion, $insertar3) or die ('Problemas en la consulta'. mysql_error());
				}

		?>
				<script>
					alert('Reputacion creada exitosamente');
					window.location.href='/php/admins/rangos.php';
				</script>
		<?php
			}
	}
	else{
		?>
			<script>
				window.location.href='/php/admins/rangos.php';
			</script>
		<?php
	}