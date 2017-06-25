<html>
<?php
	include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>Perfil</title>
  <link rel="stylesheet" href="/css/perfil.css">
</head>
<body>
    
    <?php 
     if (isset($_SESSION['usuario'])){
         }
    echo $_GET['usid'];
    $otrouser= $_GET['usid'];
    ?>
    
    <?php     
    $user = "SELECT * FROM usuarios  WHERE id_usuario='$otrouser'";
    
    $resultado = mysqli_query($conexion, $user);
    
    $usuario = mysqli_fetch_assoc($resultado);
    
    $puntos= $usuario['puntos'];
    $ranks = "SELECT * FROM rangos  WHERE max >='$puntos' AND min <= '$puntos' ";
    $resultado3= mysqli_query($conexion, $ranks);
    $rango = mysqli_fetch_assoc($resultado3);
    
    ?>
    
    <div id='perfil'>Perfil:
        <div id='foto'><img height="240px" src="data:<?php echo $usuario['extension']; ?>;base64,<?php echo base64_encode($usuario['foto']); ?>"/></div>
        <div id='pnombre'>Nombre:<?php echo $usuario['nombre']; ?></div>
        <div id='papellido'>Apellido:<?php echo $usuario['apellido']; ?></div>
        <div id='pnacimiento'>Fecha:<?php echo $usuario['nacimiento']; ?></div>
        <div id='ppuntos'>Rango:<?php echo $rango['nombre']; ?></div>
    </div>
    
    
    </body>
</html>