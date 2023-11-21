<?php include_once 'core/include.php'; 

$pedido_h = new H_pedido_pedidajuda_hModel();

$secao = $_COOKIE['seguranca']['secao'];
$id_redec = $_COOKIE['seguranca']['id_rpm'];

if ($secao == 'REDEC') {
    $listaPedido1 = $pedido_h->listaPedidosTodos($id_redec);
} else {
    $listaPedido1 = $pedido_h->listaPedidosTodos();
}


$data = array();

foreach ($listaPedido1 as $key => $pedido) {

    $data[$key] = $pedido;
    $data[$key]['tramit'] = $pedido_h->enumFase($pedido['tramit']);
    $data[$key]['data_entrada_sistema'] = DataMysql::dataCompletaVisual($pedido['data_entrada_sistema']);
    $data[$key]['data_hora_envio'] = DataMysql::dataCompletaVisual($pedido['data_hora_envio']);
    $data[$key]['cor'] = H_pedido_an_tecajuda_hModel::anFavoravelChefe($pedido['id']);
    $data[$key]['percent'] = number_format(((H_pedido_prestajuda_hModel::totalMaterialBeneficiarios($pedido['id']) * 100 ) != 0 ) ? (H_pedido_prestajuda_hModel::totalMaterialBeneficiarios($pedido['id']) * 100) / H_pedido_prestajuda_hModel::totalMaterialPrestConta($pedido['id']) : 0, '2', '.', ' ');
    
    
}


$response = array(
    'data' => $data,
);

echo json_encode($response);

