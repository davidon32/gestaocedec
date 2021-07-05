<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';

$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] :"";

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] :"";

if($opcao == 'dados_compdec') {

$h_pedido_pedid = new H_pedido_pedidajuda_hModel();

$dados = $h_pedido_pedid->buscaDadosPedido($id_municipio);

print json_encode($dados);
}

