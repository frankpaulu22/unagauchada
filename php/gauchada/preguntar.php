<?php
	$userid= $_GET['usid'];
	$gaid= $_GET['gaid'];
?>
	<form action="/php/gauchada/enviarpregunta.php" method="POST">
		<input type="hidden" name="usid" value="<?php echo $userid; ?>">
		<input type="hidden" name="gaid" value="<?php echo $gaid; ?>">
		<textarea class="textarea" MAXLENGTH="300" name='pregunta' placeholder="Escriba aqui su pregunta*" required></textarea>
		<input type="submit" name="Enviar">

	</form>