<?php
	include('../conexion.php');
	$usuario=$_POST['usuario'];
	$clave=$_POST['clave'];
	$consulta = "SELECT * FROM usuarios WHERE email='$usuario' AND clave='$clave'";
	$registro = mysqli_query($conexion, $consulta);

                if (!$usr=mysqli_fetch_array($registro)){  
?>
                    <script>
                        alert('Usuario y/o clave incorrectos');
                        window.location.href='/php/usuarios/iniciar.php';
                    </script>
<?php
                }
                else {
                	session_start();
                    $_SESSION['estado'] = 'logeado';
                    $_SESSION['usuario'] = $usr['id_usuario'];

?>
                    <script>
                        alert('Usuario logeado');
                        window.location.href='/index.php';
                    </script>
        <?php   }   ?>