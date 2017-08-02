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
    
    if ($usuario['baneado'] > 0){
        if ($usuario['baneado'] == 1){
            ?>
            <div id='eliminado'><?php echo 'Este usuario elimino su cuenta'?></div>
        <?php
        }
        else{
            ?>
            <div id='baneado'><?php echo 'Este usuario ya no tiene permitido el acceso'?></div>
        <?php
        }
    }
    
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
    
    <div id='calificaciones'>Gauchadas realizadas:
        <div id='calificacion'>
            <?php
            $contar = mysqli_num_rows($resultado1);
            if($contar == 0) {
                ?>
                <div id='nohay'><?php echo "Este usuario no realizo gauchadas por el momento";?></div>
                <?php
            }
            while($calificacion= mysqli_fetch_array($resultado1)) {
                
            $ga = "SELECT * FROM gauchadas  WHERE id_gauchada='$calificacion[idgauchada] '";
            $resultado4= mysqli_query($conexion, $ga);
            $gau= mysqli_fetch_assoc($resultado4);
            
            echo "<hr/>";
            ?>
            <div id='tit'><?php echo 'Gauchada: '.$gau['titulo'];
            echo "<hr/>";?></div>
            <?php
            echo 'Calificacion: '.$calificacion['puntaje'];
            echo "<br/>";
            echo "Comentario:";
            echo "<br/>";
            echo $calificacion['comentario'];
            echo "<hr/>";
            echo "<br>";
                }
            ?>
            </div>
    </div>
    
    
    </body>
</html>