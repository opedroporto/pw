<?php 
  require("functions.php"); 
  addContato();
  makeSureUserIsLogged();
?>

<?php include(HEADER_TEMPLATE); ?>

        <header>
            <h2>Novo Contato</h2>
        </header>

        <form action="add.php" method="post">
        <!-- area de campos do form -->
            <hr>
            <div class="row">
                
                <div class="form-group col-md-7">
                    <label for="campo1">Nome</label>
                    <input type="text" id="nomeContato" class="form-control is-invalid" name="contato['name']" required>
                    <div class="invalid-feedback order-last">
                        Insira um nome válido.
                    </div>
                </div>

                <div class="form-group col-md-5">
                    <label for="campo2">E-mail</label>
                    <input type="email" id="emailContato" class="form-control is-invalid" name="contato['email']" required>
                    <div class="invalid-feedback order-last">
                        Insira um e-mail válido.
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="campo2">Telefone</label>
                    <input type="number" id="telefoneContato" class="form-control is-invalid" name="contato['phone']" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um telefone válido.
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="campo2">Função</label>
                    <input type="text" id="funcaoContato" class="form-control is-invalid" name="contato['title']" required>
                    <div class="invalid-feedback order-last">
                        Insira uma função válido.
                    </div>
                </div>
                
                
                <div class="form-group col-md-4">
                    <label for="data">Data de cadastro</label>
                    <input type="date" class="form-control" name="contato['created']" disabled required>
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