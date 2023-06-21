<?php 
	require "config.php";
	include DBAPI; 
?>

<?php 
	$pdo = pdo_connect_mysql();
	
	if ($pdo) {
		echo '<h1>Banco de Dados Conectado!</h1>';
	} else {
		echo '<h1>ERRO: Não foi possível Conectar!</h1>';
	}
?>
