<?php
/**
 * Responsável pela chamada a api, endereço utilizado na função CURL da classe Helpers
 */
    require_once("Helpers.php");
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ):   
        $data = json_decode(file_get_contents('php://input'), true);     
        $arr = array();
        foreach ($data as $key => $value):
            if ($value != "")
                $arr[$key] =$value;
        endforeach;
        echo (Helpers::select('users', $arr)) ? "Achou o registro" : "Registro não encontrado";        
    endif;
?>