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
  <h5>Los campos con un * son obligatorios</h5>
    <input type='text' maxlength="20" id="nombre" name='nombre' placeholder='<?php echo $usuario['nombre']?>*' required>
    <input type='text' maxlength="20" id="apellido" name='apellido' placeholder='<?php echo $usuario['apellido']?>*' required>
    <input type='email' maxlength="40" id="email" name='email'  placeholder='<?php echo $usuario['email']?>*' required>
    <input type='password' maxlength="20" id="clave" name='clave' placeholder='clave nueva*' required>
    <label>Fecha de nacimiento*</label>
    <input type="date" name="fecha" max="2017-06-01" required placeholder="<?php echo $usuario['nacimiento']?>*">
    <input type='text' maxlength="15" id="telefono" name='telefono' placeholder='<?php echo $usuario['telefono']?>*' required>
    <input type='file' name='imagen' accept="image/png, image/jpg, image/jpeg">
    <h5>Confirma tu clave anterior antes de continuar</h5>
    <input type='password' maxlength="20" id="clave" name='claveold' placeholder='clave actual*' required>
    <input type='submit' value='Modificar'>
    <input type='reset' value='Cancelar'>
</form>

<h6>.</h6>

</body>
</html>