<?php 
    require("functions.php"); 
    editBrinquedos();
    require(HEADER_TEMPLATE);
    makeSureUserIsLogged();
?>

    <?php if (isset($brinquedo)): ?>

        <header>
            <h2>Atualizar brinquedo</h2>
        </header>

        <form action="edit.php?id=<?php echo $brinquedo['id']; ?>" method="post" enctype="multipart/form-data">
            <hr>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="campo1">Nome do brinquedo</label>
                    <input type="text" id="nomeBrinquedo" class="form-control is-valid" name="brinquedo['modelo']" value="<?php echo $brinquedo['modelo']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira um modelo válido.
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="campo2">Marca</label>
                    <input type="text" id="marcaBrinquedo" class="form-control is-valid" name="brinquedo['marca']" value="<?php echo $brinquedo['marca']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira uma marca válida.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Idade recomendada</label>
                    <input type="number" id="faixaEtariaBrinquedo" class="form-control is-valid number-field" name="brinquedo['faixa_etaria']" min="0" max="99" oninput="this.value = Math.abs(this.value)" value="<?php echo $brinquedo['faixa_etaria']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira uma idade entre 0 e 99.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Data de Cadastro</label>
                    <input type="date" class="form-control" value="<?php echo ajustaData($brinquedo['data_cad']); ?>" disabled required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                	Pré-visualização da imagem
                    <img id="imgPreview" name="imgPreview" class="card-img-top" src="<?php echo "imagens/" . $brinquedo['foto']; ?>" alt="Card image" style="width:100%;height:;object-fit:cover;">
                </div>
                <div class="form-group col-md-8">
                    <label for="campo3">Imagem</label> 
                    <input type="file" id="imagemBrinquedo" class="form-control is-valid" name="imagemBrinquedo" accept="image/png, image/jpg, image/jpeg, image/gif">
                </div>
            </div>
            <div id="actions" class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
                    <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
                </div>
            </div>
        </form>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>
          $(document).ready(()=>{
            $('#imagemBrinquedo').change(function(){
              const file = this.files[0];
              if (file && (file['name'].endsWith(".png") || file['name'].endsWith(".jpg") || file['name'].endsWith(".jpeg") || file['name'].endsWith(".gif"))) {
                let reader = new FileReader();
                reader.onload = function(event){
                  $('#imgPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
              } else {
                $('#imgPreview').attr('src', "<?php echo "imagens/" . $brinquedo['foto']; ?>");
                $('#imagemBrinquedo').addClass('is-valid');
                $('#imagemBrinquedo').removeClass('is-invalid');
              }
            });
          });
		</script>

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