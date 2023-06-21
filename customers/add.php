<?php 
  require("functions.php"); 
  add();
  makeSureUserIsLogged();
?>

<?php include(HEADER_TEMPLATE); ?>

        <header>
            <h2>Novo Cliente</h2>
        </header>

        <form action="add.php" method="post">
        <!-- area de campos do form -->
            <hr>
            <div class="row">
                <div class="form-group col-md-7">
                    <label for="campo1">Nome / Razão Social</label>
                    <input type="text" id="nome" class="form-control is-invalid" name="customer['name']" required>
                    <div class="invalid-feedback order-last">
                        Insira um nome válido.
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="campo2">CNPJ / CPF</label>
                    <input type="number" id="cpf" class="form-control is-invalid" name="customer['cpf_cnpj']"  maxlength="14" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um CPF válido.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Data de Nascimento</label>
                    <input type="date" id="dataNascimento" class="form-control is-invalid" name="customer['birthdate']" required>
                    <div class="invalid-feedback order-last">
                        Insira uma data de nascimento válida.
                    </div>
                </div>  
            </div>
        
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="campo1">Endereço</label>
                    <input type="text" id="endereco" class="form-control is-invalid" name="customer['address']" required>
                    <div class="invalid-feedback order-last">
                        Insira um endereço válido.
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="campo2">Bairro</label>
                    <input type="text" id="bairro" class="form-control is-invalid" name="customer['hood']" required>
                    <div class="invalid-feedback order-last">
                        Insira um bairro válido.
                    </div>
                </div>
                
                
                <div class="form-group col-md-2">
                    <label for="campo3">CEP</label>
                    <input type="number" id="cep" class="form-control is-invalid" name="customer['zip_code']"  maxlength="8" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um CEP válido.
                    </div>
                </div>
                
                <div class="form-group col-md-2">
                    <label for="campo3">Data de Cadastro</label>
                    <input type="date" class="form-control" name="customer['created']" disabled required>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="campo1">Município</label>
                    <input type="text" id="municipio" class="form-control is-invalid" name="customer['city']" required>
                    <div class="invalid-feedback order-last">
                        Insira um município válido.
                    </div>
                </div>
                
                <div class="form-group col-md-2">
                    <label for="campo2">Telefone</label>
                    <input type="number" id="telefone" class="form-control is-invalid" name="customer['phone']" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um telefone válido.
                    </div>
                </div>
                
                <div class="form-group col-md-2">
                    <label for="campo3">Celular</label>
                    <input type="number" id="celular" class="form-control is-invalid" name="customer['mobile']" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um celular válido.
                    </div>
                </div>
                
                <div class="form-group col-md-1">
                    <label for="campo3">UF</label>
                    <input type="text" id="uf" class="form-control is-invalid" type="text" name="customer['state']" maxlength="2" required>
                    <div class="invalid-feedback order-last">
                        Insira um UF válido.
                    </div>
                </div>
                
                <div class="form-group col-md-2">
                    <label for="campo3">Inscrição Estadual</label>
                    <input type="number" id="ie" class="form-control is-invalid" name="customer['ie']" maxlength="14" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira uma inscrição estadual válida.
                    </div>
                </div>

            </div>
            
            <div id="actions" class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
                    <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
                </div>
            </div>
        </form>

<?php include(FOOTER_TEMPLATE); ?>