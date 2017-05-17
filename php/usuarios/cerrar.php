<?php
	session_start();
	session_unset();
	session_destroy();
?>
    <script>
        alert('Sesion cerrada');
        window.location.href='/index.php';
    </script>
