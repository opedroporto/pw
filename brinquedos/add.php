<?php 
  require("functions.php"); 
  addBrinquedos();
  makeSureUserIsLogged();
?>

<?php include(HEADER_TEMPLATE); ?>

        <header>
            <h2>Novo Brinquedo</h2>
        </header>

        <form id="addForm" action="add.php" method="post" enctype="multipart/form-data">
            <!-- area de campos do form -->
            <hr>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="campo1">Modelo do brinquedo</label>
                    <input type="text" id="nomeBrinquedo" class="form-control is-invalid" name="brinquedo['modelo']" required>
                    <div class="invalid-feedback order-last">
                        Insira um modelo válido.
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="campo2">Marca</label>
                    <input type="text" id="marcaBrinquedo" class="form-control is-invalid" name="brinquedo['marca']" required>
                    <div class="invalid-feedback order-last">
                        Insira uma marca válida.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Idade recomendada</label>
                    <input type="number" id="faixaEtariaBrinquedo" class="form-control is-invalid number-field" name="brinquedo['faixa_etaria']" min="0" max="99" oninput="this.value = Math.abs(this.value)" required>
                    <div class="invalid-feedback order-last">
                        Insira uma idade entre 0 e 99.
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="campo3">Data de Cadastro</label>
                    <input type="date" class="form-control" name="brinquedo['data_cad']" disabled required>
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-4">
                	Pré-visualização da imagem
                    <img id="imgPreview" name="imgPreview" class="card-img-top" src="imagens/semImagem.png" alt="Card image" style="width:100%;">
                </div>
                <div class="form-group col-md-8">
                    <label for="campo3">Imagem</label>
                    <input type="file" id="imagemBrinquedo" class="form-control is-invalid" name="imagemBrinquedo" accept="image/png, image/jpg, image/jpeg, image/gif" required>
                    <div class="invalid-feedback order-last">
                        Insira uma imagem válida (PNG, JPG ou GIF).
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
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>
            $(document).ready(()=>{

                function readBuffer(file, start = 0, end = 2) {
                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();
                        reader.onload = () => {
                        resolve(reader.result);
                        };
                        reader.onerror = reject;
                        reader.readAsArrayBuffer(file.slice(start, end));
                    });
                }

                function check(headers) {
                    return (buffers, options = { offset: 0 }) =>
                        headers.every(
                            (header, index) => {
                                //console.log(header, buffers[options.offset + index]);
                                if (header === "?") {
                                    return true;
                                }
                                return header === buffers[options.offset + index];
                            }
                        );
                }
                
                const isPNG = check([0x89, 0x50, 0x4e, 0x47, 0x0d, 0x0a, 0x1a, 0x0a]);
                const isJPG = check([0xff, 0xd8, 0xff, 0xdb]);
                const isJPG2 = check([0xff, 0xd8, 0xff, 0xe0, 0x00, 0x10, 0x4a, 0x46, 0x49, 0x46, 0x00, 0x01]);
                const isJPG3 = check([0xff, 0xd8, 0xff, 0xee]);
                const isJPG4 = check([0xff, 0xd8, 0xff, 0xe1, "?", "?", 0x45, 0x78, 0x69, 0x66, 0x00, 0x00]);
                const isJPG5 = check([0xff, 0xd8, 0xff, 0xe8]);
                const isGIF = check([0x47, 0x49, 0x46, 0x38, 0x37, 0x61])
                const isGIF2 = check([0x47, 0x49, 0x46, 0x38, 0x39, 0x61]);
                const isWEBP = check([0x52, 0x49, 0x46, 0x46, "?", "?", "?", "?", 0x57, 0x45, 0x42, 0x50]);

                $("#addForm").submit(async function(e){
                });
                // Helper function to convert data URL to File object
                function dataURLtoFile(dataUrl, filename) {
                    var arr = dataUrl.split(',');
                    var mime = arr[0].match(/:(.*?);/)[1];
                    var bstr = atob(arr[1]);
                    var n = bstr.length;
                    var u8arr = new Uint8Array(n);
                    while (n--) {
                        u8arr[n] = bstr.charCodeAt(n);
                    }
                    return new File([u8arr], filename, { type: mime });
                }
                
                $('#imagemBrinquedo').change(async function(e) {
                    var file = this.files[0];
                    const buffers = await readBuffer(file, 0, 12);
                    const uint8Array = new Uint8Array(buffers);
                    let image_types = isPNG(uint8Array) ? ["image/png"] : isJPG(uint8Array) || isJPG2(uint8Array) || isJPG3(uint8Array) || isJPG4(uint8Array) || isJPG5(uint8Array) ? ["image/jpeg", "image/jpg"] : isGIF(uint8Array) || isGIF2(uint8Array) ? ["image/gif"] : isWEBP(uint8Array) ? ["image/webp"] : []

                    //console.log(image_types, file['type']);
                    // do not allow webp: convert it to png
                    if (image_types.includes("image/webp")) {
                        //alert("converting webp...");
                        /*
                        $(this).val(null);
                        $('#imgPreview').attr('src', "imagens/semImagem.png");
                        $(this).addClass("is-invalid");
                        $(this).removeClass("is-valid");
                        return false;
                        */
                        
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            var webpImage = new Image();
                            webpImage.src = event.target.result;
                            
                            webpImage.onload = function() {
                                var canvas = document.createElement('canvas');
                                canvas.width = webpImage.width;
                                canvas.height = webpImage.height;
                                
                                var ctx = canvas.getContext('2d');
                                ctx.drawImage(webpImage, 0, 0);
                                
                                var pngDataUrl = canvas.toDataURL('image/png');

                                // Create a hidden input element
                                var hiddenInput = $('<input>')
                                    .attr('type', 'hidden')
                                    .attr('name', 'convertedPng')
                                    .attr('value', pngDataUrl);
                                
                                // Append the hidden input to the form
                                $('#addForm').append(hiddenInput);
                                
                                // Convert the image to PNG format
                                canvas.toBlob(function(blob) {
                                    let fileName = file['name'].substr(0, file['name'].lastIndexOf(".")) + ".png";
                                
                                    var pngFile = new File([blob], fileName, { type: 'image/png' });

                                    // Create a new DataTransfer object and assign the file to it
                                    var dataTransfer = new DataTransfer();
                                    dataTransfer.items.add(pngFile);
                                    // Assign the DataTransfer object to the input element
                                    var inputFile = document.getElementById('imagemBrinquedo');
                                    inputFile.files = dataTransfer.files;

                                    // Display the converted PNG image
                                    var pngUrl = URL.createObjectURL(pngFile);
                                    $('#imgPreview').attr('src', pngUrl);
                                }, 'image/png');

                            };
                        };

                        reader.readAsDataURL(file);
                                                
        
                    // convert to original image type
                    } else if (!image_types.includes(file['type'])) {
    
                        let fileName = file['name'].substr(0, file['name'].lastIndexOf(".")) + "." + image_types[0].substr(image_types[0].lastIndexOf("/") + 1, image_types[0].length);
    
                        var blob = file.slice(0, file.size, image_types[0]); 
                        file = new File([blob], fileName, {type: image_types[0]});
    
                        //this.files[1] = file;
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        this.files = dataTransfer.files;
                    }
                    
                    // change preview
                    if (file && (file['type'] == "image/png" || file['type'] == "image/jpg" || file['type'] == "image/jpeg" || file['type'] == "image/gif"|| file['type'] == "image/webp")) {
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
