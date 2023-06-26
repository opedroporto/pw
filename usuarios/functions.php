<?php

require("../inc/functions.php");

$usuarios = null;
$usuario = null;

/**
 *  Listagem de Usuários
 */
function indexUsuario() {
	global $usuarios;
	if (!empty($_POST['users'])) {
		if (!empty($_POST['filtertype'])) {
			if ($_POST['filtertype'] == "contains") {
				$usuarios = filter("usuarios", "nome", $_POST['users'], "contains");
			} else if ($_POST['filtertype'] == "equalsto") {
				$usuarios = filter("usuarios", "nome", $_POST['users'], "equalsto");
			}
		} else {
			$usuarios = filter("usuarios", "nome", $_POST['users']);
			//$usuarios = filter("usuarios", "nome like '%" . $_POST['users'] . "%'");
		}
	} else {
		$usuarios = find_all("usuarios");
	}
}

/**
 * Cadastro de Usuários
 */
function addUsuario() {
	if (!empty($_POST['usuario'])) {
		try {
			$usuario = $_POST['usuario'];

			if (!empty($_FILES["imagemUsuario"]["name"])) {
				$target_dir = "imagens/";
				$filename = generateRandomString();
				$path = $_FILES['imagemUsuario']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$imgName = $filename . "." . $ext;
				//$target_file = $target_dir . basename($_FILES["imagemBrinquedo"]["name"]);
				$target_file = $target_dir . $imgName;

				$uploadOk = 1;	
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
											
				// Check if image file is a actual image or fake image
				if (isset($_POST["submit"])) {
					$check = getimagesize($_FILES["imagemUsuario"]["tmp_name"]);
					if ($check !== false) {
						$uploadOk = 1;
					} else {
						$_SESSION['message'] = 'O arquivo não é uma imagem.';
						$_SESSION['type'] = 'danger';
						$uploadOk = 0;
					}
				}
	
				// Check if file already exists
				if (file_exists($target_file)) {
					$_SESSION['message'] = 'O arquivo já existe.';
					$_SESSION['type'] = 'danger';
					$uploadOk = 0;
				}
	
				// Check file size
				if ($_FILES["imagemUsuario"]["size"] > 5000000) {
					$_SESSION['message'] = 'O arquivo é muito grande.';
					$_SESSION['type'] = 'danger';
					$uploadOk = 0;
				}
	
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					$_SESSION['message'] = 'Somente arquivos JPG, JPEG, PNG & GIF são suportados.<br>';
					$_SESSION['type'] = 'danger';
					$uploadOk = 0;
				}
	
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					$_SESSION['message'] = 'Desculpe, o arquivo não pode ser enviado.';
					$_SESSION['type'] = 'danger';
					exit();
				// if everything is ok, try to upload file
				} else {
					var_dump($target_file);
					if (move_uploaded_file($_FILES["imagemUsuario"]["tmp_name"], $target_file)) {
						//$nomearquivo = $_FILES['imagemUsuario']['name'];
						$nomearquivo = $imgName;
					}
				}
			} else {
				$nomearquivo = "semImagem.png";
			}

			if (!empty($usuario['password'])) {
				$senha = criptografia($usuario['password']);
				$usuario['password'] = $senha;
			}
			
			$usuario['foto'] = $nomearquivo;

			save('usuarios', $usuario);
			header('location: index.php');

		} catch (Exception $e) {
			$_SESSION['message'] = "Aconteceu um erro: " .  $e->getMessage();
			$_SESSION['type'] = "danger";
		}
	}
}

function editUsuario() {

	$now = new DateTime("now");
	// date_create('now', new DateTimeZone('America/Sao_Paulo'));

	if (isset($_GET['id'])) {
	
		$id = $_GET['id'];

		// POST
		if (isset($_POST['usuario'])) {
			
			// edit with image change
			if (isset($_FILES['imagemUsuario'])) {
				if ($_FILES['imagemUsuario']['name'] != "") {

					$target_dir = "imagens/";
					$filename = generateRandomString();
					$path = $_FILES['imagemUsuario']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$imgName = $filename . "." . $ext;
					//$target_file = $target_dir . basename($_FILES["imagemBrinquedo"]["name"]);
					$target_file = $target_dir . $imgName;

					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
												
					// Check if image file is a actual image or fake image
					if (isset($_POST["submit"])) {
						$check = getimagesize($_FILES["imagemUsuario"]["tmp_name"]);
						if ($check !== false) {
							$uploadOk = 1;
						} else {
							$_SESSION['message'] = 'O arquivo não é uma imagem.';
							$_SESSION['type'] = 'danger';
							$uploadOk = 0;
						}
					}
		
					// Check if file already exists
					if (file_exists($target_file)) {
						$_SESSION['message'] = 'O arquivo já existe.';
						$_SESSION['type'] = 'danger';
						$uploadOk = 0;
					}
		
					// Check file size
					if ($_FILES["imagemUsuario"]["size"] > 5000000) {
						$_SESSION['message'] = 'O arquivo é muito grande.';
						$_SESSION['type'] = 'danger';
						$uploadOk = 0;
					}
		
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif" ) {
						$_SESSION['message'] = 'Somente arquivos JPG, JPEG, PNG & GIF são suportados.<br>';
						$_SESSION['type'] = 'danger';
						$uploadOk = 0;
					}
		
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						$_SESSION['message'] = 'Desculpe, o arquivo não pode ser enviado.<br';
						$_SESSION['type'] = 'danger';
					// if everything is ok, try to upload file
					} else {
						// ACTUALLY EDIT
						$usuario = $_POST['usuario'];
						//$usuario['foto'] = $_FILES["imagemUsuario"]["name"];
						$usuario['foto'] = $imgName;
						if (!empty($usuario['password'])) {
							$senha = criptografia($usuario['password']);
							$usuario['password'] = $senha;
						}
						if (find("usuarios", $id)['foto'] != "semImagem.png") {
							unlink($target_dir . find("usuarios", $id)['foto']);
						}
						move_uploaded_file($_FILES["imagemUsuario"]["tmp_name"], $target_file);
						if (isset($_SESSION) && $_SESSION['user'] == $usuario['user']) {
							$_SESSION['foto'] = $usuario['foto'];
						}

						update("usuarios", $id, $usuario);
						header("location: index.php");
					}
				} else {

					$target_dir = "imagens/";
					$filename = generateRandomString();
					$path = $_FILES['imagemUsuario']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$imgName = $filename . "." . $ext;
					//$target_file = $target_dir . basename($_FILES["imagemBrinquedo"]["name"]);
					$target_file = $target_dir . $imgName;

					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

					// ACTUALLY EDIT
					$usuario = $_POST['usuario'];
					$usuario['foto'] = "semImagem.png";
					if (!empty($usuario['password'])) {
						$senha = criptografia($usuario['password']);
						$usuario['password'] = $senha;
					}
					if (find("usuarios", $id)['foto'] != "semImagem.png") {
						unlink($target_dir . find("usuarios", $id)['foto']);
					}
					move_uploaded_file($_FILES["imagemUsuario"]["tmp_name"], $target_file);
					if (isset($_SESSION) && $_SESSION['user'] == $usuario['user']) {
						$_SESSION['foto'] = $usuario['foto'];
					}

					update("usuarios", $id, $usuario);
					header("location: index.php");
				}
			}
			// edit without image change
			else {
				// ACTUALLY EDIT
				$usuario = $_POST['usuario'];
				if (!empty($usuario['password'])) {
					$senha = criptografia($usuario['password']);
					$usuario['password'] = $senha;
				}
				
				update("usuarios", $id, $usuario);
				header("location: index.php");
			}
		// GET
		} else {
			global $usuario;
			$usuario = find("usuarios", $id);
		} 
	} else {
		header("location: index.php");
	}
}

/**
 *  Visualização de um Usuário
*/
function viewUsuario($id = null) {
	global $usuario;
	$usuario = find("usuarios", $id);
}

/**
 *  Exclusão de um Usuário
 */
function deleteUsuario($id = null) {

	global $usuario;
	$usuario = remove("usuarios", $id);

	header("location: index.php");
}
?>