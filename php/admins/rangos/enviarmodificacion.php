<?php
	if(isset($_POST['nombre'])){
		include('../../conexion.php');
		$rangoid= $_POST['id'];
		$nombre= $_POST['nombre'];
		$puninicial= $_POST['puninicial'];
		$punfinal= $_POST['punfinal'];
		$numero= '1';


		$existe= "SELECT * FROM rangos WHERE nombre='$nombre' AND id_rango<>'$rangoid'";
		$probar= mysqli_query($conexion, $existe);
		$existe= mysqli_fetch_assoc($probar);


			if(!empty($existe)){
?>
				<script>
					alert('El nombre del rango ya existe');
					window.location.href='/php/admins/rangos/modificar.php?id=<?php echo $rangoid ?>';
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
						$borrar= "DELETE FROM rangos WHERE id_rango= $idant AND id_rango<>'$rangoid'";
						$borrado= mysqli_query($conexion, $borrar);
						$idant= $anterior;
					}

					$anterior= $idant;
					$rango= mysqli_fetch_array($consulta);
				}

				$idrango= $rango['id_rango'];

				$insertar = "UPDATE rangos SET min= '$punfinal' + '$numero' WHERE id_rango = '$idrango'";
				$resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

				$insertar2 = "UPDATE rangos SET max= '$puninicial' - '$numero' WHERE id_rango = '$idant'";
				$resultado2 = mysqli_query($conexion, $insertar2) or die ('Problemas en la consulta'. mysql_error());

				$insertar3 = "UPDATE rangos SET nombre= '$nombre', min='$puninicial', max='$punfinal' WHERE id_rango='$rangoid'";
				$resultado3 = mysqli_query($conexion, $insertar3) or die ('Problemas en la consulta'. mysql_error());

		?>
				<script>
					alert('Rango modificado exitosamente');
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