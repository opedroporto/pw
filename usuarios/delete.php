<?php
    require("functions.php");

    if (isset($_GET['id'])) {
        try {
            $usuario = find("usuarios", $_GET['id']);
            deleteUsuario($_GET['id']);
            unlink("imagens/" . $usuario['foto']);
        } catch (Exception $e) {
            $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
            $_SESSION['type'] = 'danger';
        }
    }
?>