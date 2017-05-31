<head>
  <meta charset="utf-8">
  <title>Comprar</title>
  <script src="/js/validaciones.js"></script>
</head>
<body>

<?php 
	include("conexion.php");
	include("menu.php");
	$usrid = $_GET['usid']; 
	if($usrid!=$_SESSION['usuario'] or !isset($_GET['usid'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php   
    }
	$consulcredi = "SELECT * FROM usuarios WHERE id_usuario=$usrid";
	$resulcredi = mysqli_query($conexion, $consulcredi);	
	$totcredi = mysqli_fetch_assoc($resulcredi);
?>
	<form action='/php/enviarcompra.php' method='POST' class="creditos" oninput="return validarnumero();">
		<h2>Creditos: <?php echo $totcredi['creditos']; ?> </h2>
		<h4>Valor del credito: $50</h4>
		<input type='hidden' name='userid' value="<?php echo $usrid ?>">
		<input type='text' id="numtarjeta" name='numtarjeta' minlength="16" maxlength="16" placeholder='Numero de tarjeta*' required>
		<input type='date' min="2017-06-01" max="2200-06-01" name='vencimiento' placeholder='Fecha de vencimiento*' required>
		<input type='text' id="codigo" name='codigo' minlength="4" maxlength="4" placeholder='Codigo de seguridad*' required>
	    <input type='number' min="1" oninput="return calcularcreditos();" id="cantcredi" name='cantcredi' placeholder='Cantidad de creditos*' required>
	    <h4>Total a pagar: </h4><input type='text' id="total" readonly="readonly" name='total'>
        <h5>Los campos con un * son obligatorios</h5>
	    <input type='submit' value='Comprar'>
	    <input type='reset' value='Cancelar'>
	</form>

</body>
</html>