<?php
include_once $_SERVER['DOCUMENT_ROOT'] .'/include.php';


$post = isset($_POST) ? $_POST : "";

var_dump($post);

$usuario = new Usuario();

$usuario->atualizaPermissao($post['tabela'], $post['campo'], $post['valor'], $post['id_funcionario']);


?>