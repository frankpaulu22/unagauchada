<?php
	include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head>
<body>

<form action='/php/usuarios/enviarregistro.php' method='POST' class='formulario'>
	<h1>Complete el formulario</h1>
    <input type='text' maxlength="20" id="nombre" name='nombre' placeholder='Nombre*' required>
    <input type='text' maxlength="20" id="apellido" name='apellido' placeholder='Apellido*' required>
    <input type='email' maxlength="40" id="email" name='email' placeholder='Email*' required>
    <input type='password' maxlength="20" id="clave" name='clave' placeholder='Contraseña*' required>
    <input type="text" id="datepicker" name="fecha" placeholder="Fecha de nacimiento*" required>
    <input type='text' maxlength="15" id="telefono" name='telefono' placeholder='Telefono*' required>
    <input type='submit' value='Registrarse'>
    <input type='reset' value='Cancelar'>
</form>

<h6>.</h6>

</body>
</html>