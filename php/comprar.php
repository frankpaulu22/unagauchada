<html>
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
		<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="numtarjeta" name='numtarjeta' minlength="16" maxlength="16" placeholder='Numero de tarjeta*' required>
        <h4>Codigo de seguridad:</h4>
		<input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="codtarjeta" name='codtarjeta' minlength="3" maxlength="4" placeholder='Codigo de seguridad*' required>
        <h4>Fecha de Vencimiento:</h4>
		<select id="idmodelo" name="mes" required> 
            <option value>mes*</option> ==$0
            <option value="1">01</option> 
            <option value="2">02</option> 
            <option value="3">03</option> 
            <option value="4">04</option> 
            <option value="5">05</option> 
            <option value="6">06</option>
            <option value="7">07</option> 
            <option value="8">08</option> 
            <option value="9">09</option> 
            <option value="10">10</option> 
            <option value="11">11</option> 
            <option value="12">12</option>
        </select>  
        <select id="idmodelo" name="anio" required > 
            <option value>año*</option> ==$0
            <option value="2017">2017</option> 
            <option value="2018">2018</option> 
            <option value="2017">2019</option> 
            <option value="2017">2020</option> 
            <option value="2017">2021</option> 
            <option value="2017">2022</option>
            <option value="2017">2023</option> 
            <option value="2017">2024</option> 
            <option value="2017">2025</option> 
            <option value="2017">2026</option> 
            <option value="2017">2027</option>  
        </select>  
        <p> <br/></p>
        <h4>Cantidad de creditos:</h4>
	    <input type='number' min="1" oninput="return calcularcreditos();" id="cantcredi" name='cantcredi' placeholder='1*' required>
	    <h4>Total a pagar: </h4><input type='text' id="total" readonly="readonly" name='total'>
        <h5>Los campos con un * son obligatorios</h5>
	    <input type='submit' value='Comprar'>
	    <input type='reset' value='Cancelar'>
	</form>

</body>
</html>