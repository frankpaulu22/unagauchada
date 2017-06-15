<html>
<?php
	include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>Detalle</title>
  <link rel="stylesheet" href="/css/detalle.css">
</head>
<body>

<?php
    $gaid= $_GET['ga'];
    if(!isset($_SESSION['usuario']) or !isset($_GET['ga'])){
?> 
    	<script>
            window.location.href='/index.php';
        </script> 
<?php   
    }
    $consulta = "SELECT * FROM gauchadas G INNER JOIN categorias C ON G.idcategoria=C.id_categoria INNER JOIN usuarios U ON G.idusuario=U.id_usuario INNER JOIN ciudades Ci ON G.idciudad=Ci.id_ciudad WHERE id_gauchada='$gaid'";
    $resultado = mysqli_query($conexion, $consulta);
    $gauchada= mysqli_fetch_assoc($resultado);
    $consulta2 = "SELECT * FROM postulantes P INNER JOIN usuarios U WHERE P.idgauchada='$gaid' AND P.idusuario=U.id_usuario";
    $resultado2= mysqli_query($conexion, $consulta2);
    if (isset($_SESSION['usuario']) && $_SESSION['usuario']== $gauchada['idusuario']){
?>		<div id='gaupostulantes'>Postulantes:
<?php
        while($postulantes= mysqli_fetch_array($resultado2)) {
            echo "</br>";
            echo "<hr/>";
            echo $postulantes['email'];
?>
            <a href="/php/gauchada/elegirpostu.php?po=<?php echo $postulantes['id_usuario']; ?>&gau=<?php echo $gaid; ?>" >Elegir</a>
<?php
        }
?>
        </div>
<?php
    }
    else {
?>      <div id='dueño'>
            <a href="/php/gauchada/preguntar.php?usid=<?php echo $_SESSION['usuario'] ?>&gaid=<?php echo $gaid ?>" >Preguntar</a>
<?php
            $usuario= $_SESSION['usuario'];
            $consulta3 = "SELECT COUNT(*) FROM postulantes WHERE idgauchada='$gaid' AND idusuario='$usuario'";
            $resultado3= mysqli_query($conexion, $consulta3);
            $postulado= mysqli_fetch_row($resultado3);
            if($postulado[0] == 0) {
?>
                <form action='/php/gauchada/postularce.php' method='POST'>
                    <input type='hidden' name='userid' value="<?php echo $_SESSION['usuario'] ?>">
                    <input type='hidden' name='gauchadaid' value="<?php echo $gaid ?>">
                    <input type='submit' value='Postularce'>
                </form>
<?php
            }
?>    
        </div>
<?php
    }

?>
    <div id='gautitulo'><?php echo $gauchada['titulo']; ?></div>
    <div id='gauusuario'>De: <?php echo $gauchada['email']; ?></div>
    <div id='gaucategoria'>Categoria: <?php echo $gauchada['categoria']; ?></div>
    <div id='gauciudad'>En: <?php echo $gauchada['ciudad']; ?></div>
    <div id='gaudescripcion'><?php echo $gauchada['descripcion']; ?></div>
    <div id="gauimagen">
        <img height="240px" src="data:<?php echo $gauchada['extension']; ?>;base64,<?php echo base64_encode($gauchada['foto']);?>"/>
<?php
        if(!empty($gauchada['foto2'])) {
?>
            <img height="240px" src="data:<?php echo $gauchada['extension2']; ?>;base64,<?php echo base64_encode($gauchada['foto2']);?>"/>
<?php
        }
        if(!empty($gauchada['foto3'])) {
?>  
            <img height="240px" src="data:<?php echo $gauchada['extension3']; ?>;base64,<?php echo base64_encode($gauchada['foto3']);?>"/>
<?php
        }
?>
    </div>
    <div id="preguntas"><label>Preguntas:</label>
<?php
        $listarpreguntas= "SELECT * FROM comentarios P INNER JOIN usuarios U WHERE P.idgauchada='$gaid' AND P.idusuario=U.id_usuario";
        $resulpreguntas= mysqli_query($conexion, $listarpreguntas);

        while ($pregun = mysqli_fetch_array($resulpreguntas)) {
?>
            <div id='pregunta'>
                </br>
                <hr />
                <div id='pregusuario'>De: <?php echo $pregun['email']; ?></div>
                <div id='pregpregunta'><?php echo $pregun['pregunta']; ?></div>
<?php
                if (isset($_SESSION['usuario']) && $_SESSION['usuario']== $gauchada['idusuario']){
?>                  <div id='responder'><a href="" >Responder</a></div>
<?php
                }
?>
            </div>
            <br>
<?php     
        }

?>


    </div>
</body>
</html>