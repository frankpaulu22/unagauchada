<head>
    <script src="/js/validarlogin.js"></script>
    <script src="/js/query.js"></script>﻿
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/fontello.css">
    <link rel="icon" type="image/png" href="/img/logo.png" />
</head>
<header>
    <IMG class="banner" SRC="/img/ban1.jpg">
    <a href="/index.php"><IMG class="logo" SRC="/img/logo.png"></a>
    <input type="checkbox" id="btn-menu">
    <label for="btn-menu" class="icon-th-list"></label>
    <nav class="menu">
        <ul class= "accesos">
            <?php
                include('usuarios/claseuser.php');
                include('conexion.php');
                session_start();                
                
                if($_SESSION['estado']=='logeado'){ 
                    $userid = $_SESSION['usuario'];
                    $conuser = "SELECT * FROM usuarios WHERE id_usuario='$userid'";
                    $resuser = mysqli_query($conexion, $conuser);
                    $varuser= mysqli_fetch_assoc($resuser);

            ?>
                <li class='submenu'><a href="#"><?php echo $varuser['email']; ?></a>
                    <ul>
                        <li><a href="/php/usuarios/perfil.php">Perfil</a>
                        <li><a href="/php/usuarios/cerrar.php">Salir</a>    
                    </ul> 
                </li>  
                <li><a href="/php/comprar.php?usid=<?php echo $userid; ?>">Comprar Creditos</a></li> 
 
            <?php   }
                else { ?>
                    <li><a href="/php/usuarios/iniciar.php">Ingresar</a></li>
                    <li><a href="/php/usuarios/registro.php">Registrarse</a></li>  
            <?php  } 
            ?>       
        </ul>
    </nav>
</header>
<script src="/js/menu.js"></script>