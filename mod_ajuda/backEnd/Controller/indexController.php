<?php

include_once('core/Controller/Controller.php');

class IndexController extends Controller {

    public function Index() {
        include_once 'mod_ajuda/backEnd/View/index/index.php';
    }

    public function ComEstoque() {
        include_once 'mod_ajuda/backEnd/View/conEstoque/index.php';
    }

    public function search() {

        $pedido_h = new H_pedido_pedidajuda_hModel();

        $secao = $_POST["secao"];
        $id_redec = $_POST["id_redec"];
        $municipio = $_POST['municipio'];

        if ($secao == 'REDEC') {
            $listaPedido1 = $pedido_h->listaPedidosTodos($municipio, $id_redec);
        } else {
            $listaPedido1 = $pedido_h->listaPedidosTodos($municipio);
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

        return json_encode($response);
    }

}

?>