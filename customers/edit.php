<?php 
    require("functions.php"); 
    edit();
    require(HEADER_TEMPLATE);
    makeSureUserIsLogged();
?>

    <?php if (isset($customer)): ?>
        
        <header>
            <h2>Atualizar Cliente</h2>
        </header>

        <form action="edit.php?id=<?php echo $customer['id']; ?>" method="post">
            <hr>
            <div class="row">
                <div class="form-group col-md-7">
                    <label for="name">Nome / Razão Social</label>
                    <input type="text" id="nome" class="form-control is-valid" name="customer['name']" value="<?php echo $customer['name']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira um nome válido.
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="campo2">CNPJ / CPF</label>
                    <input type="number" id="cpf" class="form-control is-valid" name="customer['cpf_cnpj']" value="<?php echo ajustaCPF($customer['cpf_cnpj']); ?>" maxlength="14" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um CPF válido.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Data de Nascimento</label>
                    <input type="date" id="dataNascimento" class="form-control is-valid" name="customer['birthdate']" value="<?php echo ajustaData($customer['birthdate']); ?>">
                    <div class="invalid-feedback order-last">
                        Insira uma data de nascimento válida.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="campo1">Endereço</label>
                    <input type="text" id="endereco" class="form-control is-valid" name="customer['address']" value="<?php echo $customer['address']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira um endereço válido.
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="campo2">Bairro</label>
                    <input type="text" id="bairro" class="form-control is-valid" name="customer['hood']" value="<?php echo $customer['hood']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira um bairro válido.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">CEP</label>
                    <input type="number" id="cep" class="form-control is-valid" name="customer['zip_code']" value="<?php echo $customer['zip_code']; ?>" maxlength="8" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um CEP válido.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Data de Cadastro</label>
                    <input type="date" class="form-control" name="customer['created']" disabled value="<?php echo ajustaData($customer['created']); ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="campo1">Município</label>
                    <input type="text" id="municipio" class="form-control is-valid" name="customer['city']" value="<?php echo $customer['city']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira um município válido.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo2">Telefone</label>
                    <input type="number" id="telefone" class="form-control is-valid" name="customer['phone']" value="<?php echo $customer['phone']; ?>"  maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um telefone válido.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Celular</label>
                    <input type="number" id="celular" class="form-control is-valid" name="customer['mobile']" value="<?php echo $customer['mobile']; ?>"  maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um celular válido.
                    </div>
                </div>

                <div class="form-group col-md-1">
                    <label for="campo3">UF</label>
                    <input type="text" id="uf" class="form-control is-valid" type="text" name="customer['state']" value="<?php echo $customer['state']; ?>" maxlength="2" required>
                    <div class="invalid-feedback order-last">
                        Insira um UF válido.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Inscrição Estadual</label>
                    <input type="text" id="ie" class="form-control is-valid" name="customer['ie']" value="<?php echo $customer['ie']; ?>" maxlength="14" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                </div>
                <div class="invalid-feedback order-last">
                    Insira uma inscrição estadual válida.
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