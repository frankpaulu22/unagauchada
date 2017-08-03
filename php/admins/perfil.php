<html>
<?php
    include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>Perfil</title>
  <link rel="stylesheet" href="/css/perfil.css">
</head>
<body>
    
    <?php 
    if (isset($_SESSION['admin'])){

      $otrouser= $_GET['usid'];
      ?>
      
      <?php     
      $admin = "SELECT * FROM admins  WHERE id_admin='$otrouser'";
      
      $resultado = mysqli_query($conexion, $admin);
      
      $administrador = mysqli_fetch_assoc($resultado);
      
      ?>
      
      <div id='perfil'>Perfil:
          <div>Email:<?php echo $administrador['email']; ?></div>
          <div>Nombre:<?php echo $administrador['nombre']; ?></div>
          <div>Apellido:<?php echo $administrador['apellido']; ?></div>
      </div>

      <div id="menucito">
        <li><a href="/php/admins/rangos.php">Reputaciones</a></li>
        <li><a href="/php/admins/categorias.php">Categorias</a></li>
        <li><a href="/php/admins/usuarios.php">Usuarios</a></li>
      </div>
<?php
    }
?>

</body>
</html>