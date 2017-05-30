<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php 
	}
	session_unset();
	session_destroy();
?>
    <script>
        alert('Sesion cerrada');
        window.location.href='/index.php';
    </script>
