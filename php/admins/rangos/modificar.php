<head>
  <meta charset="utf-8">
  <title>Modificar</title>
  <script src="/js/validaciones.js"></script>
</head>
<body>
<?php 
	include("../../menu.php");
	if(!isset($_SESSION['admin'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php   
    }

    $rangoid= $_GET['id'];

    $select= "SELECT * FROM rangos WHERE id_rango= '$rangoid'";
    $consulta= mysqli_query($conexion, $select);

    $rango= mysqli_fetch_assoc($consulta);

?>


	<form action='/php/admins/rangos/enviarmodificacion.php' method='POST' onsubmit="return puntuacion();" class="publicar">
		<h1>Complete los datos del rango</h1>
		<h5>Los campos con un * son obligatorios</h5>
		<input type='hidden' name='id'  value='<?php echo $rangoid ?>' >
		<input type='text' name='nombre' MAXLENGTH="20" value="<?php echo $rango['nombre']; ?>" required>
		<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="puninicial" name='puninicial' maxlength="5" value="<?php echo $rango['min']; ?>" required>
		<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="punfinal" name='punfinal' maxlength="5" value="<?php echo $rango['max']; ?>" required>
	    <input type='submit' value='Modificar'>
	    <input onClick="window.location.href='/php/admins/rangos.php'"  type='reset' value='Cancelar'>
	</form>


</body>
</html>