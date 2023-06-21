<?php 
	require("functions.php"); 
	viewContato($_GET['id']);
    require(HEADER_TEMPLATE);
?>

    <?php if (isset($contato) and $contato): ?>
        <header>
            <h2>Cliente <?php echo $contato['id']; ?></h2>
        </header>
        <hr>

        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
        <?php endif; ?>

        <dl class="dl-horizontal">
            <dt>Nome:</dt>
            <dd><?php echo $contato['name']; ?></dd>

            <dt>Email:</dt>
            <dd><?php echo $contato['email']; ?></dd>

            <dt>Telefone:</dt>
            <dd><?php echo formataTelefone($contato['phone']); ?></dd>

            <dt>Função:</dt>
            <dd><?php echo $contato['title']; ?></dd>

            <dt>Data de cadastro:</dt>
            <dd><?php echo formataData($contato['created'], "d/m/Y"); ?></dd>
        </dl>
        
        <div id="actions" class="row">
            <div class="col-md-12">
            <a href="edit.php?id=<?php echo $contato['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
            </div>
        </div>

    <?php else: ?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Não foi possível relizar a operação com o ID informado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="col-md-12 text-center">
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Voltar</a>
        </div>

    <?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>