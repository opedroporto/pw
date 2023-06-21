<?php
	if(!isset($_SESSION)){session_start();}
	
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	date_default_timezone_set('America/Sao_Paulo');

	function pdo_connect_mysql () {
		$DATABASE_HOST = DB_HOST;
		$DATABASE_USER = DB_USER;
		$DATABASE_PASS = DB_PASSWORD;
		$DATABASE_NAME = DB_NAME;
		try {
			return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
		} catch (PDOException $exception) {
			// If there is an error with the connection, stop the script and display the error.
			exit('Falha ao conectar no banco de dados!');
		}
	}

	function close_database ($conn) {
		try {
			mysqli_close($conn);
		} catch (Exception $e) {
			echo "<h3>Ocorreu um errro: " . $e->getMessage() . "</h3>";
		}
	}
	
	/**
	 *  Pesquisa um Registro pelo ID em uma Tabela
	 */
	function find ($table = null, $id = null) {
	  
		$pdo = pdo_connect_mysql();
		$found = null;

		try {
		  if ($id) {
			
			// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
			$sql = "SELECT * FROM "  . $table;

			$stmt = $pdo->prepare($sql . " WHERE id=?");
			$stmt->execute([$id]);

			$found = $stmt->fetch();

			/*
			$sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
			$result = $database->query($sql);
			
			if ($result->num_rows > 0) {
			  $found = $result->fetch_assoc();
			}
			*/
			
		  } else {

			$sql = "SELECT * FROM $table";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			
			$found = $stmt->fetchAll(PDO::FETCH_ASSOC);

			/*
			$sql = "SELECT * FROM " . $table;
			$result = $database->query($sql);
			*/
			
		  }
		} catch (Exception $e) {
		  $_SESSION['message'] = $e->GetMessage();
		  $_SESSION['type'] = 'danger';
	  	}
		
		// close_database($database);
		return $found;
	}
	/**
	 *  Pesquisa Todos os Registros de uma Tabela
	 */
	function find_all( $table ) {
		return find($table);
	}

	/**
	*  Insere um registro no BD
	*/
	function save ($table = null, $data = null) {

		$pdo = pdo_connect_mysql();
	
		$columns = null;
		$values = null;
	
		//print_r($data);
	
		foreach ($data as $key => $value) {
			$columns .= trim($key, "'") . ",";
			$values .= "'$value',";
		}
	
		// remove a ultima virgula
		$columns = rtrim($columns, ',');
		$values = rtrim($values, ',');

		$sql = "INSERT INTO " . $table . "(" . $columns . ") VALUES (" . $values . ")";
		$stmt = $pdo->prepare($sql);
		/*
			$sql = "INSERT INTO " . $table;
			$stmt = $pdo->prepare($sql . " (?) VALUES (?)");
			$stmt->execute([$columns, $values]);
		*/
		try {
			$stmt->execute();
		
			$_SESSION['message'] = "Registro cadastrado com sucesso.";
			$_SESSION['type'] = "success";
		
		} catch (Exception $e) { 
		
			$_SESSION['message'] = "Não foi possivel realizar a operação. " . $e->getMessage();
			$_SESSION['type'] = "danger";
		}
		
		//close_database($database);
	}

	/**
	 *  Atualiza uma linha de uma tabela pelo ID do registro
	 */
	function update ($table = null, $id = 0, $data = null) {

		$pdo = pdo_connect_mysql();

		$items = null;

		foreach ($data as $key => $value) {
			$items .= trim($key, "'") . "='$value',";
		}

		// remove a ultima virgula
		$items = rtrim($items, ',');

		$sql  = "UPDATE " . $table;
		$sql .= " SET $items";
		$sql .= " WHERE id=" . $id . ";";

		$stmt = $pdo->prepare($sql . " SET ? WHERE id = ?");
		$stmt->execute([$items, $id]);

		try {
			$stmt->execute();

			$_SESSION['message'] = 'Registro atualizado com sucesso.';
			$_SESSION['type'] = 'success';

		} catch (Exception $e) { 

			$_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
			$_SESSION['type'] = 'danger';
		} 

		close_database($database);
	}

	/**
	 *  Remove uma linha de uma tabela pelo ID do registro
	 */
	function remove ($table = null, $id = null ) {

		$pdo = pdo_connect_mysql();
		
		try {
			if ($id) {
				$sql = "DELETE FROM " . $table;
				$stmt = $pdo->prepare($sql  . " WHERE id = ?");
				$stmt->execute([$id]);
		
				$_SESSION['message'] = "Registro Removido com Sucesso." ;
				$_SESSION['type'] = "success";
			}
		} catch (Exception $e) { 
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = "danger";
		}
	
		close_database($database);
	}
	
	function criptografia ($senha) {
		$custo = "08";
		$salt = 'Cf1f11ePArKlBJomM0F6aJ';

		$hash = crypt($senha, "$2a$" . $custo . "$" . $salt . "$");

		return $hash;
	}

	function filter ($table = null, $column = null, $param = null, $filtertype = "contains") {
		$pdo = pdo_connect_mysql();
		$found = null;
		
		try {
			if ($column && $param) {
				if ($filtertype == "equalsto") {
					$sql = "SELECT * FROM " . $table . " WHERE " . $column . " = '" . $param . "';";
				} else if ($filtertype == "contains") {
					$sql = "SELECT * FROM " . $table . " WHERE " . $column . " like '%" . $param . "%';";
				}
              	$stmt = $pdo->prepare($sql);
				//$stmt = $pdo->prepare($sql . " like CONCAT('%', ?, '%')");
				//$stmt->execute([$param]);
				$stmt->execute();

				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

				if (sizeof($result) > 0) {
                  //$found = array();
                  $found = $result;
				} else {
					throw new Exception("Não foram encontrados registros de dados!");
				}
			}
		} catch (Exception $e ) {
			$_SESSION['message'] = "Ocorreu um erro: " . $e->GetMessage();
			$_SESSION['type'] = "danger";
		}
		
		//close_database($database);
		return $found;
	}

	/**
	 *  Pesquisa um Registro pelo user na tabela usuarios
	 */
	function login($user = null, $password) {
		
		$pdo = pdo_connect_mysql();
		$found = null;

		$password = criptografia($password);

		try {
			if ($user && $password && strlen($user) > 0 && strlen($password) > 0) {
				
				$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE user = ? AND password = ?");
				$stmt->execute([$user, $password]);

				$count = $stmt->rowCount();
				if ($count > 0) {

					$found = $stmt->fetch();
					return $found;
				}

				//close_database($database);
				return false;
				
			} else {

				//close_database($database);
				return false;
			}
		} catch (Exception $e) {
			$_SESSION['message'] = $e->GetMessage();
			$_SESSION['type'] = 'danger';
			return false;
		}
	}

	function clear_messages () {
		if (isset($_SESSION['message'])) {
			unset($_SESSION['message']);
		}
		if (isset($_SESSION['type'])) {
			unset($_SESSION['type']);
		}
	}

	function makeSureUserIsAdmin () {
		if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
			$_SESSION['notLoggedMessage'] = "Você precisa estar logado como Administrador para acessar essa função.";
			$_SESSION['notLoggedType'] = "danger";

			header("location: " . BASEURL);
		}
	}
	function makeSureUserIsLogged () {
		if (!isset($_SESSION['user'])) {
			$_SESSION['notLoggedMessage'] = "Você precisa estar logado para acessar essa função.";
			$_SESSION['notLoggedType'] = "danger";

			header("location: " . BASEURL);
		}
	}

	function clear_notLoggedMessages () {
		if (isset($_SESSION['notLoggedMessage'])) {
			unset($_SESSION['notLoggedMessage']);
		}
		if (isset($_SESSION['notLoggedType'])) {
			unset($_SESSION['notLoggedType']);
		}
	}
?>