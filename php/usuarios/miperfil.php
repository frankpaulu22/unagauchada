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
    </div>
        
    
    <div id='gauchadas'>Gauchadas propias:
    <div id='gauchada'>
    <?php
        while($gauchada= mysqli_fetch_array($resultado1)) {
            ?>
            <div id='gau'><a href="php/gauchada/detalle.php?ga=<?php echo $gauchada['id_gauchada']; ?>"><?php echo $gauchada['titulo']?></a></div>
            
        
    <?php
        }
    ?>    
    </div>
    </div>
    
    
    
    <div id='comentarios'>Comentarios propios:
    <div id='comentario'>
    <?php
        while($comentario= mysqli_fetch_array($resultado2)) {
            ?>
            <div id='gau'><a href="php/gauchada/detalle.php?ga=<?php echo $comentario['idgauchada']; ?>"><?php echo $comentario['pregunta'];?></a></div>
            
        
    <?php
        }
    ?>    
    </div>
    </div>
    
    <div id='Modificar'><a href="php/usuarios/modificar.php?usid=<?php echo $_SESSION['usuario']; ?>" >Modificar perfil</a></div>
        
</body>
</html>