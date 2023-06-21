<?php 
	require("functions.php"); 
	viewUsuario($_GET['id']);
    require(HEADER_TEMPLATE);

    if (isset($_SESSION['id']) && $_SESSION['id'] != $usuario['id']) {
        makeSureUserIsAdmin();
    }
?>

    <?php if (isset($usuario) and $usuario): ?>
        <header>
            <h2>Usuário <?php echo $usuario['id']; ?></h2>
        </header>
        <hr>

        <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $usuario['id']
            && isset($_SESSION['isAdmin']) && !$_SESSION['isAdmin']) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Caso queira editar algum dado seu, contate um Administrador.
                </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php clear_messages(); ?>
        <?php endif; ?>

        <dl class="dl-horizontal">
            <dt>Nome:</dt>
            <dd><?php echo $usuario['nome']; ?></dd>

            <dt>Usuário (Login):</dt>
            <dd><?php echo formataCPF($usuario['user']); ?></dd>

            <dt>Senha:</dt>
            <dd><?php echo $usuario['password']; ?></dd>

            <dt>Imagem:</dt>
            <dd>
                <?php
                    echo "<div class='card' style='width:400px'>";
                    if (empty($usuario['foto'])){
                            $imagem = 'semImagem.png';
                    } else{
                        $imagem = $usuario['foto'];
                    }					
                    echo "<div class='card-body'>";
                    echo "<img class='card-img-top' src='imagens/$imagem' alt='Card image' style='width:100%'>";
                    echo "</div>";
                ?>
            </dd>
        </dl>

        <div id="actions" class="row">
            <div class="col-md-12">
            <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
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
    <?php //clear_messages() ?>

<?php include(FOOTER_TEMPLATE); ?>