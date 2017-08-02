<html>
<?php
    include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>Categorias</title>
  <link rel="stylesheet" href="/css/perfil.css">
</head>
<body>
    
    <?php 
    if(!isset($_SESSION['admin'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php   
    } 

    	$select= "SELECT * FROM categorias ORDER BY categoria";
    	$consulta= mysqli_query($conexion, $select);
?>
		<div id='crear'><a href="/php/admins/categorias/crear.php">Crear categoria</a></div>

		<div id='perfil'>
<?php
			if(!$consulta){
				echo "<h2>No existen categorias creadas</h2>";
			}
			else{
?>
				<table border="1">
				<tr>
					<td><strong>Categoria</strong></td>
					<td><strong>Disponible</strong></td>
					<td><strong></strong></td>
					<td><strong></strong></td>
				</tr>
		    	
	<?php   
		    	while($categoria= mysqli_fetch_array($consulta)){
		    		echo "<tr>";
			    		$cateid= $categoria['id_categoria'];
			    		echo "<td>".$categoria['categoria']."</td>";
			    		echo "<td>".$categoria['Disponible']."</td>";
	?>
						<td><a href="/php/admins/categorias/modificar.php?id=<?php echo $cateid ?>">Modificar</a></td>
						<td><a onclick="return confirm('Esta seguro que desea eliminar esta categoria?')" href="/php/admins/categorias/eliminar.php?id=<?php echo $cateid ?>">Eliminar</a></td>
	<?php

		    		echo "</tr>";
		    	}
	?>
				</table>
<?php
			}
?>
		</div>	
</body>
</html>