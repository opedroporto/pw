<?php
	require('config.php');
	require(DBAPI);

	if (isset($_POST['usuario'])) {
		
		$usuario = $_POST['usuario'];
		
		// log in successful
		$usuarioInfo = login($usuario['user'], $usuario['password']);
		if ($usuarioInfo) {
			if(!isset($_SESSION)){session_start();}
			$_SESSION['user'] = $usuarioInfo['user'];
			$_SESSION['id'] = $usuarioInfo['id'];
			$_SESSION['foto'] = $usuarioInfo['foto'];

			$_SESSION['isAdmin'] = ($usuarioInfo['user'] == "admin");


			$_SESSION['notLoggedMessage'] = "Login efetuado com sucesso.";
			$_SESSION['notLoggedType'] = "success";
		}
		// log in error
		else {
			$_SESSION['notLoggedMessage'] = "Falha no login";
			$_SESSION['notLoggedType'] = "danger";
		}

		header("location: index.php");
	} else {
		header("location: index.php");
	}
?>