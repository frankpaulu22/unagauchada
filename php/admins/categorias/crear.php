<head>
  <meta charset="utf-8">
  <title>Nueva</title>
  <script src="/js/validaciones.js"></script>
</head>
<body>
<?php 
	include("../../menu.php");
	if(!isset($_SESSION['admin'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php   
    } 
?>

	<form action='/php/admins/categorias/enviarnueva.php' method='POST' class="publicar">
		<h1>Introduzca el nombre de la categoria</h1>
		<h5>Los campos con un * son obligatorios</h5>
		<input type='text' name='nombre' MAXLENGTH="20" placeholder='Nombre*' required>
	    <input type='submit' value='Crear'>
	    <input type='reset' value='Cancelar'>
	</form>


</body>
</html>