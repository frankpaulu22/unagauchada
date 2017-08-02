<head>
  <meta charset="utf-8">
  <title>Publicar</title>
</head>
<body>
<?php 
	include("../conexion.php");
	include("../menu.php");
	$usrid = $_GET['usid'];
	if($usrid!=$_SESSION['usuario'] or !isset($_GET['usid'])){
?> 
        <script>
            window.location.href='/index.php';
        </script> 
<?php   
    } 
	$consulusuario = "SELECT * FROM usuarios WHERE id_usuario=$usrid";
	$resulusuario = mysqli_query($conexion, $consulusuario);	
	$cosasusuario = mysqli_fetch_assoc($resulusuario);

	if ($cosasusuario['creditos'] < 1 ){
	?>   
	    <script>
	        alert('No tiene creditos suficientes');
	        window.location.href='/php/comprar.php?usid=<?php echo $usrid; ?>';
	    </script>
    <?php
	}

	if ($cosasusuario['adeuda'] == 1 ){
	?>   
	    <script>
	        alert('Usted adeuda calificaciones');
	        window.location.href='/index.php';
	    </script>
    <?php
	}

?>

	<form action='/php/gauchada/enviarnueva.php' method='POST' enctype="multipart/form-data" class="publicar">
		<h1>Complete los datos</h1>
		<h5>Los campos con un * son obligatorios</h5>
		<input type='hidden' name='userid' value="<?php echo $usrid ?>">
		<input type='text' name='titulo' MAXLENGTH="30" placeholder='Titulo*' required>

	    <select name="categoria" id="categoria" value="" required>
	        <?php
	        	$consulcate = "SELECT * FROM categorias WHERE Disponible= 'Si'";
	        	$rescate = mysqli_query($conexion, $consulcate);
	        ?>
	        <option disabled selected hidden value="">Categoria*</option>
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
	        <option disabled selected hidden value="">Ciudad*</option>
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


	    <textarea class="textarea" MAXLENGTH="300" name='descripcion' placeholder="Descripcion*" required></textarea>
	    <label>Fecha de expiracion*</label>
	    <input type="date" name="expiracion" min="2017-06-08" max="2080-06-08" required>
	    <input type='file' name='imagen' accept="image/png, image/jpg, image/jpeg">
	    <input type='file' name='imagen2' accept="image/png, image/jpg, image/jpeg">
	    <input type='file' name='imagen3' accept="image/png, image/jpg, image/jpeg">
	    <input type='submit' value='Publicar'>
	    <input type='reset' value='Cancelar'>
	</form>


</body>
</html>