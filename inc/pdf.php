<?php
    require("functions.php");

    $table = $_GET['category'];
    if ($table == "brinquedos") {
        $header = ["ID", "Modelo", "Marca", "Idade recomendada", "Data de cadastro", "Foto"];
        $images_mask = [0, 0, 0, 0, 0, 1];
        $images_folder = "brinquedos/imagens/";
        $title = "Brinquedos";
        $filter_column = "modelo";
    } else if ($table == "contacts") {
        $header = ["ID", "Nome", "E-mail", "Telefone", "Funcao", "Data de cadastro"];
        $images_mask = [0, 0, 0, 0, 0, 0];
        $images_folder = "contacts/imagens/";
        $title = "Contatos";
        $filter_column = "name";
    } else if ($table == "usuarios") {
        makeSureUserIsAdmin();
        $header = ["ID", "Nome", "Login", "Senha", "Foto"];
        $images_mask = [0, 0, 0, 0, 1];
        $images_folder = "usuarios/imagens/";
        $title = "Usuarios";
        $filter_column = "nome";
    } else {
        exit();
    }
    if (!empty($_GET['filter'])) {
        $items = filter($table, $filter_column, $_GET['filter'], $_GET['filtertype']);
    }
    else {
        $items = find_all($table);
    }
    //$items = find_all($table);

    $pdf = new PDF();
    $pdf->AliasNbPages();
    //$header = array_keys($items[0]);
    // Data loading
    $pdf->SetFont('Arial', '', 10);
    if (!empty($items) && count($items) > 0) {

        $max_lengths = array();
        $i = 0;
        foreach([$header, ...$items] as $row) {
            $j = 0;
            foreach($row as $col) {
                if (!isset($max_lengths[$j])) {
                    $max_lengths[$j] = $pdf->GetStringWidth($col);
                }
                else if ($pdf->GetStringWidth($col) > $max_lengths[$j]) {
                    $max_lengths[$j] = $pdf->GetStringWidth($col);
                }
                $j++;
            }
            $i++;
        }
        $table_width = 0;
        $i = 0;
        foreach($items[0] as $col) {
            if ($images_mask[$i]) {
                $table_width += 16;
            } else {
                $table_width += $max_lengths[$i] + 2;
            }
            $i++;
        }
        $left_margin = (
            ($pdf->GetPageWidth() - $table_width) / 2
        );
        $pdf->SetLeftMargin(0);
    
        $pdf->AddPage();
        $pdf->FancyTable($header, $items, $max_lengths, $images_mask, $images_folder, $table_width, $title, $left_margin);
    } else {
        $empty_msg = "Nenhum registro encontrado.";
        $pdf->SetLeftMargin(0);
        $pdf->AddPage();
        $pdf->Ln();
        $pdf->Cell(($pdf->GetPageWidth() - $pdf->GetStringWidth($empty_msg) )/ 2);
        //$pdf->SetLeftMargin(($pdf->GetPageWidth() - $pdf->GetStringWidth($empty_msg)) / 2);
        $pdf->Cell(0, 0, $empty_msg, "C", true);
    }
    if (!empty($_GET['d']) && $_GET['d']=="true") {
        $pdf->Output('D', 'relatorio.pdf');
    }
    else {
        $pdf->Output();
    }
    
?>