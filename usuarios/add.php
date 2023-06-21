<?php 
  require("functions.php"); 
  addUsuario();
  makeSureUserIsAdmin();
?>

<?php include(HEADER_TEMPLATE); ?>

        <header>
            <h2>Novo Usuário</h2>
        </header>

        <form action="add.php" method="post" class="needs-validation" enctype="multipart/form-data">
        <!-- area de campos do form -->
            <hr>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="campo1">Nome</label>
                    <input type="text" id="nomeUsuario" class="form-control is-invalid" name="usuario[nome]" required>
                    <div class="invalid-feedback order-last">
                        Insira um nome válido.
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="campo1">Usuário (Login)</label>
                    <input type="text" id="loginUsuario" class="form-control is-invalid" name="usuario[user]" required>
                    <div class="invalid-feedback order-last">
                        Insira um usuário válido.
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="campo1">Senha</label>
                    <input type="password" id="senhaUsuario" class="form-control is-invalid" name="usuario[password]" required>
                    <div class="invalid-feedback order-last">
                        Insira uma senha válida.
                    </div>
                </div>
            </div>

            <div class="row">
              	<div class="form-group col-md-4">
                    <label>Pré-Visualização</label>
                    <div class='card' style='width:400px'>
                        <div class='card-body'>
                            <img id="imgPreview" name="imgPreview" class='card-img-top' src='imagens/semImagem.png' alt='Card image' style='width:100%'>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <label>Imagem</label>
                    <input type="file" id="imagemUsuario" class="form-control is-invalid" name="imagemUsuario" accept="image/png, image/jpg, image/jpeg, image/gif">
                    <div class="invalid-feedback order-last">
                        Insira uma imagem válida.
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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>
            $(document).ready(() => {
              $('#imagemUsuario').change(function () {
                const file = this.files[0];
                if (file && (file['name'].endsWith(".png") || file['name'].endsWith(".jpg") || file['name'].endsWith(".jpeg") || file['name'].endsWith(".gif"))){
                    let reader = new FileReader();
                    reader.onload = function(event){
                        $('#imgPreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#imgPreview').attr('src', "imagens/semImagem.png");
                }
              });
            });
        </script>

<?php include(FOOTER_TEMPLATE); ?>