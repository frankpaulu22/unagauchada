<?php
	if(isset($_POST['userid'])){
		include('../conexion.php');
		$usrid= $_POST['userid'];
		$gaid= $_POST['gauchadaid'];
		$uno= '1';

		$insertar= "INSERT INTO postulantes(idgauchada, idusuario) VALUES ('$gaid', '$usrid')";
		$resultado = mysqli_query($conexion, $insertar) or die ('Problemas en la consulta'. mysql_error());

		$aumentar= "UPDATE gauchadas SET cantpostulantes= cantpostulantes + '$uno' WHERE id_gauchada=$gaid";
		$update = mysqli_query($conexion, $aumentar) or die ('Problemas en la consulta'. mysql_error());

?>   
	    <script>
	    	var gauid= <?php echo $gaid ?>;
	        alert('Se ha postulado con exito');
	        window.location.href='/php/gauchada/detalle.php?ga='+gauid;
	    </script>      
<?php
	}
    else {
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php   
    }   