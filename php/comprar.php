<head>
  <meta charset="utf-8">
  <title>Comprar</title>
</head>
<body>

<?php 
	include("conexion.php");
	include("menu.php");
	$usrid = $_GET['usid']; 
	$consulcredi = "SELECT * FROM usuarios WHERE id_usuario=$usrid";
	$resulcredi = mysqli_query($conexion, $consulcredi);	
	$totcredi = mysqli_fetch_assoc($resulcredi);
?>
	<form action='/php/enviarcompra.php?usid=<?php echo $usrid ?>' method='POST' class="creditos">
		<h2>Creditos: <?php echo $totcredi['creditos']; ?> </h2>
		<input type='text' name='numtarjeta' placeholder='Numero de tarjeta*' required>
		<input type='text' name='vencimiento' placeholder='Fecha de vencimiento*' required>
		<input type='text' name='codigo' placeholder='Codigo de seguridad*' required>
	    <input type='text' name='cantcredi' placeholder='Cantidad de creditos*' required>
	    <input type='submit' value='Comprar'>
	    <input type='reset' value='Cancelar'>
	</form>

</body>
</html>