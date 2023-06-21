<?php 
	require("functions.php"); 
	viewBrinquedos($_GET['id']);
    require(HEADER_TEMPLATE);
?>

    <?php if (isset($brinquedo)): ?>
        <header>
            <h2>Brinquedo <?php echo $brinquedo['id']; ?></h2>
        </header>
        <hr>

        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
        <?php endif; ?>

        <dl class="dl-horizontal">
            <dt>Modelo:</dt>
            <dd><?php echo $brinquedo['modelo']; ?></dd>

            <dt>Marca:</dt>
            <dd><?php echo $brinquedo['marca']; ?></dd>

            <dt>Idade Recomendada:</dt>
            <dd><?php echo $brinquedo['faixa_etaria']; ?></dd>

            <dt>Data de cadastro:</dt>
            <dd><?php echo formataData($brinquedo['data_cad'], "d/m/Y"); ?></dd>

            <dt>Imagem:</dt>
            <dd>
                <?php
                    echo "<div class='card' style='width:400px'>";
                    if (empty($brinquedo['foto'])){
                            $imagem = 'semImagem.png';
                        }else{
                            $imagem = $brinquedo['foto'];
                        }					
                    echo "<div class='card-body'>";
                    echo "<img class='card-img-top' src='imagens/$imagem' alt='Card image' style='width:100%'>";
                    echo "</div>";
                ?>
            </dd>
        </dl>
        
        <div id="actions" class="row">
            <div class="col-md-12">
            <a href="edit.php?id=<?php echo $brinquedo['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
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