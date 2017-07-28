<head>
  <meta charset="utf-8">
  <title>Modificar</title>
</head>
<body>
<?php
	include('../menu.php');

	$gauid= $_GET['gaid'];
	$usid= $_GET['usid'];
	$caducidad= date("Y-m-d");

	$consulta = "SELECT * FROM gauchadas g INNER JOIN categorias c INNER JOIN ciudades ci WHERE g.id_gauchada='$gauid' AND g.idcategoria=c.id_categoria AND g.idciudad=ci.id_ciudad";
    $resultado = mysqli_query($conexion, $consulta);
    $gauchada= mysqli_fetch_array($resultado);

    if($gauchada['cantpostulantes'] != 0) {
?>   
	    <script>
	        alert('Se enviara un email a los postulantes notificando la modificacion de la gauchada');
	    </script>
<?php
    }

    if($gauchada['expiracion'] < $caducidad) {
?>   
	    <script>
	        alert('No puede modificar esta gauchada');
	        window.location.href='/php/gauchada/detalle.php?ga=<?php echo $gauid; ?>&preg=';
	    </script>
<?php
    }
    else {
?>
		<form action='/php/gauchada/enviarmodigau.php' method='POST' enctype="multipart/form-data" class="publicar">
			<h1>Complete los datos</h1>
			<h5>Los campos con un * son obligatorios</h5>
			<input type='hidden' name='userid' value="<?php echo $usid ?>">
			<input type='hidden' name='gauid' value="<?php echo $gauid ?>">
			<input type='text' name='titulo' MAXLENGTH="30" value="<?php echo $gauchada['titulo']; ?>" required>

		    <select name="categoria" id="categoria" value="" required>
		        <?php
		        	$consulcate = "SELECT * FROM categorias WHERE Disponible= 'Si'";
		        	$rescate = mysqli_query($conexion, $consulcate);
		        ?>
		        <option selected hidden value="<?php echo $gauchada['idcategoria']; ?>"><?php echo $gauchada['categoria']; ?></option>
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
		        <option selected hidden value="<?php echo $gauchada['idciudad']; ?>"><?php echo $gauchada['ciudad']; ?></option>
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


		    <textarea class="textarea" MAXLENGTH="300" name='descripcion' required><?php echo $gauchada['descripcion']; ?></textarea>
		    <label>Fecha de expiracion*</label>
		    <input type="date" name="expiracion" min="2017-06-08" max="2080-06-08" value="<?php echo $gauchada['expiracion']; ?>" required>
		    <img height="80px" src="data:<?php echo $gauchada['extension1']; ?>;base64,<?php echo base64_encode($gauchada['foto1']);?>"/>
		    <input type='file' name='imagen' accept="image/png, image/jpg, image/jpeg">
<?php
        	if(!empty($gauchada['foto2'])) {
?>
            	<img height="80px" src="data:<?php echo $gauchada['extension2']; ?>;base64,<?php echo base64_encode($gauchada['foto2']);?>"/>
<?php
			}
?>
		    <input type='file' name='imagen2' accept="image/png, image/jpg, image/jpeg">
<?php
        	if(!empty($gauchada['foto3'])) {
?>
            	<img height="80px" src="data:<?php echo $gauchada['extension3']; ?>;base64,<?php echo base64_encode($gauchada['foto3']);?>"/>
<?php
			}
?>

		    <input type='file' name='imagen3' accept="image/png, image/jpg, image/jpeg">
		    <input type='submit' value='Modificar'>
		    <input type='reset' value='Cancelar'>
		</form>

<?php
	}
?>
</body>
</html>