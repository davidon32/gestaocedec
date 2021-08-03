<?php
include_once $_SERVER['DOCUMENT_ROOT'] .'/include.php';


$post = isset($_POST) ? $_POST : "";

$usuario = new Usuario();

$usuario->atualizaPermissao($post['tabela'], $post['campo'], $post['valor'], $post['id_funcionario']);


?>