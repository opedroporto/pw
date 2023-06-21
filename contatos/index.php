<?php
    require("functions.php");
    indexContato();
	require(HEADER_TEMPLATE);
?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Contatos</h2>
		</div>
		<div class="col-sm-6 text-right h2">
			<a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-id-card"></i> Novo Contato</a>
			<a class="btn btn-light" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>

			<?php if ($_SERVER['REQUEST_METHOD'] === 'GET') : ?>
				<div class="btn-group" role="group" aria-label="Basic example">
					<a class="btn btn-danger" style="border: 1px solid #a83236;" target="_blank" href="<?php echo BASEURL; ?>inc/pdf.php?category=<?php echo "contacts";?>"><i class="fa-solid fa-file-pdf"></i> Ver PDF</a>
					<a class="btn btn-danger" style="border: 1px solid #a83236;" target="_blank" href="<?php echo BASEURL; ?>inc/pdf.php?category=<?php echo "contacts";?>&d=true"><i class="fa-solid fa-file-pdf"></i> Baixar PDF</a>
				</div>
			<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
				<div class="btn-group" role="group" aria-label="Basic example">
					<a class="btn btn-danger" style="border: 1px solid #a83236;" target="_blank" href="<?php echo BASEURL; ?>inc/pdf.php?category=<?php echo "contacts";?>&filter=<?php echo $_POST["contatos"];?>&filtertype=<?php echo $_POST["filtertype"];?>"><i class="fa-solid fa-file-pdf"></i> Ver PDF</a>
					<a class="btn btn-danger" style="border: 1px solid #a83236;" target="_blank" href="<?php echo BASEURL; ?>inc/pdf.php?category=<?php echo "contacts";?>&filter=<?php echo $_POST["contatos"];?>&filtertype=<?php echo $_POST["filtertype"];?>&d=true"><i class="fa-solid fa-file-pdf"></i> Baixar PDF</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</header>

<form name="filtro" action="index.php" method="post">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="filtertype" id="inlineCheckbox1" value="contains"
				<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
					<?php if ($_POST['filtertype'] === "contains") : ?>checked<?php endif; ?>
				<?php else : ?>
					checked
				<?php endif; ?>
			 disabled>
			<label class="form-check-label" for="inlineCheckbox1">Contém</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="checkbox" name="filtertype" id="inlineCheckbox2" value="equalsto" <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['filtertype'] === "equalsto") : ?>checked<?php endif; ?> disabled>
			<label class="form-check-label" for="inlineCheckbox2">Igual a</label>
		</div>
	<div class="row">
		<div class="form-group col-md-4">
			<div class="input-group mb-3">
				<input name="contatos" type="text" class="form-control" placeholder="Pesquisa">
				<button type="submit" class="btn btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
			</div>
		</div>
	</div>
</form>


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
				<th width="30%">Nome</th>
				<th>E-mail</th>
				<th>Telefone</th>
				<th>Função</th>
				<th>Data de cadastro</th>
				<th>Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($contatos) : ?>
				<?php foreach ($contatos as $contato) : ?>
					<tr>
						<td><?php echo $contato['id']; ?></td>
						<td><?php echo $contato['name']; ?></td>
						<td><?php echo $contato['email']; ?></td>
						<td><?php echo formataTelefone($contato['phone']) ?></td>
						<td><?php echo $contato['title'] ?></td>
						<td><?php echo formataData($contato['created'], "d/m/Y H:i:s"); ?></td>
						<td class="actions text-start">
							<a href="view.php?id=<?php echo $contato['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
							<a href="edit.php?id=<?php echo $contato['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
							<a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-modal-contato" data-contato="<?php echo $contato['id']; ?>">
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