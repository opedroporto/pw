 <?php
	require("../inc/functions.php");
	
	/**
	 * MODIFICADO: Listagem de Motos
	 */
	function indexMotos() {
		global $motos;
		$motos = find_all('motos');
	}

	/**
	 * MODIFICADO: Cadastro de Motos
	 */

	function addMoto() {

		if (!empty($_POST['moto'])) {
			$target_dir = "imagens/";
			$target_file = $target_dir . basename($_FILES["imagemMoto"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
										
			// Check if image file is a actual image or fake image
			if (isset($_POST["submit"])) {
				$check = getimagesize($_FILES["imagemMoto"]["tmp_name"]);
				if ($check !== false) {
					//echo "O arquivo é uma imagem - " . $check["mime"] . ".<br>";
					$uploadOk = 1;
				} else {
					echo "O arquivo não é uma imagem.<br>";
					$uploadOk = 0;
				}
			}

			// Check if file already exists
			if (file_exists($target_file)) {
				echo "O arquivo já existe.<br>";
				$uploadOk = 0;
			}

			// Check file size
			if ($_FILES["imagemMoto"]["size"] > 5000000) {
				echo "O arquivo é muito grande.<br>";
				$uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				echo "Somente arquivos JPG, JPEG, PNG & GIF são suportados.<br>";
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Desculpe, o arquivo não pode ser enviado.<br>";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["imagemMoto"]["tmp_name"], $target_file)) {
					$today = new DateTime("now");

					$moto = $_POST['moto'];
					$moto['imagem'] = $_FILES['imagemMoto']['name'];
					$moto['modificado'] = $today->format("Y-m-d H:i:s");
				
					save('motos', $moto);
					header('location: index.php');
				} else {
					echo "Desculpe, o arquivo não pode ser enviado.<br>";
				}
			}
		}
	}

	/**
	 * MODIFICADO: Edita Moto
	 */
	function editMoto() {
		$now = new DateTime("now");
		// date_create('now', new DateTimeZone('America/Sao_Paulo'));
		
		if (isset($_GET['id'])) {
			$id = $_GET['id'];

			// POST
			if (isset($_POST['moto'])) {

				// edit with image change
				if ($_FILES['imagemMoto']['name'] != "") {
					echo $_FILES['imagemMoto']['name'];
					$target_dir = "imagens/";
					$target_file = $target_dir . basename($_FILES["imagemMoto"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
												
					// Check if image file is a actual image or fake image
					if (isset($_POST["submit"])) {
						$check = getimagesize($_FILES["imagemMoto"]["tmp_name"]);
						if ($check !== false) {
							//echo "O arquivo é uma imagem - " . $check["mime"] . ".<br>";
							$uploadOk = 1;
						} else {
							echo "O arquivo não é uma imagem.<br>";
							$uploadOk = 0;
						}
					}
		
					// Check if file already exists
					if (file_exists($target_file)) {
						echo "O arquivo já existe.<br>";
						$uploadOk = 0;
					}
		
					// Check file size
					if ($_FILES["imagemMoto"]["size"] > 5000000) {
						echo "O arquivo é muito grande.<br>";
						$uploadOk = 0;
					}
		
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif" ) {
						echo "Somente arquivos JPG, JPEG, PNG & GIF são suportados.<br>";
						$uploadOk = 0;
					}
		
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "Desculpe, o arquivo não pode ser enviado.<br>";
					// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES["imagemMoto"]["tmp_name"], $target_file) && unlink($target_dir . find("motos", $id)['imagem'])) {
							// ACTUALLY EDIT
							$moto = $_POST['moto'];
							$moto['imagem'] = $_FILES["imagemMoto"]["name"];
							$moto['modificado'] = $now->format("Y-m-d H:i:s");
						
							update("motos", $id, $moto);
							header("location: index.php");
						} else {
							echo "Desculpe, o arquivo não pode ser enviado.<br>";
						}
					}
				}
				// edit without image change
				else {
					// ACTUALLY EDIT
					$moto = $_POST['moto'];
					$moto['modificado'] = $now->format("Y-m-d H:i:s");
				
					update("motos", $id, $moto);
					header("location: index.php");
				}
			}
			// GET
			global $moto;
			$moto = find("motos", $id);
		}
		else {
			header("location: index.php");
		}
	}
	
	/**
	 * MODIFICADO: Visualização de uma Moto
	 */
	function viewMoto($id = null) {
		global $moto;
		$moto = find("motos", $id);
	}

	/**
	 *  MODIFICADO: Exclusão de uma Moto
	 */
	function deleteMoto($id = null) {

		global $moto;
		global $motos;
		
		$motos = find("motos", $id);
		
		$dirImg = "imagens/" . $motos['imagem'];
		$nomeImg = $motos['imagem'];
		
		if (file_exists($dirImg) && $dirImg != "semImagem.png") {
			unlink($dirImg);
		}
		
		$moto = remove("motos", $id);
	
		header("location: index.php");
	}

?>