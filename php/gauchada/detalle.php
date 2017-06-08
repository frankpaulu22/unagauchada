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
    $consulta2 = "SELECT COUNT(idusuario) FROM postulantes WHERE idgauchada='$gaid'";
    $resultado2= mysqli_query($conexion, $consulta2);
    $postulantes = mysqli_fetch_row($resultado2);
    if (isset($_SESSION['usuario']) && $_SESSION['usuario']== $gauchada['idusuario']){
?>		<div id='dueño'><a href="" >Soy el dueño</a></div>
        <div id='gaupostulantes'>Postulantes: <?php echo $postulantes[0] ; ?>
    </div>	
<?php
    }
    else {
?>      <div id='dueño'><a href="" >Preguntar</a></div>
<?php
    }

?>
    <div id='gautitulo'><?php echo $gauchada['titulo']; ?></div>
    <div id='gauusuario'>De: <?php echo $gauchada['email']; ?></div>
    <div id='gaucategoria'>Categoria: <?php echo $gauchada['categoria']; ?></div>
    <div id='gauciudad'>En: <?php echo $gauchada['ciudad']; ?></div>
    <div id='gaudescripcion'><?php echo $gauchada['descripcion']; ?></div>
    <div id="gauimagen"><img height="240px" src="data:<?php echo $gauchada['extension']; ?>;base64,<?php echo base64_encode($gauchada['foto']); ?>"/></div>
    <div id="preguntas"><label>Preguntas</label>
<?php
        $listarpreguntas= "SELECT * FROM preguntas P INNER JOIN usuarios U WHERE P.idgauchada='$gaid' AND P.idusuario=U.id_usuario";
        $resulpreguntas= mysqli_query($conexion, $listarpreguntas);

        while ($pregun = mysqli_fetch_array($resulpreguntas)) {
?>
            <div id='pregunta'>
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