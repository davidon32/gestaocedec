<?php

include_once PATH . '/core/include.php';


$tabela = "com_comdec";

$sql = "select *from com_comdec";


$con = Conexao::getInstance();

$stmt = $con->query($sql);

$dados = array();

while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dados[] = $linha;
}

foreach ($dados as $value) {

   // $
    //var_dump($value['email']);
}



