<?php
	if(isset($_POST['nombre'])){
		include('../../conexion.php');
		$nombre= $_POST['nombre'];
		$cateid= $_POST['id'];
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
					window.location.href='/php/admins/categorias/modificar.php?id=<?php echo $cateid ?>';
				</script>
<?php			
		}
		else{
			$insertar3 = "UPDATE categorias SET categoria= '$nombre' WHERE id_categoria='$cateid'";
			$resultado3 = mysqli_query($conexion, $insertar3) or die ('Problemas en la consulta'. mysql_error());

?>
			<script>
				alert('La categoria se modifico correctamente');
				window.location.href='/php/admins/categorias.php';
			</script>
<?php
		}
	}