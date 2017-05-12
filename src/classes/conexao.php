<?php	
	$servidor = "localhost";
	$bd = "twar";
	$usuario ="root";
	$senha = "alfa12";

	$link = new mysqli($servidor, $usuario, $senha, $bd);
	if (mysqli_connect_errno()) echo 'Erro';	

?>
