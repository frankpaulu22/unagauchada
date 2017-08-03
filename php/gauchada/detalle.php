<html>
<?php
    include("../menu.php");
?>

<head>
  <meta charset="utf-8">
  <title>Detalle</title>
  <link rel="stylesheet" href="/css/detalle.css">
</head>
<body>

<?php
    $gaid= $_GET['ga'];
    if(!isset($_SESSION['usuario']) or !isset($_GET['ga'])){
        if(!isset($_SESSION['admin'])){
?> 
            <script>
                window.location.href='/index.php';
            </script> 
<?php   
        }
    }
    $caducidad= date("Y-m-d");
    $consulta = "SELECT * FROM gauchadas G INNER JOIN categorias C ON G.idcategoria=C.id_categoria INNER JOIN usuarios U ON G.idusuario=U.id_usuario INNER JOIN ciudades Ci ON G.idciudad=Ci.id_ciudad WHERE id_gauchada='$gaid'";
    $resultado = mysqli_query($conexion, $consulta);
    $gauchada= mysqli_fetch_assoc($resultado);
    $consulta2 = "SELECT * FROM postulantes P INNER JOIN usuarios U WHERE P.idgauchada='$gaid' AND P.idusuario=U.id_usuario AND U.baneado= 0";
    $resultado2= mysqli_query($conexion, $consulta2);
    
    $consulta4 = "SELECT * FROM calificaciones WHERE idgauchada=$gaid";
    $resultado4 = mysqli_query($conexion, $consulta4);
    $calificado= mysqli_num_rows($resultado4);
    if (isset($_SESSION['usuario']) && $_SESSION['usuario']== $gauchada['idusuario'] Xor isset($_SESSION['admin'])){
?>      <div id='gaupostulantes'>Postulantes:
<?php
        echo "<br>";
        echo "<br>";
        while($postulantes= mysqli_fetch_array($resultado2)) {
            echo "<hr/>";
?>
            <a target="_blank" href="/php/usuarios/perfil.php?usid=<?php echo $postulantes['id_usuario'];?>" ><?php echo $postulantes['apellido'];?> <?php echo $postulantes['nombre']; ?></a>
            <?php
            if($gauchada['idpostulante'] == 0 && $gauchada['expiracion'] > $caducidad && !isset($_SESSION['admin'])){
            ?>
                <a target="_blank" onClick="window.open(this.href, this.target, 'width=500,height=400'); return false;" href="/php/gauchada/elegirpos.php?po=<?php echo $postulantes['id_usuario']; ?>&gau=<?php echo $gaid; ?>">Elegir</a>
            <?php
            }
            else{
                if($gauchada['idpostulante'] == $postulantes['id_usuario'] && $calificado == 0 && !isset($_SESSION['admin'])){
            ?>
                    <a target="_blank" onclick="return confirm(' Esta seguro?')" href="/php/gauchada/calificar.php?po=<?php echo $postulantes['id_usuario']; ?>&gau=<?php echo $gaid; ?>">Calificar</a>
            <?php
                }
            }
            ?>
<?php
        }
?>
        </div>

<?php
        
        if ($gauchada['idpostulante'] == 0 && $gauchada['expiracion'] > $caducidad && !$gauchada['borrada'] && !isset($_SESSION['admin'])){
?>
            <div id='dueño'>
                <a onclick="return confirm(' Esta seguro que desea despublicar la gauchada?')" href="/php/gauchada/eliminar.php?usid=<?php echo $_SESSION['usuario'] ?>&gaid=<?php echo $gaid ?>" >Despublicar Gauchada</a>
                </br>
                <a href="/php/gauchada/modificargauchada.php?usid=<?php echo $_SESSION['usuario'] ?>&gaid=<?php echo $gaid ?>" >Modificar Gauchada</a>
            </div>
        
<?php
        }
        if ($gauchada['idpostulante'] == 0 && $gauchada['expiracion'] > $caducidad && !$gauchada['borrada'] && isset($_SESSION['admin'])){
?>
            <div id='dueño'>
                <a onclick="return confirm(' Esta seguro que desea eliminar la gauchada?')" href="/php/admins/bajagauchada.php?usid=<?php echo $gauchada['idusuario'] ?>&gaid=<?php echo $gaid ?>" >Eliminar Gauchada</a>
            </div>
        
<?php
        }


?>
<?php
    }
    else {
?>      
    <?php if ($gauchada['idpostulante'] == 0 && $gauchada['expiracion'] > $caducidad && !isset($_SESSION['admin'])){

            $usuario= $_SESSION['usuario'];
            $consulta3 = "SELECT * FROM postulantes WHERE idgauchada='$gaid' AND idusuario='$usuario'";
            $resultado3= mysqli_query($conexion, $consulta3);
            $postulado= mysqli_num_rows($resultado3);
            if($postulado == 0){
            ?>
                <form action='/php/gauchada/postularce.php' method='POST'>
                    <input type='hidden' name='userid' value="<?php echo $_SESSION['usuario'] ?>">
                    <input type='hidden' name='gauchadaid' value="<?php echo $gaid ?>">
                    <div id='postularse'><input type='submit' value='Postularse'></div>
                </form>
<?php
                }
            else{
                ?>
                <form action='/php/gauchada/despostularce.php' method='POST'>
                    <input type='hidden' name='userid' value="<?php echo $_SESSION['usuario'] ?>">
                    <input type='hidden' name='gauchadaid' value="<?php echo $gaid ?>">
                    <div id='postularse'><input type='submit' value='Despostularse'></div>
                </form>
                <?php
            }
        }
    }
?>
    <div id='gautitulo'><?php echo $gauchada['titulo']; ?></div>
    <div id='gauusuario'>De: <?php echo $gauchada['apellido'];?> <?php echo $gauchada['nombre']; ?></div>
    <div id='gaucategoria'>Categoria: <?php echo $gauchada['categoria']; ?></div>
    <div id='gauciudad'>En: <?php echo $gauchada['ciudad']; ?></div>
    <div id='gaudescripcion'><?php echo $gauchada['descripcion']; ?></div>
    <div id="gauimagen">
        <img height="240px" src="data:<?php echo $gauchada['extension1']; ?>;base64,<?php echo base64_encode($gauchada['foto1']);?>"/>
<?php
        if(!empty($gauchada['foto2'])) {
?>
            <img height="240px" src="data:<?php echo $gauchada['extension2']; ?>;base64,<?php echo base64_encode($gauchada['foto2']);?>"/>
<?php
        }
        if(!empty($gauchada['foto3'])) {
?>  
            <img height="240px" src="data:<?php echo $gauchada['extension3']; ?>;base64,<?php echo base64_encode($gauchada['foto3']);?>"/>
<?php
        }
?>
    </div>
    <div id="preguntas"><label>Preguntas:</label>
<?php
        $listarpreguntas= "SELECT * FROM comentarios P INNER JOIN usuarios U WHERE P.idgauchada='$gaid' AND P.idusuario=U.id_usuario ORDER BY id_comentario";
        $resulpreguntas= mysqli_query($conexion, $listarpreguntas);
        
        if (isset($_SESSION['usuario']) && $_SESSION['usuario'] <> $gauchada['idusuario']){
        ?>
            <form action="/php/gauchada/enviarpregunta.php" method="POST" class="pregunta" >
                <input type="hidden" name="usid" value="<?php echo $_SESSION['usuario']; ?>">
                <input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
                <textarea class="textarea" MAXLENGTH="300" name='pregunta' placeholder="Escriba aqui su pregunta*" required><?php if($_GET['preg']!=""){ echo $_GET['preg']; }?></textarea>
                <input type="submit" name="Enviar">
            </form>
        <?php
        }
        while ($pregun = mysqli_fetch_array($resulpreguntas)) {
?>
            <div id='pregunta'>
                </br>
                <hr />
                <div id='pregusuario'>De: <?php echo $pregun['apellido'];?> <?php echo $pregun['nombre']; ?></div>
                <div id='pregpregunta'><?php echo $pregun['pregunta']; echo "</br>"; echo "---"; echo $pregun['respuesta']; ?></div>
<?php
                
                if ((isset($_SESSION['usuario']) && $_SESSION['usuario']== $pregun['id_usuario'])){
                
                    if ($pregun['respuesta']== ""){
                    ?>  

                    <form action="/php/gauchada/eliminarpregunta.php" method="POST" onsubmit="return confirm(' Esta seguro que desea eliminar esta pregunta?')" class="repregunta" >
                        <input type="hidden" name="coment" value="<?php echo $pregun['id_comentario']; ?>">
                        <input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
                        <input type="submit" name="eliminar" value="Eliminar">
                    </form>  
                    
                    <form action="/php/gauchada/modificarpregunta.php" method="POST" class="repregunta" >
                        <input type="hidden" name="coment" value="<?php echo $pregun['id_comentario']; ?>">
                        <input type="hidden" name="pregun" value="<?php echo $pregun['pregunta']; ?>">
                        <input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
                        <input type="submit" name="Modificar" value="Modificar">
                    </form>
        

                    <?php
                    }
                }
                else if(isset($_SESSION['admin'])){
                ?>  

                    <form action="/php/gauchada/eliminarpregunta.php" method="POST" onsubmit="return confirm(' Esta seguro que desea eliminar esta pregunta?')" class="repregunta" >
                        <input type="hidden" name="coment" value="<?php echo $pregun['id_comentario']; ?>">
                        <input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
                        <input type="submit" name="eliminar" value="Eliminar">
                    </form> 
                <?php
                }
                                                               
                if (isset($_SESSION['usuario']) && $_SESSION['usuario']== $gauchada['idusuario']){
                        ?> 
                <?php if ($gauchada['idpostulante'] == 0 && $gauchada['expiracion'] > $caducidad){
                        $comid= $pregun['id_comentario'];

                        $selecpregunta= "SELECT * FROM comentarios WHERE id_comentario='$comid'";
                        $consulta= mysqli_query($conexion, $selecpregunta);
                        $pregunta = mysqli_fetch_assoc($consulta);

                    ?>  <div id='responder'>
                        <?php if ($pregun['respuesta'] == ""){
                           
                             ?>   
                                <form action="/php/gauchada/enviarrespuesta.php" method="POST" class="pregunta" >
                                    <input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
                                    <input type="hidden" name="comid" value="<?php echo $comid; ?>">
                                    <button type="button" onclick="respuesta.hidden = false">Responder</button>
                                    <textarea class="textarea" MAXLENGTH="300" onclick="finish.hidden = false" hidden="hidden" name='respuesta' placeholder="Escriba aqui su respuesta" required></textarea>
                                    <button type="button" name="finish" hidden="hidden" onclick="this.form.submit()">Enviar</button>
                                </form>
                              <?php
                              }
                              else{
                              ?>
                                <form action="/php/gauchada/enviarrespuesta.php" method="POST" class="pregunta" >
                                    <input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
                                    <input type="hidden" name="comid" value="<?php echo $comid; ?>">
                                    <button type="button" onclick="respuesta.hidden = false">Editar</button>
                                    <textarea class="textarea" MAXLENGTH="300" onclick="finish.hidden = false"  hidden="hidden" name='respuesta' ><?php echo $pregun['respuesta']; ?></textarea>
                                    <button type="button" name="finish" hidden="hidden" onclick="this.form.submit()">Enviar</button>
                                </form>

                              <?php  
                              }  
                              ?>
                        </div>
                <?php
                    }
                ?>
<?php
                }
?>
            </div>
            <br>
<?php     
        }
?>


    </div>
</body>
</html>