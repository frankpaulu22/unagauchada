<?php
	if(isset($_POST['userid'])){
		include('../conexion.php');
		$usrid= $_POST['userid'];
		$gaid= $_POST['gauchadaid'];
		$uno= '1';

		$eliminar= "DELETE FROM postulantes WHERE idgauchada=$gaid AND idusuario=$usrid";
		$resultado = mysqli_query($conexion, $eliminar) or die ('Problemas en la consulta'. mysql_error());

		$restar= "UPDATE gauchadas SET cantpostulantes= cantpostulantes - '$uno' WHERE id_gauchada=$gaid";
		$update = mysqli_query($conexion, $restar) or die ('Problemas en la consulta'. mysql_error());

?>   
	    <script>
	        alert('Se ha despostulado con exito');
	        window.location.href='/php/gauchada/detalle.php?ga=<?php echo $gaid; ?>&preg=';
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