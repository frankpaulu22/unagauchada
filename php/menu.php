<head>
    <script src="/js/validarlogin.js"></script>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="icon" type="image/png" href="/img/logo.png" />
</head>
<header>
    <IMG class="banner" SRC="/img/ban1(new).jpg">
    <a href="/index.php"><IMG class="logo" SRC="/img/logo.png"></a>
    <nav class="menu">
        <ul class= "accesos">
            <?php
                include('conexion.php');
                session_start();                
                
                if(isset($_SESSION['estado']) && $_SESSION['estado']=='logeado'){
                    if(isset($_SESSION['usuario'])){ 
                        $userid = $_SESSION['usuario'];
                        $conuser = "SELECT * FROM usuarios WHERE id_usuario='$userid'";
                        $resuser = mysqli_query($conexion, $conuser);
                        $varuser= mysqli_fetch_assoc($resuser);

                ?>
                        <li class='submenu'><a href="/php/usuarios/miperfil.php"><?php echo $varuser['email']; ?></a>
                            <ul>
                                <li><a href="/php/usuarios/cerrar.php">Salir</a>    
                            </ul> 
                        </li>  
                        <li><a href="/php/comprar.php?usid=<?php echo $userid; ?>">Comprar Creditos</a></li> 
                <?php
                    }
                    else{
                        $userid = $_SESSION['admin'];
                        $conuser = "SELECT * FROM admins WHERE id_admin='$userid'";
                        $resuser = mysqli_query($conexion, $conuser);
                        $varuser= mysqli_fetch_assoc($resuser);

                ?>
                        <li class='submenu'><a href="/php/admins/perfil.php?usid=<?php echo $userid; ?>"><?php echo $varuser['email']; ?></a>
                            <ul>
                                <li><a href="/php/usuarios/cerrar.php">Salir</a>    
                            </ul> 
                        </li>  
                        <li><a href="/php/admins/ganancias.php">Ver Ganancias</a></li> 
                <?php                        
                    }
                }
                else { ?>
                    <li><a href="/php/usuarios/iniciar.php">Ingresar</a></li>
                    <li><a href="/php/usuarios/registro.php">Registrarse</a></li>  
            <?php  } 
            ?>       
        </ul>
    </nav>
</header>