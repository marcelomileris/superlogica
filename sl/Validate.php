<?php
/**
 * Classe reponsável pela validação dos campos enviados
 * Após a validação, faz inserção no banco de dados 
 * Se houver um registro com o usuário informado, retorna uma mensagem
*/
    require_once("Helpers.php");
    class Validate {

        private $data;

        // Método construtor
        public function __construct($data) {
            $this->data = $data;
        }

        // valida se o json enviado é válido
        public function isJSON() {
            if (!empty($this->data)):
                @json_decode($this->data);
                return (json_last_error() === JSON_ERROR_NONE);
            endif;
            return false;
        }

        // Aplica as regras de validação
        public function validate(){
            // Valida se o envio é válido
            if (!$this->isJSON()):
                die(json_encode(array("success"=>"false", "msg"=>"json invalid")));
            endif;
            // Converte o envi para array
            $data   = json_decode($this->data, true);
            // Json é válido
            $this->validate_json($data);
            // Valida se os campos estão vazios
            $this->validate_string($data);
            // Valida o email
            $this->email($data);
            // Valida a senha
            $this->password($data);

            // Realiza uma busca para verificar se o usuário existe
            $res = Helpers::select('users', array("user" => $data["user"]));
            if ($res)
                die(json_encode(array("success"=>"false", "msg"=>"user found")));

            // Realiza a inserção
            $res = Helpers::insert('users', $data);
            die(json_encode(array("success"=>"true", "msg"=>"user successfully added [id=>$res]")));
         
        }

        // Valida o JSON enviado
        public function validate_json($data) {
            // Array para validar os campos que foram enviados
            $fields = array("name", "user", "zipcode", "phone", "email", "password");
            $arr = array();
            foreach ($fields as $key => $value):
                if (!isset($data[$fields[$key]])):
                    array_push($arr, $fields[$key]);
                endif;
            endforeach;
            if (count($arr) > 0):
                die(json_encode(array("success"=>"false", "msg"=>"parameters invalid. are missing [" . implode(", ", $arr) . "]")));
            endif;
        }

        // Verifica se os campos estão vazios
        private function validate_string($data) {
            $arr = array();
            foreach ($data as $key => $value):
                if ($data[$key] == ""):
                    array_push($arr, $key);
                endif;
            endforeach;
            if (count($arr) > 0):
                die(json_encode(array("success"=>"false", "msg"=>"fields cannot be empty [" . implode(", ", $arr) . "]")));
            endif;
        }

        // Valida o email
        private function email($data) {
            $value = $data["email"];
            if (!filter_var($value, FILTER_VALIDATE_EMAIL))
                die(json_encode(array("success"=>"false", "msg"=>"email invalid")));
        }

        // Verifica se o password atende os requisitos
        private function password($data) {
            $value = $data["password"];
            if (strlen($value) < 8)
                die(json_encode(array("success"=>"false", "msg"=>"field password cannot be less than 8 characters")));

            if( !preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $value) ) 
                die(json_encode(array("success"=>"false", "msg"=>"password field must contain a letter and a number")));
                
        }

    }

    /* *********************************************************************************** */

    // Faz a chamada ao método após o POST
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ):   
        $data = file_get_contents('php://input');             
        $validate = new Validate($data);
        $validate->validate();
    endif;
?>