<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';?>
<?php

$post = isset($_POST) ? json_decode(json_encode($_POST)) :"";

if(!empty($post)){
$dados = Produto::ListEntradaSaldo(array($post->id_material, $post->id_deposito));


}
print $dados;

