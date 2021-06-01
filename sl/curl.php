<?php
/**
 * É chamado no formulário para realizar o teste do CURL
 */
    require_once("Helpers.php");
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ):   
        $data = json_decode(file_get_contents('php://input'), true);  
        $url = $data["url"];
        $informacao = $data["params"];
        $res = Helpers::curl($url, $informacao);
        echo $res;
    endif;
?>