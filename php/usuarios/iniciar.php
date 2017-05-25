<head>
  <meta charset="utf-8">
  <title>Login</title>
</head>
<body>

<?php
	include("../menu.php");
?>

<form action='/php/usuarios/session.php' method='POST' class='login'>
	<h1>Complete los campos</h1>
    <input type='email' id="usuario" name='usuario' placeholder='Usuario*' required>
    <input type='password' id="clave" name='clave' placeholder='Contraseña*' required>
    <input type='submit' value='Ingresar'>
    <input type='reset' value='Cancelar'>
</form>

<h6>.</h6>

</body>
</html>
