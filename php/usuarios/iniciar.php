<head>
  <meta charset="utf-8">
  <title>Login</title>
  <script src="/js/validaciones.js"></script>
</head>
<body>

<?php
	include("../menu.php");
?>

<form action='/php/usuarios/session.php' method='POST' class='login' onsubmit="return validaremail();">
	<h1>Complete los campos</h1>
	<h5>Los campos con un * son obligatorios</h5>
    <input type='email' maxlength="40" id="email" name='usuario' placeholder='Usuario*' required>
    <input type='password' maxlength="20" id="clave" name='clave' placeholder='Contraseña*' required>
    <input type='submit' value='Ingresar'>
    <input type='reset' value='Cancelar'>
</form>

<h6>.</h6>

</body>
</html>
