<?php 
    require("functions.php"); 

    if (!isset($_SESSION['user'])) {
        $_SESSION['notLoggedMessage'] = "Você precisa estar logado para acessar essa função.";
        $_SESSION['notLoggedType'] = "danger";

        header("location: " . BASEURL);
    } else {
        if (isset($_GET['id'])){
            deleteBrinquedos($_GET['id']);
        } else {
            die("ERRO: ID não definido.");
        }
    }
?>