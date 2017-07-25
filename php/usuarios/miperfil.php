 <html>
<?php
	include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>MiPerfil</title>
  <link rel="stylesheet" href="/css/miperfil.css">
</head>
<body>
    <div id='perfil'>
    <?php 
     if (isset($_SESSION['usuario'])){
    ?>
    
    <?php     
        }
    ?>

    <?php   
    $gauchadas = "SELECT * FROM gauchadas  WHERE idusuario='$_SESSION[usuario] '";
    $user = "SELECT * FROM usuarios  WHERE id_usuario='$_SESSION[usuario]'";
    $comentarios = "SELECT * FROM comentarios  WHERE idusuario='$_SESSION[usuario]'";
    
    $resultado = mysqli_query($conexion, $user);
    $resultado1 = mysqli_query($conexion, $gauchadas);
    $resultado2= mysqli_query($conexion, $comentarios);
    
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
        <div id='ptelefono'>Telefono:<?php echo $usuario['telefono']; ?></div>
        <div id='pcreditos'>Creditos:<?php echo $usuario['creditos']; ?></div>
        <div id='pemail'>Email:<?php echo $usuario['email']; ?></div>
        <div id='ppuntos'>Puntos:<?php echo $usuario['puntos']; ?></div>
        <div id='preputacion'>Reputacion:<?php echo $rango['nombre']; ?></div>
    </div>
        
    
    <div id='gauchadas'>Gauchadas propias:
    <div id='gauchada'>
    <?php
        while($gauchada= mysqli_fetch_array($resultado1)) {
            
            $comentarios2 = "SELECT * FROM comentarios  WHERE idgauchada='$gauchada[id_gauchada] '";
            
            $resultado4 = mysqli_query($conexion, $comentarios2);
            
            $comen = mysqli_num_rows($resultado4);
            
            $calis = "SELECT * FROM calificaciones  WHERE idgauchada='$gauchada[id_gauchada] '";
            
            $resultado5 = mysqli_query($conexion, $calis);
            
            $cali = mysqli_num_rows($resultado5);
            
            if($gauchada['borrada']==1){
            ?>
                <div id='gau'><a href="/php/gauchada/detalle.php?ga=<?php echo $gauchada['id_gauchada']; ?>" style="text-decoration:none;"><?php echo $gauchada['titulo']?></a></div>
                
                <div id='estadoB'>Borrada</div>
            <?php
            }
            else{
                
                if($gauchada['expiracion']< date("Y-m-d")){
                ?>
                    <div id='gau'><a href="/php/gauchada/detalle.php?ga=<?php echo $gauchada['id_gauchada']; ?>" style="text-decoration:none;"><?php echo $gauchada['titulo']?></a></div>
                        
                        
                    <div id='estadoV'>Vencida</div>
                    

                    
                <?php
                }
                else{
                    
                    if($gauchada['cantpostulantes']==0){
                    ?>
                        <div id='gau'><a href="/php/gauchada/detalle.php?ga=<?php echo $gauchada['id_gauchada']; ?>" style="text-decoration:none;"><?php echo $gauchada['titulo']?></a></div>
                        
                        <div id='estadoS'>Sin postulantes</div>

                        
                    <?php
                    }
                    else{
                        
                        if($gauchada['idpostulante'] == 0){
                        ?>
                            <div id='gau'><a href="/php/gauchada/detalle.php?ga=<?php echo $gauchada['id_gauchada']; ?>" style="text-decoration:none;"><?php echo $gauchada['titulo']?></a></div>

                            <div id='estadoC'>Con postulantes</div>
                        <?php
                        }
                        else{
                        
                            if($cali == 0){
                            ?>
                                <div id='gau'><a href="/php/gauchada/detalle.php?ga=<?php echo $gauchada['id_gauchada']; ?>" style="text-decoration:none;"><?php echo $gauchada['titulo']?></a></div>

                                <div id='estadoN'>Adeuda calificacion</div>
                            <?php
                            }
                            else{
                            ?>
                                <div id='gau'><a href="/php/gauchada/detalle.php?ga=<?php echo $gauchada['id_gauchada']; ?>" style="text-decoration:none;"><?php echo $gauchada['titulo']?></a></div>

                                <div id='estadoCA'>Calificado</div>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            <?php
            }
            ?>    
        <?php
        }
        ?> 
    </div>
    </div>
    
    
    
    <div id='comentarios'>Comentarios propios:
    <div id='comentario'>
    <?php
        while($comentario= mysqli_fetch_array($resultado2)) {
            
            $gauchada2 = "SELECT * FROM gauchadas  WHERE id_gauchada='$comentario[idgauchada] '";
            
            $resultado3 = mysqli_query($conexion, $gauchada2);
            
            $gauch = mysqli_fetch_assoc($resultado3);
            
            if($gauch['borrada']==1){?>
                <div id='com'><a><?php echo $comentario['pregunta'];?></a></div>
            <?php
            }
            else{
            ?>
                <div id='com'><a href="/php/gauchada/detalle.php?ga=<?php echo $comentario['idgauchada']; ?>" style="text-decoration:none;"><?php echo $comentario['pregunta'];?></a></div>
            <?php
            }
            ?>
    <?php
        }
    ?>    
    </div>
    </div>
    
    <div id='Modificar'><a href="/php/usuarios/modificar.php?usid=<?php echo $_SESSION['usuario']; ?>" style="text-decoration:none;" >Modificar perfil</a></div>
        </div>
        
</body>
</html>