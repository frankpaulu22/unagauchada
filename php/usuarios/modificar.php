<?php
	include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>Modificar</title>
  <script src="/js/validaciones.js"></script>
</head>
<body>
<?php
    $user = "SELECT * FROM usuarios  WHERE id_usuario='$_SESSION[usuario]'";
    
    $resultado = mysqli_query($conexion, $user);
    
    $usuario = mysqli_fetch_assoc($resultado);
?>
<form action='/php/usuarios/enviarregistro.php' method='POST' class='formulario' onsubmit="return validaremail();" oninput="return validartelefono();">
	<h1>Complete el formulario</h1>
  <h5>Complete los campos que quiera modificar</h5>
    <label>Nombre</label>
    <input type='text' maxlength="20" id="nombre" name='nombre' value='<?php echo $usuario['nombre']?>' required>
    <label>Apellido</label>
    <input type='text' maxlength="20" id="apellido" name='apellido' value='<?php echo $usuario['apellido']?>' required>
    <input type='hidden' maxlength="40" id="email" name='email'  placeholder='<?php echo $usuario['email']?>' required>
    <label>Clave de seguridad</label>
    <input type='password' maxlength="20" id="clave" name='clave' value='<?php echo $usuario['clave']?>' required>
    <label>Fecha de nacimiento</label>
    <input type="date" name="fecha" max="2017-06-01"  value="<?php echo $usuario['nacimiento']?>">
    <label>Telefono</label>
    <input type='text' maxlength="15" id="telefono" name='telefono' value='<?php echo $usuario['telefono']?>' required>
    <label>Imagen de perfil</label>
    <input type='file' name='imagen' accept="image/png, image/jpg, image/jpeg">
    <h5>Confirma tu clave actual antes de continuar</h5>
    <input type='password' maxlength="20" id="clave" name='claveold' placeholder='clave actual*' required>
    <input type='submit' value='Modificar'>
    <input type='reset' value='Cancelar'>
</form>

<h6>.</h6>

</body>
</html>