<?php
	ob_start();
	if(!isset($_SESSION)){session_start();}
?>

	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<title>CRUD: projeto PW - 3º ano</title>
			<meta name="description" content="">
			<meta name="viewport" content="width=device-width, initial-scale=1"> <!--Meta tag de responsividade-->

			<link rel='shortcut icon' type='image/x-icon' href='<?php echo BASEURL; ?>assets/novoFavicon.ico' />

			<link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
			<link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
			<link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css"> <!-- Fontawesome -->
		</head>
		<body>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			  <div class="container-fluid">
				<a class="navbar-brand" href="<?php echo BASEURL; ?>"><i class="fa-solid fa-gamepad"></i> CRUD PW</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
					
                    <?php /*
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  	<i class="fa-solid fa-users"></i> Clientes
					  </a>
					  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php if (!empty($_SESSION['user'])) : ?>
							<a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a>
						<?php endif; ?>
						<a class="dropdown-item" href="<?php echo BASEURL; ?>customers"><i class="fa-solid fa-users"></i> Gerenciar Clientes</a>
					  </ul>
					</li>

					<!-- MODIFICADO: Motos dropdown -->
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  	<i class="fa-solid fa-motorcycle"></i> Motos
					  </a>
					  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					  	<?php if (!empty($_SESSION['user'])) : ?>
							<a class="dropdown-item" href="<?php echo BASEURL; ?>motos/add.php"><i class="fa-solid fa-motorcycle"></i> <i class="fa-solid fa-plus"></i> Nova Moto</a>
						<?php endif; ?>
						<a class="dropdown-item" href="<?php echo BASEURL; ?>motos"><i class="fa-solid fa-motorcycle"></i> Gerenciar Motos</a>
					  </ul>
					</li>
                    */ ?>

					<!-- MODIFICADO: Contatos dropdown -->
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  	<i class="fa-solid fa-address-book"></i> Contatos
					  </a>
					  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php if (!empty($_SESSION['user'])) : ?>
							<a class="dropdown-item" href="<?php echo BASEURL; ?>contatos/add.php"><i class="fa-solid fa-id-card"></i> Novo Contato</a>
						<?php endif; ?>
						<a class="dropdown-item" href="<?php echo BASEURL; ?>contatos"><i class="fa-solid fa-address-book"></i> Gerenciar Contatos</a>
					  </ul>
					</li>

					<!-- MODIFICADO: Brinquedos dropdown -->
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					  	<i class="fa-solid fa-gamepad"></i> Brinquedos
					  </a>
					  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php if (!empty($_SESSION['user'])) : ?>
							<a class="dropdown-item" href="<?php echo BASEURL; ?>brinquedos/add.php"><i class="fa-solid fa-dice-six"></i> Novo Brinquedo </a>
						<?php endif; ?>
						<a class="dropdown-item" href="<?php echo BASEURL; ?>brinquedos"><i class="fa-solid fa-gamepad"></i> Gerenciar Brinquedos</a>
					  </ul>
					</li>
					
					<!-- MODIFICADO: Usuários dropdown -->
					<?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) : ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fa-solid fa-user-lock"></i> Usuários
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/add.php"><i class="fa-solid fa-user-tie"></i> Novo Usuário</a>
								<a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios"><i class="fa-solid fa-user-lock"></i> Gerenciar Usuários</a>
							</ul>
						</li>
					<?php endif; ?>

				  </ul>
					
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<?php if (empty($_SESSION['user'])) : ?>
						<!-- GUEST -->
						<!-- log in dropdown -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fa-solid fa-user-lock"></i> Log In
							</a>
							<ul id="login-menu" class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								<form class="form-horizontal" action="<?php echo BASEURL; ?>login.php" method="post" accept-charset="UTF-8">
									<div class="form-group">
										<label>Login: </label>
										<input class="form-control rounded-0" type="text" name="usuario[user]" placeholder="Login"/><br>
										<label>Senha: </label>
										<input class="form-control rounded-0" type="password" name="usuario[password]" placeholder="Senha"/><br>
										<input class="btn btn-dark form-control rounded-0 " type="submit" value="Login" />
									</div>
								</form>
							</ul>
						</li>
					<?php else: ?>
						<!-- LOGGED USER -->
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<img id="user-img" class="rounded-circle dropdown-item" src="<?php echo BASEURL . "usuarios/imagens/" . $_SESSION['foto'] ?>" alt="Foto do usuário">
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="<?php echo BASEURL . "usuarios/view.php?id=" . $_SESSION['id'] ?>"><i class="fa-solid fa-user-tie"></i> Meus dados</a>
								
								<form action="<?php echo BASEURL; ?>logout.php" method="post" accept-charset="UTF-8">
									<a>
										<button type="submit" class="dropdown-item btn btn-dark rounded-0">
											<i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i> Sair
										</button>
									</a>
								</form>
								
							</ul>
						</li>
					<?php endif; ?>
					</ul>
				</div>
			  </div>
			</nav>

		<!-- -->
		<!-- Velho -->
		<!-- -->

		<main class="container">