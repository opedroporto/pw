 <?php

	require("../inc/functions.php");

	$brinquedos = null;
	$brinquedo = null;
 	
	/**
	 *  MODIFICADO: Listagem de brinquedo
	 */
	function indexBrinquedos() {
		global $brinquedos;
		if (!empty($_POST['brinquedos'])) {
			if (!empty($_POST['filtertype'])) {
				if ($_POST['filtertype'] == "contains") {
					$brinquedos = filter("brinquedos", "modelo", $_POST['brinquedos'], "contains");
				} else if ($_POST['filtertype'] == "equalsto") {
					$brinquedos = filter("brinquedos", "modelo", $_POST['brinquedos'], "equalsto");
				}
			} else {
				$brinquedos = filter("brinquedos", "modelo", $_POST['brinquedos']);
				//$usuarios = filter("usuarios", "nome like '%" . $_POST['users'] . "%'");
			}
		} else {
			$brinquedos = find_all("brinquedos");
		}
	}

	/**
	 * MODIFICADO: Cadastro de brinquedo
	 */
	function addBrinquedos() {
		if (!empty($_POST['brinquedo'])) {
			$target_dir = "imagens/";
			$target_file = $target_dir . basename($_FILES["imagemBrinquedo"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image
			if (isset($_POST["submit"])) {
				$check = getimagesize($_FILES["imagemBrinquedo"]["tmp_name"]);
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
			if ($_FILES["imagemBrinquedo"]["size"] > 5000000) {
				echo "O arquivo é muito grande.<br>";
				$uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp"
				&& $imageFileType != "gif" ) {
				echo "Somente arquivos JPG, JPEG, PNG & GIF são suportados.<br>";
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Desculpe, o arquivo não pode ser enviado. :(<br>";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["imagemBrinquedo"]["tmp_name"], $target_file)) {
					$today = new DateTime("now");

					$brinquedo = $_POST['brinquedo'];
					$brinquedo['foto'] = $_FILES['imagemBrinquedo']['name'];
				
					save('brinquedos', $brinquedo);
					header('location: index.php');
				} else {
					echo "Desculpe, o arquivo não pode ser enviado.<br>";
				}
			}
		}
	}

	/**
	 * MODIFICADO: Edita brinquedo
	 */
	function editBrinquedos() {
		$now = new DateTime("now");
		// date_create('now', new DateTimeZone('America/Sao_Paulo'));
		
		if (isset($_GET['id'])) {
			$id = $_GET['id'];

			// POST
			if (isset($_POST['brinquedo'])) {

				// edit with image change
				if ($_FILES['imagemBrinquedo']['name'] != "") {
					echo $_FILES['imagemBrinquedo']['name'];
					$target_dir = "imagens/";
					$target_file = $target_dir . basename($_FILES["imagemBrinquedo"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
												
					// Check if image file is a actual image or fake image
					if (isset($_POST["submit"])) {
						$check = getimagesize($_FILES["imagemBrinquedo"]["tmp_name"]);
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
					if ($_FILES["imagemBrinquedo"]["size"] > 5000000) {
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
						if (move_uploaded_file($_FILES["imagemBrinquedo"]["tmp_name"], $target_file) && unlink($target_dir . find("brinquedos", $id)['foto'])) {
							// ACTUALLY EDIT
							$brinquedo = $_POST['brinquedo'];
							$brinquedo['foto'] = $_FILES["imagemBrinquedo"]["name"];
						
							update("brinquedos", $id, $brinquedo);
							header("location: index.php");
						} else {
							echo "Desculpe, o arquivo não pode ser enviado.<br>";
						}
					}
				}
				// edit without image change
				else {
					// ACTUALLY EDIT
					$brinquedo = $_POST['brinquedo'];
				
					update("brinquedos", $id, $brinquedo);
					header("location: index.php");
				}
			}
			// GET
			global $brinquedo;
			$brinquedo = find("brinquedos", $id);
		}
		else {
			header("location: index.php");
		}
	}
	
	/**
	 * MODIFICADO:  Visualização de um brinquedo
	*/
	function viewBrinquedos($id = null) {
		global $brinquedo;
		$brinquedo = find("brinquedos", $id);
	}

	/**
	 *  MODIFICADO: Exclusão de um brinquedo
	 */
	function deleteBrinquedos($id = null) {

		global $brinquedo;
		global $brinquedos;
		
		$brinquedos = find("brinquedos", $id);
		
		$dirImg = "imagens/" . $brinquedos['foto'];
		$nomeImg = $brinquedos['foto'];
		
		if (file_exists($dirImg) && $dirImg != "semImagem.png") {
			unlink($dirImg);
		}
		
		$brinquedo = remove("brinquedos", $id);
	
		header("location: index.php");
	}

?>
