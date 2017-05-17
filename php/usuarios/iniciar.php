<script src="/js/validarlogin.js"></script>
<form action='/php/usuarios/session.php' method='POST' class='login' onsubmit="return validarlogin();">
    <input type='text' id="usuario" name='usuario' placeholder='Usuario*'>
    <input type='password' id="clave" name='clave' placeholder='Contraseña*'>
    <input type='submit' value='Ingresar'>
</form>