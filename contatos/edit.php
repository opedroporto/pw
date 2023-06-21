<?php 
    require("functions.php"); 
    editContato();
    require(HEADER_TEMPLATE);
    makeSureUserIsLogged();
?>

    <?php if (isset($contato)): ?>
        
        <header>
            <h2>Atualizar Contato</h2>
        </header>

        <form action="edit.php?id=<?php echo $contato['id']; ?>" method="post">
            <hr>
            <div class="row">
                <div class="form-group col-md-7">
                        <label for="campo1">Nome</label>
                        <input type="text" id="nomeContato" class="form-control is-valid" name="contato['name']" value="<?php echo $contato['name']; ?>" required>
                        <div class="invalid-feedback order-last">
                            Insira um nome válido.
                        </div>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="campo2">E-mail</label>
                        <input type="email" id="emailContato" class="form-control is-valid" name="contato['email']" value="<?php echo $contato['email']; ?>" required>
                        <div class="invalid-feedback order-last">
                            Insira um e-mail válido.
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="campo2">Telefone</label>
                    <input type="number" id="telefoneContato" class="form-control is-valid" name="contato['phone']" value="<?php echo $contato['phone']; ?>" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um telefone válido.
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="campo2">Função</label>
                    <input type="text" id="funcaoContato" class="form-control is-valid" name="contato['title']" value="<?php echo $contato['title']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira uma função válido.
                    </div>
                </div>
                
                
                <div class="form-group col-md-4">
                    <label for="campo3">Data de Cadastro</label>
                    <input type="date" class="form-control" value="<?php echo ajustaData($contato['created']); ?>" disabled required>
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