<?php 
    require("functions.php"); 
    editMoto();
    require(HEADER_TEMPLATE);
    makeSureUserIsLogged();
?>

    <?php if (isset($moto)): ?>

        <header>
            <h2>Atualizar Moto</h2>
        </header>

        <form action="edit.php?id=<?php echo $moto['id']; ?>" method="post" enctype="multipart/form-data">
            <hr>
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="name">Código</label>
                    <input type="number" id="codigoMoto" class="form-control is-valid" name="moto['codigo']" value="<?php echo $moto['codigo']; ?>" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um código válido.
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label for="campo1">Nome da moto</label>
                    <input type="text" id="nomeMoto" class="form-control is-valid" name="moto['nome']" value="<?php echo $moto['nome']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira um nome válido.
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="campo2">Fabricante</label>
                    <input type="text" id="fabricanteMoto" class="form-control is-valid" name="moto['fabricante']" value="<?php echo $moto['fabricante']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira um nome de fabricante válido.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Ano da moto</label>
                    <input type="number" id="anoMoto" class="form-control is-valid" name="moto['ano']" value="<?php echo $moto['ano']; ?>" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um ano válido.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="campo1">Preço</label>
                    <input type="number" id="precoMoto" class="form-control is-valid" name="moto['preco']" value="<?php echo $moto['preco']; ?>" placeholder="R$" required>
                    <div class="invalid-feedback order-last">
                        Insira um preço válido.
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="campo2">Cores</label>
                    <input type="text" id="coresMoto" class="form-control is-valid" name="moto['cores']" value="<?php echo $moto['cores']; ?>"required>
                    <div class="invalid-feedback order-last">
                        Insira cores válidas.
                    </div>
                </div>
                
                <div class="form-group col-md-2">
                    <label for="campo3">Data de Fabricação</label>
                    <input type="date" id="fabricacaoMoto" class="form-control is-valid" name="moto['fabricacao']" value="<?php echo $moto['fabricacao']; ?>"required>
                    <div class="invalid-feedback order-last">
                        Insira uma data de fabricação válida.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Data de Cadastro</label>
                    <input type="date" class="form-control" name="moto['created']" value="<?php echo ajustaData($moto['modificado']); ?>" disabled required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="campo3">Imagem (Atual: <?php echo $moto['imagem']; ?>)</label> 
                    <input type="file" id="imagemMoto" class="form-control is-valid" name="imagemMoto">
                </div>
            </div>
            <div id="actions" class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
                    <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
                </div>
            </div>
        </form>

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