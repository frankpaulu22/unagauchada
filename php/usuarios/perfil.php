<html>
<?php
	include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>Perfil</title>
  <link rel="stylesheet" href="/css/miperfil.css">
</head>
<body>
    
    <?php 
     if (isset($_SESSION['usuario'])){
         }
    $otrouser = 2 /* Hay que pasar de alguna forma el id*/
    ?>
    
    <?php     
    $user = "SELECT * FROM usuarios  WHERE id_usuario='$otrouser'";
    
    $resultado = mysqli_query($conexion, $user);
    
    $usuario = mysqli_fetch_assoc($resultado);
    
    ?>
    
    <div id='perfil'>Perfil:
        <div id='foto'><img height="240px" src="data:<?php echo $usuario['extension']; ?>;base64,<?php echo base64_encode($usuario['foto']); ?>"/></div>
        <div id='pnombre'>Nombre:<?php echo $usuario['nombre']; ?></div>
        <div id='papellido'>Apellido:<?php echo $usuario['apellido']; ?></div>
        <div id='pnacimiento'>Fecha:<?php echo $usuario['nacimiento']; ?></div>
        <div id='ptelefono'>Telefono:<?php echo $usuario['telefono']; ?></div>
        <div id='pemail'>Email:<?php echo $usuario['email']; ?></div>
        <div id='ppuntos'>Puntos:<?php echo $usuario['puntos']; ?></div>
    </div>
    
    
    </body>
</html>