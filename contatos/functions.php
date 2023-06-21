 <?php

	require("../inc/functions.php");

	$contatos = null;
	$contato = null;
 	
	/**
	 *  Listagem de Contato
	 */
	function indexContato() {
		global $contatos;
		if (!empty($_POST['contatos'])) {
			if (!empty($_POST['filtertype'])) {
				if ($_POST['filtertype'] == "contains") {
					$contatos = filter("contacts", "name", $_POST['contatos'], "contains");
				} else if ($_POST['filtertype'] == "equalsto") {
					$contatos = filter("contacts", "name", $_POST['contatos'], "equalsto");
				}
			} else {
				$contatos = filter("contacts", "name", $_POST['contatos']);
				//$usuarios = filter("usuarios", "nome like '%" . $_POST['users'] . "%'");
			}
		} else {
			$contatos = find_all("contacts");
		}
	}

	/**
	 * Cadastro de Contato
	 */
	function addContato() {

		if (!empty($_POST['contato'])) {
		
			$today = new DateTime("now");

			$contato = $_POST['contato'];
		
			save('contacts', $contato);
			header('location: index.php');
		}
	}

	function editContato() {

		$now = new DateTime("now");
		// date_create('now', new DateTimeZone('America/Sao_Paulo'));
	
		if (isset($_GET['id'])) {
		
			$id = $_GET['id'];
		
			if (isset($_POST['contato'])) {
		
				$contato = $_POST['contato'];
			
				update("contacts", $id, $contato);
				header("location: index.php");
			} else {

				global $contato;
				$contato = find("contacts", $id);
			} 
		} else {
			header("location: index.php");
		}
	}
	

	/**
	 *  Visualização de um Contato
	*/
	function viewContato($id = null) {
		global $contato;
		$contato = find("contacts", $id);
	}

	/**
	 *  Exclusão de um Contato
	 */
	function deleteContato($id = null) {

		global $contato;
		$contato = remove("contacts", $id);
	
		header("location: index.php");
	}

?>