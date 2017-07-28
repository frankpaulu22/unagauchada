<?php
	if(isset($_POST['cantcredi'])){
		include('conexion.php');
		$fecha= date("Y-m-d");
		$usrid= $_POST['userid'];
		$cantcredi = $_POST['cantcredi'];
		$valor= 50 * $cantcredi;

		$update = "UPDATE usuarios SET creditos= creditos + $cantcredi WHERE id_usuario=$usrid";
	    $updcreditos = mysqli_query($conexion, $update) or die ('Problemas en la consulta'. mysql_error());

	    $insert = "INSERT INTO compras(cantidad, fecha) VALUES ('$valor', '$fecha')";
	    $consulta = mysqli_query($conexion, $insert) or die ('Problemas en la consulta'. mysql_error());

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