<html>
	<head>
		<meta charset="UTF-8">
		<title>Calificar</title>
        <link rel="stylesheet" href="/css/calificar.css">
	</head>	
	<body>

<?php 
        include("../menu.php"); 

		if(!isset($_SESSION['usuario'])){
?> 
	    	<script>
	            window.location.href='/index.php';
	        </script> 
<?php   
	    }
	    else {
	    	$postuid= $_GET['po'];
	    	$gaid= $_GET['gau'];

	    	$gauchada= "SELECT * FROM gauchadas WHERE id_gauchada='$gaid'";
        	$consulta= mysqli_query($conexion, $gauchada);
        	$gauch = mysqli_fetch_assoc($consulta);
	    }
?>
		<form action="/php/gauchada/enviarcalificacion.php" method="POST" class="calificacion" >
			<div id="descripcion"><h5><?php echo $gauch['descripcion']; ?></h5></div>
			<input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
            <input type="hidden" name="postuid" value="<?php echo $postuid; ?>">
            <input type="image" name="pos" src="/img/pos.png" >
            <input type="image" name="neut" src="/img/neut.png" >
            <input type="image" name="neg" src="/img/neg.png" >
			<textarea class="textarea" MAXLENGTH="300" name='justificacion' placeholder="Justifique su calificacion*" required></textarea>
			<input type="submit" name="Responder">
            <input type='reset' value='Cancelar'>
		</form>
        
	</body>	
</html>	