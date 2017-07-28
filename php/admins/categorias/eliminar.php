<?php
	$cateid= $_GET['id'];
	include('../../conexion.php');

	$delet= "UPDATE categorias SET Disponible= 'No' WHERE id_categoria= $cateid";
	$delete= mysqli_query($conexion, $delet);

	?>
		<script>
			alert('Categoria eliminada exitosamente');
			window.location.href='/php/admins/categorias.php';
		</script>
	<?php

