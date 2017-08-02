<head>
  <meta charset="utf-8">
  <title>Nueva</title>
  <script src="/js/validaciones.js"></script>
</head>
<body>
<?php 
	include("../menu.php");
	if(!isset($_SESSION['admin'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php   
    } 
    if(isset($_POST['fecha1'])){
    	$total= 0;
    	$fecha1= $_POST['fecha1'];
    	$fecha2= $_POST['fecha2'];

    	$select= "SELECT * FROM compras WHERE fecha >= '$fecha1' AND fecha <= '$fecha2'";
    	$consulta= mysqli_query($conexion, $select);

    	while($canti= mysqli_fetch_array($consulta)){
    		$cantidad= $canti['cantidad'];
    		$total= $total+ $cantidad;
    	}
    }
    else{
    	$fecha1= '';
    	$fecha2= '';
    }
?>

	<form action='/php/admins/ganancias.php' method='POST' onsubmit="return restarFechas('fecha1','fecha2');" class="publicar">
		<h1>Introduzca dos fechas para ver las ganancias entre ambas</h1>
		<input type="date" name="fecha1" max="2080-06-08" id="fecha1" value="<?php echo $fecha1; ?>" required>
		<input type="date" name="fecha2" max="2080-06-08" id="fecha2" value="<?php echo $fecha2; ?>" required>
<?php
		if(isset($_POST['fecha1'])){
?>
			<label>Total entre fechas: </label><input type='text' value="<?php echo '$'.$total ?>" name='total'>
<?php
		}
?>
	    <input type='submit' value='Consultar'>
	    <input onClick="window.location.href='/index.php'" type='reset' value='Cancelar'>
	</form>

</body>
</html>