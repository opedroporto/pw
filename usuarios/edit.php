<?php 
    require("functions.php"); 
    editUsuario();
    require(HEADER_TEMPLATE);
    
    makeSureUserIsAdmin();
?>

    <?php if (isset($usuario)): ?>
        
        <header>
            <h2>Atualizar Usuário</h2>
        </header>

        <form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data">
            <hr>
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="campo1">Nome</label>
                    <input type="text" id="nomeUsuario" class="form-control is-valid" name="usuario[nome]" value="<?php echo $usuario['nome']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira um nome válido.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="campo1">Usuário (Login)</label>
                    <input type="text" id="loginUsuario" class="form-control is-valid" name="usuario[user]" value="<?php echo $usuario['user']; ?>" required>
                    <div class="invalid-feedback order-last">
                        Insira um usuário válido.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="form-check">
                        <input id="passwordCheckbox" name="passwordCheckbox" class="form-check-input" type="checkbox" value="">
                        <label class="form-check-label" for="passwordCheckbox">
                            Modificar senha
                        </label>
                    </div>
                    <input type="password" id="senhaUsuario" class="form-control" name="usuario[password]" disabled required>
                    <div class="invalid-feedback order-last">
                        Insira uma senha válida.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="form-check">
                        <input id="imagemCheckbox" name="imagemCheckbox" class="form-check-input" type="checkbox" value="">
                        <label class="form-check-label" for="imagemCheckbox">
                            Modificar imagem
                            <button id="procurarImagem" class="btn btn-secondary m-2" type="button" disabled><i class="fa-solid fa-wand-magic-sparkles"></i> Procurar imagem de <?php echo $usuario['nome']; ?></button>
                        </label>
                    </div>
                    <input type="file" id="imagemUsuario" name="imagemUsuario" class="form-control" accept="image/png, image/jpg, image/jpeg, image/gif" disabled>
                    <div class="invalid-feedback order-last">
                        Insira uma imagem válida.
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label id="previewLabel">Pré-Visualização</label>
                    <div class='card' style='width:400px'>
                        <div class='card-body'>
                            <img id="imgPreview" name="imgPreview" class='card-img-top' src='imagens/<?php echo $usuario['foto']; ?>' alt='Card image' style='width:100%'>
                        </div>
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

<script>
    $(document).ready(() => {
        imageVal = $("#nomeUsuario").val();
        $('#nomeUsuario').on("input", function() {
            imageVal = $("#nomeUsuario").val();
            $("#procurarImagem").html('<i class="fa-solid fa-wand-magic-sparkles"></i>' + " Procurar imagem de " + imageVal);
        })
        $("#procurarImagem").on("click", async function() {
            // Default options are marked with *
            const response = await fetch("/search.php", {
                method: "POST", // *GET, POST, PUT, DELETE, etc.
                mode: "cors", // no-cors, *cors, same-origin
                cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
                credentials: "same-origin", // include, *same-origin, omit
                headers: {
                    "Content-Type": "application/json",
                // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: "follow", // manual, *follow, error
                referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify({
                    "imageVal": imageVal
                }), // body data type must match "Content-Type" header
            });

            let images = await response.json();
            for (var i = 0; i < images.length; i++) {
                try {
                    let imageUrl = images[i]['contentUrl']
                    let index = imageUrl.lastIndexOf("/") + 1;
                    //let filename = imageUrl.substr(index);
                    
                    let response = await fetch(imageUrl).then();
                    let blob = await response.blob()
                    let mimetype = response.headers.get("Content-Type")

                    let filename = imageVal + "." + mimetype.substr(mimetype.lastIndexOf("/") + 1);

                    var file = new File([blob], filename, {type: "image/" + filename.split('.').pop()});

                    if (file['type'] != "image/webp") {
    
                        // Create a new DataTransfer object and assign the file to it
                        var dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
    
                        // Assign the DataTransfer object to the input element
                        var inputFile = document.getElementById('imagemUsuario');
                        inputFile.files = dataTransfer.files;

                        
                        $('#imgPreview').attr('src', imageUrl);
                        
                        $("#imagemUsuario").removeClass("is-invalid");
                        $("#imagemUsuario").addClass("is-valid");
                        break;
                    }
                } catch {}
            }


        })

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

        $("#passwordCheckbox").change(function() {
            if(this.checked) {
                /* modifica */
                $("#senhaUsuario").prop("disabled", false);
                $("#senhaUsuario").addClass("is-invalid");
            } else {
                /* NÃO modifica */
                $("#senhaUsuario").val("");
                $("#senhaUsuario").prop("disabled", true);
                $("#senhaUsuario").removeClass("is-invalid");
                $("#senhaUsuario").removeClass("is-valid");
            }
        });
        $("#imagemCheckbox").change(function() {
            if(this.checked) {
                /* modifica */
                $('#imgPreview').attr('src', "imagens/semImagem.png");
                $("#imagemUsuario").prop("disabled", false);
                $("#imagemUsuario").addClass("is-valid");
                $("#procurarImagem").prop("disabled", false);
            } else {
                /* NÃO modifica */
                $('#imgPreview').attr('src', "imagens/<?php echo $usuario['foto']; ?>");
                $("#imagemUsuario").val("");
                $("#imagemUsuario").prop("disabled", true);
                $("#imagemUsuario").removeClass("is-invalid");
                $("#imagemUsuario").removeClass("is-valid");
                $("#procurarImagem").prop("disabled", true);
            }
        });
    });
</script>