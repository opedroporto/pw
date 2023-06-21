<?php
    require('../config.php');
    require(DBAPI);

	// Modificado: funções ajusta
	function ajustaData ($data){
        $d= new DateTime($data);
        return $d->format("Y-m-d");
    }

	function ajustaCPF ($cpf){
        return preg_replace("/[^0-9]/", "", $cpf);
    }
	
	function formataData ($data, $formato) {
        $d = new DateTime($data);
        return $d->format($formato); //"d/m/Y H:i:s"
    }
	
    function formataTelefone ($fone) {
        return "(" . substr($fone,0,2) . ") " .
			substr($fone, 2 , strlen($fone) - 6)
			. "-" . substr($fone, strlen($fone) - 4, 4);
    }

	// Modificado:
	function formataCEP ($cep) {
		return substr($cep,0,5) . "-" . substr($cep,5,7);
	}

	function formataPreco ($preco) {
		return "R$" . number_format($preco, 2, ",", ".");
	}


	# formata IE
	function formataIE ($ie) {
		$novoie = "";
		$i = 1;
		foreach (str_split($ie) as $char) {
			if ($i % 3 == 0) {
				$novoie = $novoie . ".";
			}
			$novoie = $novoie . $char;
			$i += 1;
		}
		return $novoie;
	}

	# formata CPF
	function formataCPF ($cpf) {
		// cpf
		if (strlen($cpf) == 11) {
			return substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "."  . substr($cpf, 9, 2);
		}
		// cnpj
		else if (strlen($cpf) == 14) {
			$cnpj = $cpf;
			return substr($cnpj, 0, 2) . "." . substr($cnpj, 2, 3) . "." . substr($cnpj, 5, 3) . "/"  . substr($cnpj, 8, 4) . "-"  . substr($cnpj, 12, 2);
		}
		else {
			return $cpf;
		}
	}

	require("fpdf/fpdf.php");

	class PDF extends FPDF
	{
	// Page header
	function Header()
	{
		// Logo
		$this->Image(BASEURL . 'assets/novoFavicon.png', 10, 6, 30);
		// Arial bold 15
		$this->SetFont('Arial','B',15);
		// Color
		$this->SetTextColor(0,27,109);
		// Move to the right
		$this->Cell(($this->GetPageWidth() / 2) - 15);
		// Title
		$this->Cell(30, 15,'CRUD PW - Relatorio',0,0,'C');
		// Line break
		$this->Ln(20);
	}

	// Colored table
	function FancyTable($header, $data, $max_lengths, $images_mask, $images_folder, $table_width, $title, $left_margin) {

		// Colors, line width and bold font
		$this->SetFillColor(3,169,244);
		$this->SetTextColor(255);
		$this->SetDrawColor(0,27,109);
		$this->SetLineWidth(0.1);
		//$this->SetFont('','B');
		
		$this->SetFont('Arial', 'B', 15);

		// Table Title
		$this->Cell($left_margin);
		$this->Cell($table_width, 12, $title,1,0,'C',true);	
		$this->Ln();

		$this->SetFont('Arial', '', 10);
		
		// Header
		$this->Cell($left_margin);
		for($i=0;$i<count($header);$i++)
			if ($images_mask[$i]) {
				$this->Cell(16,8,$header[$i],1,0,'C',true);
			} else {
				$this->Cell($max_lengths[$i] + 2,8,$header[$i],1,0,'C',true);
			}
		$this->Ln();

		// Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		$fill = false;

		foreach($data as $row)
		{
			$this->Cell($left_margin);
			$closing_line = 0;
			$i = 0;
			foreach($row as $col) {
				if ($col == null)
					$col = "N/A";
				if ($images_mask[$i]) {
				
					//$this->Cell(16, 16, $this->Image(BASEURL . $images_folder . $col, $this->GetX() + 1, $this->GetY() + 1, 14, 14),'LR',0,'L')
					try {
						//$img = imagecreatefromstring(file_get_contents(BASEURL . $images_folder . $col));
						//imageresolution($img, 200, 200);
						//imagejpeg($img, BASEURL . $images_folder . "teste" . $col);
						//file_put_contents(BASEURL . $images_folder . "teste" . $col, $img);
						//$path = $col;
						//$img = imagecreatefromjpeg(BASEURL . $images_folder . $col);

						//imagejpeg($img, "imagens/" . $path);

						//$this-
						$this->Cell(16, 16, $this->Image(BASEURL . $images_folder . $col, $this->GetX() + 1, $this->GetY() + 1, 14, 14),'LR',0,'L');


						$closing_line += 16;
					} catch (Exception $e) {
						$this->Cell(16, 16, "",'LR',0,'L',$fill);

						$closing_line += 16;
					}
				} else {
					$this->Cell($max_lengths[$i] + 2,16, $col,'LR',0,'L',$fill);
					$closing_line += $max_lengths[$i] + 2;
				}
				$i++;
			}
			$this->Ln();
			$fill = !$fill;
		}
		// Closing line
		$this->Cell($left_margin);
		$this->Cell($closing_line, 0, '', 'T');
	}

	// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	}
?>
