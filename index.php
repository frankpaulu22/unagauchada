<html>
	<head>
		<meta charset="UTF-8">
		<title>Gauchadas</title>
        <link rel="stylesheet" href="/css/index.css">
	</head>	
	<body>

        <?php 
            include("php/menu.php"); 
            $caducidad= date("Y-m-d");
            
            if ( isset($_SESSION['estado']) && $_SESSION['estado'] == 'logeado' && isset($_SESSION['usuario'])){
                ?><div id='publicar'><a href="php/gauchada/nueva.php?usid=<?php echo $varuser['id_usuario']; ?>" >Publicar</a></div><?php
            }

            if(isset($_POST['activo'])){
                if(!empty($_POST['buscar'])){
                    $buscar= $_POST['buscar'];
                    $filtitulo=" AND G.titulo LIKE '%$buscar%' OR G.titulo LIKE '$buscar%' OR G.titulo LIKE '%$buscar'";
                } 
                else{
                    $filtitulo="";
                }
                if(isset($_POST['ciudad'])){
                    $filciu= $_POST['ciudad'];
                    $filciudad=" AND Ci.id_ciudad=$filciu";
                } 
                else{
                    $filciudad="";
                }
                if(isset($_POST['provincia'])){
                    $filprov= $_POST['provincia'];
                    $filprovincia=" AND Ci.idprovincia=$filprov";
                } 
                else{
                    $filprovincia="";
                }
                if(isset($_POST['categoria'])){
                    $filcat= $_POST['categoria'];
                    $filcategoria=" AND C.id_categoria=$filcat";
                } 
                else{
                    $filcategoria="";
                }

                $filtrado= $filprovincia.$filciudad.$filcategoria.$filtitulo;

            }
            else {
                $filtrado='';
            }


            $consulta = "SELECT * FROM gauchadas G INNER JOIN categorias C ON G.idcategoria=C.id_categoria INNER JOIN usuarios U ON G.idusuario=U.id_usuario INNER JOIN ciudades Ci ON G.idciudad=Ci.id_ciudad WHERE G.expiracion >= '$caducidad' AND G.borrada = 0 AND G.idpostulante = 0 $filtrado ORDER BY cantpostulantes, id_gauchada DESC";
            $resultado = mysqli_query($conexion, $consulta);

?>
            <div id="filtro">
                <form action='/index.php' method='POST' enctype="multipart/form-data">
                    <select name="categoria" id="categoria" value="" onchange="this.form.submit()">
                        <?php
                            $consulcate = 'SELECT * FROM categorias';
                            $rescate = mysqli_query($conexion, $consulcate);
                            if(isset($_POST['categoria'])) {
                                $valorcate = "SELECT * FROM categorias WHERE id_categoria= '$filcat'";
                                $resvalorcate = mysqli_query($conexion, $valorcate);
                                $mostrarcate = mysqli_fetch_array($resvalorcate);
?> 
                                <option selected hidden value="<?php echo $mostrarcate[0]; ?>"><?php echo $mostrarcate[1]; ?> </option>
<?php
                            }
                            else {
?> 
                                <option disabled selected hidden value="">Categoria</option>
<?php
                            }

                        while ($arrcate = mysqli_fetch_array($rescate)){
                        ?>
                        <option value=" <?php echo $arrcate['id_categoria'] ?> " >
                        <?php echo $arrcate['categoria']; ?>
                        </option>

                        <?php
                        }    
                        ?>       
                    </select>

                    <select name="provincia" id="provincia" value="" onchange="this.form.submit()">
                        <?php
                            $consulprov = 'SELECT * FROM provincias';
                            $resprov = mysqli_query($conexion, $consulprov);
                        ?>
<?php 
                            if(isset($_POST['provincia'])) {
                                $valorprov = "SELECT * FROM provincias WHERE id_provincia= '$filprov'";
                                $resvalorprov = mysqli_query($conexion, $valorprov);
                                $mostrarprov = mysqli_fetch_array($resvalorprov);
?> 
                                <option selected hidden value="<?php echo $mostrarprov[0]; ?>"><?php echo $mostrarprov[1]; ?> </option>
<?php
                            }
                            else {
?> 
                                <option disabled selected hidden value="">Provincia</option>
<?php
                            }

                        while ($arrprov = mysqli_fetch_array($resprov)){
                        ?>
                        <option value=" <?php echo $arrprov['id_provincia'] ?> " >
                        <?php echo $arrprov['provincia']; ?>
                        </option>

                        <?php
                        }    
                        ?>       
                    </select>

                    <select name="ciudad" id="ciudad" value="" onchange="this.form.submit()">
                        <?php
                            $idprovi= $_POST['provincia'];
                            $consulciu = "SELECT * FROM ciudades WHERE idprovincia= '$idprovi'";
                            $resciu = mysqli_query($conexion, $consulciu);
                        ?>
<?php 
                            if(isset($_POST['ciudad'])) {
                                $valorciu = "SELECT * FROM ciudades WHERE id_ciudad= '$filciu' AND idprovincia= '$idprovi'";
                                $resvalorciu = mysqli_query($conexion, $valorciu);
                                $cantitate= mysqli_num_rows($resvalorciu);
                                $mostrarciu = mysqli_fetch_array($resvalorciu);

                                if($cantitate < 1){
                                    ?>
                                    <option selected hidden value="<?php echo $_POST['ciudad']; ?>">Ciudad</option>
                                    <?php
                                }
                                else {
                                    ?>
                                    <option selected hidden value="<?php echo $mostrarciu[0]; ?>"><?php echo $mostrarciu[2]; ?> </option>
                                    <?php
                                }
                            }
                            else {
?> 
                                <option disabled selected hidden value="">Ciudad</option>
<?php
                            }

                        while ($arrciu = mysqli_fetch_array($resciu)){
                        ?>
                        <option value=" <?php echo $arrciu['id_ciudad'] ?> " >
                        <?php echo $arrciu['ciudad']; ?>
                        </option>

                        <?php
                        }    
                        ?>       
                    </select>
                    <input type='text' maxlength="30" name="buscar" value="<?php
                    if(!empty($_POST['buscar'])){
                        echo $_POST['buscar'];
                    }
                    else {
                        echo '';
                    }
?>" placeholder="Titulo">
                    <input type='text' maxlength="3" name="activo" value="yes" hidden="hidden">
                    <input type='submit' value='Filtrar'>
                    <input type="button" onclick="location.href='/index.php';" value="Borrar" />
                </form>
            </div>

            <div id='listado'>
            <?php
            $contar = mysqli_num_rows($resultado);
            if($contar == 0) {
                echo "<h1>No se encontraron gauchadas con esas caracteristicas</h1>";
            }
            while ($lista = mysqli_fetch_array($resultado)) {
                ?>
                <div id='elemento'>
                    <div id='eletitulo'><?php echo $lista['titulo']; ?></div>
                    <div id='elecategoria'>Categoria: <?php echo $lista['categoria']; ?></div>
                    <div id='eleciudad'>En: <?php echo $lista['ciudad']; ?></div>
                    <div id='eledescripcion'><?php echo $lista['descripcion']; ?></div>
                    <div id="eleimagen"><img height="240px" src="data:<?php echo $lista['extension']; ?>;base64,<?php echo base64_encode($lista['foto1']); ?>"/></div><?php
                    if (isset($_SESSION['estado']) && $_SESSION['estado']== 'logeado'){
                            ?><div id='eledetalle'><a href="php/gauchada/detalle.php?ga=<?php echo $lista['id_gauchada']; ?>&preg=" >Detalle</a></div><?php
                    }
                ?>
                </div>
                <?php     
            }

            ?>
            </div>
            <?php
                
        ?>
        
	</body>	
</html>	