<head>
  <meta charset="utf-8">
  <title>Nuevo</title>
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
?>

	<form action='/php/admins/rangos/enviarrango.php' method='POST' onsubmit="return puntuacion();" class="publicar">
		<h1>Complete los datos del rango</h1>
		<h5>Los campos con un * son obligatorios</h5>
		<input type='text' name='nombre' MAXLENGTH="20" placeholder='Nombre*' required>
		<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="puninicial" name='puninicial' maxlength="5" placeholder='Puntaje inicial*' required>
		<input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="punfinal" name='punfinal' maxlength="5" placeholder='Puntaje final*' required>
	    <input type='submit' value='Crear'>
	    <input type='reset' onClick="window.location.href='/php/admins/rangos.php'" value='Cancelar'>
	</form>


</body>
</html>