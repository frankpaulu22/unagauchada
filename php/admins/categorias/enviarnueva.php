<?php
	if(isset($_POST['nombre'])){
		include('../../conexion.php');
		$nombre= $_POST['nombre'];
		$esigual= 3;


		$existe= "SELECT * FROM categorias";
		$probar= mysqli_query($conexion, $existe);

		while($existencia= mysqli_fetch_array($probar)){
			if($existencia['categoria'] == $nombre){
				$esigual=1;
			}
		}

		if($esigual==1){
?>
				<script>
					alert('El nombre de la categoria ya existe');
					window.location.href='/php/admins/categorias/crear.php';
				</script>
<?php			
		}
		else{
			$insertar3 = "INSERT INTO categorias(categoria) VALUES ('$nombre')";
			$resultado3 = mysqli_query($conexion, $insertar3) or die ('Problemas en la consulta'. mysql_error());

?>
			<script>
				alert('Nueva categoria creada');
				window.location.href='/php/admins/categorias.php';
			</script>
<?php
		}
	}