<?php
	require "config.php";
	require DBAPI;
	$pdo = pdo_connect_mysql();
	include (HEADER_TEMPLATE);
?>

<?php if (!empty($_SESSION['notLoggedMessage'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['notLoggedType']; ?> alert-dismissible fade show" role="alert">
		<?php echo $_SESSION['notLoggedMessage']; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php clear_notLoggedMessages(); ?>
<?php endif; ?>

<h1 class="m-2">Painel de Controle</h1>
<hr />

<?php if ($pdo) : ?>
	
	<?php /*
	<div class="row">
		<?php if (!empty($_SESSION['user'])) : ?>
			<div class="col-xs-6 col-sm-3 col-md-2">
				<a href="customers/add.php" class="btn btn-secondary">
					<div class="row">
						<div class="col-xs-12 text-center">
							<i class="fa-solid fa-user-plus fa-5x"></i>
						</div>
						<div class="col-xs-12 text-center">
							<p>Novo Cliente</p>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>

		<div class="col-xs-6 col-sm-3 col-md-2">
			<a href="customers" class="btn btn-light">
				<div class="row">
					<div class="col-xs-12 text-center">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-12 text-center">
						<p>Clientes</p>
					</div>
				</div>
			</a>
		</div>
	</div>

	<!--Modificado: meu banco de dados-->
	<hr>

	<div class="row">
		<?php if (!empty($_SESSION['user'])) : ?>
			<div class="col-xs-6 col-sm-3 col-md-2">
				<a href="motos/add.php" class="btn btn-secondary">
					<div class="row">
						<div class="col-xs-12 text-center">
							<i class="fa-solid fa-motorcycle fa-5x"></i> <i class="fa-solid fa-plus fa-2x"></i>
						</div>
						<div class="col-xs-12 text-center">
							<p>Nova Moto</p>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>

		<div class="col-xs-6 col-sm-3 col-md-2">
			<a href="motos" class="btn btn-light">
				<div class="row">
					<div class="col-xs-12 text-center">
						<i class="fa-solid fa-motorcycle fa-5x"></i>
					</div>
					<div class="col-xs-12 text-center">
						<p>Motos</p>
					</div>
				</div>
			</a>
		</div>
	</div>
    <hr>
    */ ?>

	<!--Modificado: contatos-->
	<div class="row">
		<?php if (!empty($_SESSION['user'])) : ?>
			<div class="col-xs-6 col-sm-3 col-md-2">
				<a href="contatos/add.php" class="btn btn-secondary">
					<div class="row">
						<div class="col-xs-12 text-center">
							<i class="fa-solid fa-id-card fa-5x"></i>
						</div>
						<div class="col-xs-12 text-center">
							<p>Novo Contato</p>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>

		<div class="col-xs-6 col-sm-3 col-md-2">
			<a href="contatos" class="btn btn-light">
				<div class="row">
					<div class="col-xs-12 text-center">
						<i class="fa-solid fa-address-book fa-5x"></i>
					</div>
					<div class="col-xs-12 text-center">
						<p>Contatos</p>
					</div>
				</div>
			</a>
		</div>
	</div>

	<!--Modificado: brinquedos-->
	<hr>

	<div class="row">
		<?php if (!empty($_SESSION['user'])) : ?>
			<div class="col-xs-6 col-sm-3 col-md-2">
				<a href="brinquedos/add.php" class="btn btn-secondary">
					<div class="row">
						<div class="col-xs-12 text-center">
							<i class="fa-solid fa-dice-six fa-5x"></i>
						</div>
						<div class="col-xs-12 text-center">
							<p>Novo Brinquedo</p>
						</div>
					</div>
				</a>
			</div>
		<?php endif; ?>

		<div class="col-xs-6 col-sm-3 col-md-2">
			<a href="brinquedos" class="btn btn-light">
				<div class="row">
					<div class="col-xs-12 text-center">
						<i class="fa-solid fa-gamepad fa-5x"></i>
					</div>
					<div class="col-xs-12 text-center">
						<p>Brinquedos</p>
					</div>
				</div>
			</a>
		</div>
	</div>
	
	<!--Modificado: usuarios-->
    <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) : ?>

		<hr>

		<div class="row">
			<div class="col-xs-6 col-sm-3 col-md-2">
				<a href="usuarios/add.php" class="btn btn-secondary">
					<div class="row">
						<div class="col-xs-12 text-center">
						<i class="fa-solid fa-user-tie fa-5x"></i>
						</div>
						<div class="col-xs-12 text-center">
							<p>Novo Usuário</p>
						</div>
					</div>
				</a>
			</div>

			<div class="col-xs-6 col-sm-3 col-md-2">
				<a href="usuarios" class="btn btn-light">
					<div class="row">
						<div class="col-xs-12 text-center">
							<i class="fa-solid fa-user-lock fa-5x"></i>
						</div>
						<div class="col-xs-12 text-center">
							<p>Usuários</p>
						</div>
					</div>
				</a>
			</div>
		</div>

	<?php endif; ?>

<?php else : ?>
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div>
<?php endif; ?>

<?php include(FOOTER_TEMPLATE); # linha certa?>


