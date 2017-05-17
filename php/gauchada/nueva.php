<?php 
	include("../conexion.php");
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

	<form action='/php/gauchada/enviarnueva.php?usid=<?php echo $usrid ?>' method='POST' enctype="multipart/form-data">
		<input type='text' name='titulo' placeholder='Titulo*'>

	    <select name="categoria" id="categoria" value="">
	        <?php
	        	$consulcate = 'SELECT * FROM categorias';
	        	$rescate = mysqli_query($conexion, $consulcate);
	        ?>
	        <option>Categoria</option>
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

	    <select name="ciudad" id="ciudad" value="">
	        <?php
	        	$consulciu = 'SELECT * FROM ciudades';
	        	$resciu = mysqli_query($conexion, $consulciu);
	        ?>
	        <option>Ciudad</option>
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


	    <textarea rows='15' cols='15' name='descripcion'>Descripcion</textarea>
	    <input type='file' name='imagen' placeholder='Imagen*'>
	    <input type='submit' value='Publicar'>
	</form>