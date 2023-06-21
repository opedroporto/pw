<?php 
	require("functions.php"); 
	view($_GET['id']);
    require(HEADER_TEMPLATE);
?>

    <?php if (isset($customer) and $customer): ?>
        <header>
            <h2>Cliente <?php echo $customer['id']; ?></h2>
        </header>
        <hr>

        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
        <?php endif; ?>

        <dl class="dl-horizontal">
            <dt>Nome / Razão Social:</dt>
            <dd><?php echo $customer['name']; ?></dd>

            <dt>CPF / CNPJ:</dt>
            <dd><?php echo formataCPF($customer['cpf_cnpj']); ?></dd>

            <dt>Data de Nascimento:</dt>
            <dd><?php echo formataData($customer['birthdate'], "d/m/Y"); ?></dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Endereço:</dt>
            <dd><?php echo $customer['address']; ?></dd>

            <dt>Bairro:</dt>
            <dd><?php echo $customer['hood']; ?></dd>

            <dt>CEP:</dt>
            <dd><?php echo formataCep($customer['zip_code']); ?></dd>

            <dt>Data de Cadastro:</dt>
            <dd><?php echo formataData($customer['created'], "d/m/Y H:i:s"); ?></dd>

            <dt>Data de Alteração:</dt>
            <dd><?php echo formataData($customer['modified'], "d/m/Y H:i:s"); ?></dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Cidade:</dt>
            <dd><?php echo $customer['city']; ?></dd>

            <dt>Telefone:</dt>
            <dd><?php echo formataTelefone($customer['phone']); ?></dd>

            <dt>Celular:</dt>
            <dd><?php echo formataTelefone($customer['mobile']); ?></dd>

            <dt>UF:</dt>
            <dd><?php echo $customer['state']; ?></dd>

            <dt>Inscrição Estadual:</dt>
            <dd><?php echo formataIE($customer['ie']); ?></dd>
        </dl>

        <div id="actions" class="row">
            <div class="col-md-12">
            <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
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