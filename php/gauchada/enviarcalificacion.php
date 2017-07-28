<?php
	include("../conexion.php");
	$idpostulante= $_POST['postuid'];
    $gauid= $_POST['gaid'];
	$calificacion= $_POST['calificacion'];
    $justificacion= $_POST['justificacion'];

	$consulta1= "INSERT INTO calificaciones(idgauchada, idpostulante, comentario, puntaje) VALUES ('$gauid', '$idpostulante', '$justificacion', '$calificacion')";
	$insertar= mysqli_query($conexion, $consulta1);
    
    $consulta2= "SELECT * FROM usuarios WHERE id_usuario =$idpostulante";
    $resultado2= mysqli_query($conexion, $consulta2);
    $usuario= mysqli_fetch_assoc($resultado2);

    $cred=$usuario['creditos'];
    
    switch ($calificacion) {
    case 'positivo':
        $cal= $usuario['puntos'] +1;
        $cred=$cred+1;
        break;
    case 'neutro':
        $cal= $usuario['puntos'];
        break;
    case 'negativo':
        $cal= $usuario['puntos'] -2;
        break;
}
    
    
    $update= "UPDATE usuarios SET puntos=$cal, creditos=$cred WHERE id_usuario= $idpostulante";
    $consulta3= mysqli_query($conexion, $update);

?>
	<script>
		alert('El usuario ah sido calificado');
        window.opener.location.reload();
		window.close();
	</script>