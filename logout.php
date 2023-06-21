<?php
	session_write_close();
	session_unset();
	session_destroy();
	unset($_SESSION['user']);
	unset($_SESSION);
	session_register_shutdown();

	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	
	header("location: index.php");
?>