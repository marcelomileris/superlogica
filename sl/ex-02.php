<?php

    class Control_Array {

        private $array;

        public function __construct($size=1) {
            $this->array = Array();

            foreach(range(0, $size-1) as $num)
                array_push($this->array, random_int(1, 50));
        }

        public function get($pos="all") {
            return ($pos=="all") ? json_encode($this->array) : $this->array[$pos]??"Não há essa posição no array";
        }

        public function toStr() {
            return implode(", ", $this->array);
        }

        public function toArray($arr) {
            return json_encode(explode(", ", $arr));
        }

        public function existsValue($value) {
            return (in_array($value, $this->array) ? "SIM" : "NÃO");
        }

        public function removeMinorValue() {
            $arr1 = $arr2 = $this->array;
            for ($i = 1; $i <= count($arr1); $i++) {
                $val1 = $arr1[$i];
                $val2 = $arr2[$i-1];
                if ($val2 > $val1)
                    unset($arr1[$i]);
            }
            return json_encode(array_values($arr1), true);
        }

        public function deleteLast() {
            $res = (count($this->array) > 0) ? array_pop($this->array) : array();
            return (count($this->array) > 0) ? json_encode($this->array) : "Array vazio";
        }

        public function countArray() {
            return (count($this->array));
        }

        public function reverse() {
            return (count($this->array) >0 ) ? json_encode(array_reverse($this->array)) : "Array vazio";
        }


    }
    /**
     * Cria o array com X números de posições e com números de 1 até X
     */
    $size = 7;
     
    $arr = new Control_Array( $size );

    // Recupera o valor da posição informada ou todos se não informar a posição
    $array = $arr->get();
    // Recupera o valor da posição informada
    $arr_pos = $arr->get(3);
    // Converte o array para string
    $arr_str = $arr->toStr();
    // converte a string retornada para um novo array
    $arr_arr = $arr->toArray($arr_str);
    // verifica se existe o valor informado no array
    $arr_val = $arr->existsValue("14");
    // remove a posição do array se o valor atual for menor que o anterior
    $arr_res_minor = $arr->removeMinorValue();
    // remove a última posição
    $arr_new = $arr->deleteLast();
    // conta quantos elementos há no array
    $arr_count = $arr->countArray();
    // reverte as posições do array
    $arr_reverse = $arr->reverse();   
?>

<html>
<head>
    <title> Super Lógica - Exercício 02</title>
    <style>
        * {
            font-family : "Lucida Console";            
        }
        table { 
            border-collapse: collapse; 
        }
        td {
            padding: 5px;
        }
        tr {
            border-bottom: 1pt solid black;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>1) </td>
            <td>Tamanho do array</td>
            <td><?php echo $size; ?></td>
        </tr>
        <tr>
            <td>2) </td>
            <td>Array</td>
            <td><?php echo $array; ?></td>
        </tr>
        <tr>
            <td>3) </td>
            <td>Valor posição 3</td>
            <td><?php echo $arr_pos; ?></td>
        </tr>
        <tr>
            <td>4) </td>
            <td>Array string</td>
            <td><?php echo $arr_str; ?></td>
        </tr>
        <tr>
            <td>5) </td>
            <td>Array criado</td>
            <td><?php echo $arr_arr; ?></td>
        </tr>
        <tr>
            <td>6) </td>
            <td>Existe valor (14)</td>
            <td><?php echo $arr_val; ?></td>
        </tr>
        <tr>
            <td>7) </td>
            <td>Remove menor</td>
            <td><?php echo $arr_res_minor ; ?></td>
        </tr>
        <tr>
            <td>8) </td>
            <td>Remover última posição</td>
            <td><?php echo $arr_new; ?></td>
        </tr>
        <tr>
            <td>9) </td>
            <td>Elementos</td>
            <td><?php echo $arr_count; ?></td>
        </tr>
        <tr>
            <td>10) </td>
            <td>Reverso</td>
            <td><?php echo $arr_reverse; ?></td>
        </tr>
    </table>
</body>
</html>