<?php
    require("functions.php");
    indexMotos();
	require(HEADER_TEMPLATE);
?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Motos</h2>
		</div>
		<div class="col-sm-6 text-right h2">
			<a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-motorcycle"></i> <i class="fa-solid fa-plus"></i> Nova Moto</a>
			<a class="btn btn-light" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
		</div>
	</div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
		<?php echo $_SESSION['message']; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php clear_messages(); ?>
<?php endif; ?>
	<hr>

	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th width="30%">Nome da Moto</th>
				<th>Fabricante</th>
				<th>Preço</th>
				<th>Cores</th>
				<th>Atualizado em</th>
				<th>Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($motos) : ?>
				<?php foreach ($motos as $moto) : ?>
					<tr>
						<td><?php echo $moto['id']; ?></td>
						<td><?php echo $moto['nome']; ?></td>
						<td><?php echo $moto['fabricante']; ?></td>
						<td><?php echo formataPreco($moto['preco']); ?></td>
						<td><?php echo $moto['cores']; ?></td>
						<td><?php echo formataData($moto['modificado'], "d/m/Y H:i:s"); ?></td>
						<td class="actions text-start">
							<a href="view.php?id=<?php echo $moto['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
							<a href="edit.php?id=<?php echo $moto['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
							<a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-modal-moto" data-moto="<?php echo $moto['id']; ?>">
								<i class="fa fa-trash"></i> Excluir
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<td colspan="6">Nenhum registro encontrado.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>

<?php include("modal.php"); ?>

<?php include(FOOTER_TEMPLATE); ?>