<?php
	if(isset($_POST['cantcredi'])){
		include('conexion.php');

		$usrid= $_POST['userid'];
		$cantcredi = $_POST['cantcredi'];

		$update = "UPDATE usuarios SET creditos= creditos + $cantcredi WHERE id_usuario=$usrid";
	    $updcreditos = mysqli_query($conexion, $update) or die ('Problemas en la consulta'. mysql_error());

?>   
	    <script>
	        alert('Transaccion exitosa');
	        window.location.href='/index.php';
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