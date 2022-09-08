<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';

$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] :"";

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] :"";

$h_pedido_pedid = new H_pedido_pedidajuda_hModel();

$listaPedido = $h_pedido_pedid->listaPedidosTodos();

$data = array();

foreach ($listaPedido as $key => $pedido) {
    $data[] = $pedido;
}


$response = array('data' => $data);
   echo json_encode($response);

 