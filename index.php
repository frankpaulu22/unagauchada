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
            
            if ( isset($_SESSION['estado']) && $_SESSION['estado'] == 'logeado'){
                ?><div id='publicar'><a href="php/gauchada/nueva.php?usid=<?php echo $varuser['id_usuario']; ?>" >Publicar</a></div><?php
            }
?>
            <div id="filtro">
                <form action='/index.php' method='POST' enctype="multipart/form-data">
                    <select name="categoria" id="categoria" value="">
                        <?php
                            $consulcate = 'SELECT * FROM categorias';
                            $rescate = mysqli_query($conexion, $consulcate);
                        ?>
                        <option disabled selected hidden value="">Categoria</option>
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
                        <option disabled selected hidden value="">Ciudad</option>
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
                    <input type='text' maxlength="30" name="buscar" value="" placeholder="Titulo">
                    <input type='text' maxlength="3" name="activo" value="yes" hidden="hidden">
                    <input type='submit' value='Filtrar'>
                    <input type='reset' value='Borrar'>
                </form>
            </div>
<?php
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
                if(isset($_POST['categoria'])){
                    $filcat= $_POST['categoria'];
                    $filcategoria=" AND C.id_categoria=$filcat";
                } 
                else{
                    $filcategoria="";
                }

                $filtrado= $filciudad.$filcategoria.$filtitulo;

            }
            else {
                $filtrado='';
            }


            $consulta = "SELECT * FROM gauchadas G INNER JOIN categorias C ON G.idcategoria=C.id_categoria INNER JOIN usuarios U ON G.idusuario=U.id_usuario INNER JOIN ciudades Ci ON G.idciudad=Ci.id_ciudad WHERE G.expiracion < '$caducidad' AND G.idpostulante = 0 $filtrado ORDER BY cantpostulantes, id_gauchada DESC";
            $resultado = mysqli_query($conexion, $consulta);

            ?>
            <div id='listado'>
            <?php

            while ($lista = mysqli_fetch_array($resultado)) {
                ?>
                <div id='elemento'>
                    <div id='eletitulo'><?php echo $lista['titulo']; ?></div>
                    <div id='elecategoria'>Categoria: <?php echo $lista['categoria']; ?></div>
                    <div id='eleciudad'>En: <?php echo $lista['ciudad']; ?></div>
                    <div id='eledescripcion'><?php echo $lista['descripcion']; ?></div>
                    <div id="eleimagen"><img height="240px" src="data:<?php echo $lista['extension']; ?>;base64,<?php echo base64_encode($lista['foto']); ?>"/></div><?php
                    if (isset($_SESSION['estado']) && $_SESSION['estado']== 'logeado'){
                        ?><div id='eledetalle'><a href="php/gauchada/detalle.php?ga=<?php echo $lista['id_gauchada']; ?>" >Detalle</a></div><?php
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