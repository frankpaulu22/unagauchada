<html>
<?php
    include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>Usuarios</title>
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
    if(!isset($_GET['ord'])){
    	$select= "SELECT * FROM usuarios ORDER BY apellido";
    	$consulta= mysqli_query($conexion, $select);
    }
    else if($_GET['ord'] == "dwn"){
    	$select= "SELECT * FROM usuarios ORDER BY puntos ASC";
    	$consulta= mysqli_query($conexion, $select);   	
    }
    else if($_GET['ord'] == "up"){
    	$select= "SELECT * FROM usuarios ORDER BY puntos DESC";
    	$consulta= mysqli_query($conexion, $select); 
    } 
?>
		<div id='crear'><a href="/php/admins/usuarios/altaadmin.php">Crear usuario administrador</a></div>

		<div id='tabla1'>
				<table border="1">
				<tr>Usuarios</tr>
				<tr>
					<td><strong>ID</strong></td>
					<td><strong>Apellido</strong></td>
					<td><strong>Nombre</strong></td>
					<td><strong>Email</strong></td>
					<td><strong>Telefono</strong></td>
					<td><strong><a href="/php/admins/usuarios.php?ord=dwn"><img src="/img/down.png" width="15px"></a>Puntos<a href="/php/admins/usuarios.php?ord=up"><img src="/img/up.png" width="15px"></a></strong></td>
					<td><strong>Estado</strong></td>
					<td><strong></strong></td>
				</tr>
		    	
	<?php   
		    	while($usuario= mysqli_fetch_array($consulta)){
		    		echo "<tr>";
			    		echo "<td>".$usuario['id_usuario']."</td>";
			    		$userid= $usuario['id_usuario'];
			    		echo "<td>".$usuario['apellido']."</td>";
			    		echo "<td>".$usuario['nombre']."</td>";
			    		echo "<td>".$usuario['email']."</td>";
			    		echo "<td>".$usuario['telefono']."</td>";
			    		echo "<td>".$usuario['puntos']."</td>";
			    		if($usuario['baneado'] == 1){
			    			echo "<td>Baneado</td>";
			    			?><td><a onclick="return confirm('Esta seguro que desea desbloquear a este usuario')" href="/php/admins/usuarios/desbloquear.php?id=<?php echo $userid ?>">Desbloquear</a></td> <?php
			    		}
			    		else if($usuario['baneado'] == 0){
			    			echo "<td>Activo</td>";
			    			?><td><a onclick="return confirm('Esta seguro que desea bloquear a este usuario?')" href="/php/admins/usuarios/bloquear.php?id=<?php echo $userid ?>">Bloquear</a></td> <?php
			    		}
			    		else if($usuario['baneado'] == 2){
			    			echo "<td>Eliminado</td>";
			    			?><td>.....</td><?php
			    		}

		    		echo "</tr>";
		    	}
	?>
				</table>
		</div>	

		<div id='tabla2'>
				<table border="1">
				<tr>Administradores</tr>
				<tr>
					<td><strong>ID</strong></td>
					<td><strong>Apellido</strong></td>
					<td><strong>Nombre</strong></td>
					<td><strong>Email</strong></td>
					<td><strong>Email</strong></td>
					<td><strong></strong></td>
				</tr>
		    	
	<?php   
	    	$select1= "SELECT * FROM admins";
    		$consulta1= mysqli_query($conexion, $select1);

		    	while($admin= mysqli_fetch_array($consulta1)){
		    		echo "<tr>";
			    		echo "<td>".$admin['id_admin']."</td>";
			    		$admid= $admin['id_admin'];
			    		echo "<td>".$admin['nombre']."</td>";
			    		echo "<td>".$admin['apellido']."</td>";
			    		echo "<td>".$admin['email']."</td>";
			    		if($admin['estado'] == 1){
			    			echo "<td>Eliminado</td>";
			    		}
			    		else if($admin['estado'] == 0){
			    			echo "<td>Activo</td>";
			    		}
	?>
						<td><a onclick="return confirm('Esta seguro que desea eliminar a este admin?')" href="/php/admins/usuarios/bajaadmin.php?id=<?php echo $admid ?>">Eliminar</a></td>
	<?php

		    		echo "</tr>";
		    	}
	?>
				</table>
		</div>
</body>
</html>