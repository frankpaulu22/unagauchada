<?php
	include("../conexion.php");
	$idpostulante= $_POST['postuid'];
    $gauid= $_POST['gaid'];
	$calificacion= $_POST['calificacion'];
    $justificacion= $_POST['justificacion'];
    $userid= $_SESSION['usuario'];

	$consulta1= "INSERT INTO calificaciones(idgauchada, idpostulante, comentario, puntaje) VALUES ('$gauid', '$idpostulante', '$justificacion', '$calificacion')";
	$insertar= mysqli_query($conexion, $consulta1);
    
    $consulta2= "SELECT puntos FROM usuarios WHERE id_usuario =$idpostulante";
    $resultado2= mysqli_query($conexion, $consulta2);
    $puntos= mysqli_fetch_assoc($resultado2);
    
    switch ($calificacion) {
    case 'positivo':
        $cal= $puntos['puntos'] +1;
        break;
    case 'neutro':
        $cal= $puntos['puntos'];
        break;
    case 'negativo':
        $cal= $puntos['puntos'] -1;
        break;
}

    $update= "UPDATE usuarios SET puntos=$cal WHERE id_usuario= $idpostulante";
    $consulta3= mysqli_query($conexion, $update);

    $adeuda = "UPDATE usuarios SET adeuda='0' WHERE id_usuario='$userid'";
    $consulta = mysqli_query($conexion, $adeuda);

?>
	<script>
		alert('El usuario ah sido calificado');
		window.close();
	</script>