<?php 
	require("functions.php"); 
	viewMoto($_GET['id']);
    require(HEADER_TEMPLATE);
?>

	<?php if (isset($moto) and $moto): ?>

        <header>
            <h2>Moto <?php echo $moto['id']; ?></h2>
        </header>
        <hr>

        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
        <?php endif; ?>

        <dl class="dl-horizontal">
            <dt>Código:</dt>
            <dd><?php echo $moto['codigo']; ?></dd>
            
            <dt>Nome da moto:</dt>
            <dd><?php echo $moto['nome']; ?></dd>

            <dt>Fabricante:</dt>
            <dd><?php echo $moto['fabricante']; ?></dd>
        </dl>

        <dl class="dl-horizontal">
            <dt>Ano:</dt>
            <dd><?php echo $moto['ano']; ?></dd>

            <dt>Preço:</dt>
            <dd><?php echo formataPreco($moto['preco']); ?></dd>

            <dt>Cores:</dt>
            <dd><?php echo $moto['cores']; ?></dd>

            <dt>Data de Fabricação:</dt>
            <dd><?php echo formataData($moto['fabricacao'], "d/m/Y"); ?></dd>

            <dt>Data de Alteração:</dt>
            <dd><?php echo formataData($moto['modificado'], "d/m/Y H:i:s"); ?></dd>

            <dt>Imagem:</dt>
            <dd>
                <?php
                    echo "<div class='card' style='width:400px'>";
                    if (empty($moto['imagem'])){
                            $imagem = 'semImagem.png';
                        }else{
                            $imagem = $moto['imagem'];
                        }					
                    echo "<div class='card-body'>";
                    echo "<img class='card-img-top' src='imagens/$imagem' alt='Card image' style='width:100%'>";
                    echo "</div>";
                ?>
            </dd>
        </dl>

        <div id="actions" class="row">
            <div class="col-md-12">
            <a href="edit.php?id=<?php echo $moto['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
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