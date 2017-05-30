<html>
	<head>
		<meta charset="UTF-8">
		<title>Gauchadas</title>
        <link rel="stylesheet" href="/css/index.css">
	</head>	
	<body>

        <?php 
            include("php/menu.php"); 
            
            if ( isset($_SESSION['estado']) && $_SESSION['estado']== 'logeado'){
                ?><div id='publicar'><a href="php/gauchada/nueva.php?usid=<?php echo $varuser['id_usuario']; ?>" >Publicar</a></div><?php
            }

            $consulta = "SELECT * FROM gauchadas G INNER JOIN categorias C ON G.idcategoria=C.id_categoria INNER JOIN usuarios U ON G.idusuario=U.id_usuario INNER JOIN ciudades Ci ON G.idciudad=Ci.id_ciudad ORDER BY postulantes, id_gauchada DESC";
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