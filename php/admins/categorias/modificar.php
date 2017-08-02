<head>
  <meta charset="utf-8">
  <title>Modificar</title>
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

    $cateid= $_GET['id'];

    $select= "SELECT * FROM categorias WHERE id_categoria= '$cateid'";
    $consulta= mysqli_query($conexion, $select);

    $categoria= mysqli_fetch_assoc($consulta);

?>

	<form action='/php/admins/categorias/enviarmodificacion.php' method='POST' class="publicar">
		<h1>Introduzca el nombre de la categoria</h1>
		<h5>Los campos con un * son obligatorios</h5>
		<input type='hidden' name='id'  value='<?php echo $cateid ?>' >
		<input type='text' name='nombre' MAXLENGTH="20" value="<?php echo $categoria['categoria'] ?>" required>
	    <input type='submit' value='Modificar'>
	    <input onClick="window.location.href='/php/admins/categorias.php'" type='reset' value='Cancelar'>
	</form>

</body>
</html>