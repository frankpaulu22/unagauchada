<html>
	<head>
		<meta charset="UTF-8">
		<title>Gauchadas</title>
        <link rel="stylesheet" href="/css/index.css">
	</head>	
	<body>
<?php
	include("../menu.php"); 
	$userid= $_GET['usid'];
	$gaid= $_GET['gaid'];
	if(!isset($_SESSION['usuario']) or !isset($_GET['gaid']) or $_SESSION['usuario'] != $_GET['usid']){
?> 
    	<script>
            window.location.href='/index.php';
        </script> 
<?php   
    }
?>
	<form action="/php/gauchada/enviarpregunta.php" method="POST" class="pregunta" >
		<h3>Escriba aqui su pregunta</h3>
		<h6>Este paso es obligatorio</h6>
		<input type="hidden" name="usid" value="<?php echo $userid; ?>">
		<input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
		<textarea class="textarea" MAXLENGTH="300" name='pregunta' required></textarea>
		<input type="submit" name="Enviar">

	</form>

        
	</body>	
</html>	