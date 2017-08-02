<html>
<?php
    include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>Rangos</title>
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

    	$select= "SELECT * FROM rangos ORDER BY min";
    	$consulta= mysqli_query($conexion, $select);
    	$existe= mysqli_fetch_array($consulta);
?>
		<div id='crear'><a href="/php/admins/rangos/crear.php">Crear rango</a></div>

		<div id='perfil'>
<?php
			if(empty($existe)){
				echo "<h4>No hay rangos disponibles aun</h4>";
			}
			else{
?>
				<table border="1">
				<tr>
					<td><strong>Rango</strong></td>
					<td><strong>Desde</strong></td>
					<td><strong>Hasta</strong></td>
					<td><strong></strong></td>
					<td><strong></strong></td>
				</tr>
		    	
	<?php   
	    		$select1= "SELECT * FROM rangos ORDER BY min";
    			$consulta1= mysqli_query($conexion, $select1);
		    	while($rango= mysqli_fetch_array($consulta1)){
		    		echo "<tr>";
			    		$rangoid= $rango['id_rango'];
			    		echo "<td>".$rango['nombre']."</td>";
			    		echo "<td>".$rango['min']."</td>";
			    		echo "<td>".$rango['max']."</td>";
	?>
						<td><a href="/php/admins/rangos/modificar.php?id=<?php echo $rangoid ?>">Modificar</a></td>
						<td><a onclick="return confirm('Esta seguro que desea eliminar el rango?')" href="/php/admins/rangos/eliminar.php?id=<?php echo $rangoid ?>">Eliminar</a></td>
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