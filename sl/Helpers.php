<?php
require_once("Database.php");
class Helpers{
    public static function select(string $nome_da_tabela, array $informacao) : bool
    {
        // retorna se a consulta existe
        $db = new Database();
        return count($db->select($nome_da_tabela, $informacao)) > 0;
    }
    public static function insert(string $nome_da_tabela, array $informacao): int
    {
        // retorna o id do registro
        $db = new Database();
        return $db->insert($nome_da_tabela, $informacao);
    }
    public static function curl(string $url, string $informacao): string
    {
        // faz uma requisição curl para uma url e retorna a informação desejada
        $curl = curl_init();
        $opt = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $informacao,
            CURLOPT_HTTPHEADER => array("content-type: application/json")
        );
		curl_setopt_array($curl, $opt);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }  
}
?>