<head>
  <meta charset="utf-8">
  <title>Publicar</title>
</head>
<body>
<?php 
	include("../conexion.php");
	include("../menu.php");
	$usrid = $_GET['usid']; 
	$consulcredi = "SELECT creditos FROM usuarios WHERE id_usuario=$usrid";
	$resulcredi = mysqli_query($conexion, $consulcredi);	
	$totcredi = mysqli_fetch_assoc($resulcredi);
	echo $totcredi['creditos'];

	if ($totcredi['creditos'] < 1 ){
	?>   
	    <script>
	        alert('No tiene creditos suficientes');
	        window.location.href='/php/comprar.php';
	    </script>
    <?php
	}

?>

	<form action='/php/gauchada/enviarnueva.php?usid=<?php echo $usrid ?>' method='POST' enctype="multipart/form-data" class="publicar">
		<h1>Complete los datos</h1>
		<input type='text' name='titulo' MAXLENGTH="30" placeholder='Titulo*' required>

	    <select name="categoria" id="categoria" value="" required>
	        <?php
	        	$consulcate = 'SELECT * FROM categorias';
	        	$rescate = mysqli_query($conexion, $consulcate);
	        ?>
	        <option disabled selected hidden>Categoria</option>
	        <?php    
	        while ($arrcate = mysqli_fetch_array($rescate)){
	        ?>
	        <option value=" <?php echo $arrcate['id_categoria'] ?> " >
	        <?php echo $arrcate['categoria']; ?>
	        </option>

	        <?php
	        }    
	        ?>       
	    </select>

	    <select name="ciudad" id="ciudad" value="" required>
	        <?php
	        	$consulciu = 'SELECT * FROM ciudades';
	        	$resciu = mysqli_query($conexion, $consulciu);
	        ?>
	        <option disabled selected hidden>Ciudad</option>
	        <?php    
	        while ($arrciu = mysqli_fetch_array($resciu)){
	        ?>
	        <option value=" <?php echo $arrciu['id_ciudad'] ?> " >
	        <?php echo $arrciu['ciudad']; ?>
	        </option>

	        <?php
	        }    
	        ?>       
	    </select>


	    <textarea class="textarea" MAXLENGTH="300" name='descripcion' placeholder="Descripcion" required></textarea>
	    <input type='file' name='imagen' placeholder='Imagen*' required>
	    <input type='submit' value='Publicar'>
	    <input type='reset' value='Cancelar'>
	</form>


</body>
</html>