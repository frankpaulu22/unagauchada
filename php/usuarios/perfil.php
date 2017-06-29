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
    
    $cali = "SELECT * FROM calificaciones  WHERE idpostulante='$usuario[id_usuario] '";
    $resultado1= mysqli_query($conexion, $cali);
    
    ?>
    
    <div id='perfil'>Perfil:
        <div id='foto'><img height="240px" src="data:<?php echo $usuario['extension']; ?>;base64,<?php echo base64_encode($usuario['foto']); ?>"/></div>
        <div id='pnombre'>Nombre:<?php echo $usuario['nombre']; ?></div>
        <div id='papellido'>Apellido:<?php echo $usuario['apellido']; ?></div>
        <div id='pnacimiento'>Fecha:<?php echo $usuario['nacimiento']; ?></div>
        <div id='ppuntos'>Rango:<?php echo $rango['nombre']; ?></div>
    </div>
    
    <div id='calificaciones'>Calificaciones:
        <div id='calificacion'>
            <?php
            while($calificacion= mysqli_fetch_array($resultado1)) {
                
            echo "<hr/>";
            echo $calificacion['puntaje'];
            echo "<hr/>";
            echo $calificacion['comentario'];
            echo "<hr/>";
            echo "<br>";
                }
            ?>
            </div>
    </div>
    
    
    </body>
</html>