<html>
	<head>
		<meta charset="UTF-8">
		<title>Calificar</title>
        <link rel="stylesheet" href="/css/calificar.css" type="text/css">
	</head>	
	<body>

<?php 
        include("../menu.php"); 

		if(!isset($_SESSION['usuario'])){
?> 
<?php   
	    }
	    else {
	    	$postuid= $_GET['po'];
	    	$gaid= $_GET['gau'];

	    	$gauchada= "SELECT * FROM gauchadas WHERE id_gauchada='$gaid'";
            $postu= "SELECT * FROM usuarios WHERE id_usuario='$postuid'";
        	$consulta= mysqli_query($conexion, $gauchada);
            $consulta2= mysqli_query($conexion, $postu);
        	$gauch = mysqli_fetch_assoc($consulta);
            $postulante = mysqli_fetch_assoc($consulta2);
	    }
?>
		<div id='formu'><form action="/php/gauchada/enviarcalificacion.php" method="POST" class="calificacion" >
			<div id="titulo"><h5><?php echo $gauch['titulo']; ?></h5></div>
            <div id="postulante">Usted esta calificando a: <?php echo $postulante['apellido']; echo $postulante['nombre']; ?></div>
			<input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
            <input type="hidden" name="postuid" value="<?php echo $postuid; ?>">
            <select name="calificacion" id="calificacion" value="" required>
                <option disabled selected hidden value="">Calificacion</option>
                <option value="positivo">Positivo</option>
                <option value="neutral">Neutral</option>
                <option value="negativo">Negativo</option>
            </select>
			<div id="justificacion"><textarea class="textarea" MAXLENGTH="300" name='justificacion' placeholder="Justifique su calificacion*" required rows="12" cols="50"></textarea></div>
			<div id="enviar"><input type="submit" name="Responder" value="Enviar"></div>
		</form></div>
        
	</body>	
</html>	