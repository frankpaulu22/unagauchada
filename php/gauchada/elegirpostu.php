<html>
<?php
	include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>FinElegir</title>
  <link rel="stylesheet" href="/css/detalle.css">
</head>
<body>

<?php
	include('../conexion.php');
	$posid= $_GET['po'];
    $gaid= $_GET['gau'];
    $userid= $_SESSION['usuario'];

	$select= "SELECT * FROM gauchadas WHERE id_gauchada='$gaid'";
	$resultado= mysqli_query($conexion, $select);
	$gauchada= mysqli_fetch_array($resultado);
	echo $gauchada['idpostulante'];


    if(!isset($_GET['gau']) or !isset($_GET['po']) or $gauchada['idpostulante'] != 0 ){
?> 
    	<script>
            window.location.href='/index.php';
        </script> 
<?php   
	}
	else {
?>
		<div id="finpostu">
<?php
	   		$consulta2 = "SELECT * FROM postulantes P INNER JOIN usuarios U WHERE P.idgauchada='$gaid' AND P.idusuario='$posid' AND P.idusuario=U.id_usuario";
	    	$resultado2= mysqli_query($conexion, $consulta2);
	    	$postulantes= mysqli_fetch_array($resultado2);
	            echo "</br>";
	            echo "A elegido a ";
	            echo $postulantes['apellido'];
                echo $postulantes['nombre'];
	            echo " para realizar la gauchada";
	            echo "</br>";
            	echo "<hr/>";
            	echo "Al acerlo rechazo a los siguientes usuarios:";
            	echo "</br>";

    			$consulta3 = "SELECT * FROM postulantes P INNER JOIN usuarios U WHERE P.idgauchada='$gaid' AND P.idusuario <> '$posid' AND P.idusuario=U.id_usuario";
    			$resultado3= mysqli_query($conexion, $consulta3);
 		        while($postulantes2= mysqli_fetch_array($resultado3)) {
        		    echo $postulantes['apellido'];
                    echo $postulantes['nombre'];
        		}


				$selecpostu = "UPDATE gauchadas SET idpostulante='$posid' WHERE id_gauchada='$gaid'";
				$consulta = mysqli_query($conexion, $selecpostu);
        
                $adeuda = "UPDATE usuarios SET adeuda='1' WHERE id_usuario='$userid'";
				$consulta = mysqli_query($conexion, $adeuda);
                
				echo "</br>";
				echo "</br>";
				echo "</br>";
?>
				<a href="javascript:window.close();">Listo</a> 
		</div>
<?php
	}
?>
</body>
</html>