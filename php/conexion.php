<?php
    $conexion = new mysqli('localhost', 'root', '', 'gauchadas.com') or die ('Problemas en la conexion'. mysql_error());
 $conexion->set_charset("utf8");
?>