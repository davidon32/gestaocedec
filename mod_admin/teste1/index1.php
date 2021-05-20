<?php require_once('classe/Classe.Conexao.php');





$tabela = "funcionario";
$campo = "nome, endereco";


$sql = "select ".$campo." from ".$tabela;


print $sql;

?>