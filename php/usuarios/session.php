<?php
    if (isset($_POST['usuario'])){
    	include('../conexion.php');
    	$usuario=$_POST['usuario'];
    	$clave=$_POST['clave'];
        $consulta1 = "SELECT * FROM admins WHERE email='$usuario' AND clave='$clave' AND estado='0'";
        $registro1 = mysqli_query($conexion, $consulta1);

        if ($admin=mysqli_fetch_array($registro1)){
            session_start();
            $_SESSION['estado'] = 'logeado';
            $_SESSION['admin'] = $admin['id_admin'];
        ?>
            <script>
                alert('Admin logeado');
                window.location.href='/index.php';
            </script>
        <?php
        }
        else{

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
            else if($usr['baneado'] == 1) {
    ?>
                <script>
                    alert('Usuario baneado');
                    window.location.href='/index.php';
                </script>
    <?php   }
            else if($usr['baneado'] == 2) {
    ?>
                <script>
                    alert('Usuario dado de baja');
                    window.location.href='/index.php';
                </script>
    <?php   }
            else {
                session_start();
                $_SESSION['estado'] = 'logeado';
                $_SESSION['usuario'] = $usr['id_usuario'];

    ?>
                <script>
                    alert('Usuario logeado');
                    window.location.href='/index.php';
                </script>
    <?php   }
        }
    }
    else {
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php   
    }