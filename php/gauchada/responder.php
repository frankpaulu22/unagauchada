<html>
	<head>
		<meta charset="UTF-8">
		<title>Gauchadas</title>
        <link rel="stylesheet" href="/css/index.css">
	</head>	
	<body>

<?php 
        include("../menu.php"); 

		if(!isset($_SESSION['usuario']) or !isset($_GET['comid'])){
?> 
	    	<script>
	            window.location.href='/index.php';
	        </script> 
<?php   
	    }
	    else {
	    	$comid= $_GET['comid'];
	    	$gaid= $_GET['gaid'];

	    	$selecpregunta= "SELECT * FROM comentarios WHERE id_comentario='$comid'";
        	$consulta= mysqli_query($conexion, $selecpregunta);
        	$pregunta = mysqli_fetch_assoc($consulta);
	    }
?>
		<form action="/php/gauchada/enviarrespuesta.php" method="POST" class="pregunta" >
			<h5><?php echo $pregunta['pregunta']; ?></h5>
			<input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
			<textarea class="textarea" MAXLENGTH="300" name='respuesta' placeholder="Escriba aqui su respuesta*" required></textarea>
			<input type="submit" name="Responder">
		</form>
        
	</body>	
</html>	