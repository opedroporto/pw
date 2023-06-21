<?php 
  require("functions.php"); 
  addMoto();
  makeSureUserIsLogged();
?>

<?php include(HEADER_TEMPLATE); ?>

        <header>
            <h2>Nova Moto</h2>
        </header>

        <form action="add.php" method="post" enctype="multipart/form-data">
            <!-- area de campos do form -->
            <hr>
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="campo1">Código</label>
                    <input type="number" id="codigoMoto" class="form-control is-invalid" name="moto['codigo']"  maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um código válido.
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label for="campo1">Nome da moto</label>
                    <input type="text" id="nomeMoto" class="form-control is-invalid" name="moto['nome']" required>
                    <div class="invalid-feedback order-last">
                        Insira um nome válido.
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="campo2">Fabricante</label>
                    <input type="text" id="fabricanteMoto" class="form-control is-invalid" name="moto['fabricante']" required>
                    <div class="invalid-feedback order-last">
                        Insira um nome de fabricante válido.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Ano da moto</label>
                    <input type="number" id="anoMoto" class="form-control is-invalid" name="moto['ano']" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                    <div class="invalid-feedback order-last">
                        Insira um ano válido.
                    </div>
                </div>  
            </div>
        
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="campo1">Preço</label>
                    <input type="number" id="precoMoto" class="form-control is-invalid" name="moto['preco']" placeholder="R$" required>
                    <div class="invalid-feedback order-last">
                        Insira um preço válido.
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="campo2">Cores</label>
                    <input type="text" id="coresMoto" class="form-control is-invalid" name="moto['cores']" required>
                    <div class="invalid-feedback order-last">
                        Insira cores válidas.
                    </div>
                </div>
                
                <div class="form-group col-md-2">
                    <label for="campo3">Data de Fabricação</label>
                    <input type="date" id="fabricacaoMoto" class="form-control is-invalid" name="moto['fabricacao']" required>
                    <div class="invalid-feedback order-last">
                        Insira uma data de fabricação válida.
                    </div>
                </div>  
                
                <div class="form-group col-md-2">
                    <label for="campo3">Data de Cadastro</label>
                    <input type="date" class="form-control" name="moto['modificado']" disabled required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="campo3">Imagem</label>
                    <input type="file" id="imagemMoto" class="form-control is-invalid" name="imagemMoto" required>
                    <div class="invalid-feedback order-last">
                        Insira uma imagem válida.
                    </div>
                </div>
            </div>
            
            <div id="actions" class="row">
                <div class="col-md-12">
                    <button type="submit" name="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
                    <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
                </div>
            </div>
        </form>

<?php include(FOOTER_TEMPLATE); ?>