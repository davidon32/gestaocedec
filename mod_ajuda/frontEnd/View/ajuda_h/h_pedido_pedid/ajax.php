<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';

$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] :"";

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] :"";

$h_pedido_pedid = new H_pedido_pedidajuda_hModel();

$h_pedido_itens = new H_pedido_itensajuda_hModel();

if($opcao == 'dados_compdec') {

    $dados = $h_pedido_pedid->buscaDadosPedido($id_municipio);
    print json_encode($dados);

    /* inicia o processo de prestação de contas */
}elseif($opcao == 'inicia_prestconta'){
    
    if($dados = $h_pedido_pedid->iniciaPrestContas($_POST['id_pedido'])){
        print 'sucesso';
    }
  
}elseif($opcao == 'envia_pedido'){
    
    # busca itens pedido
    $itens = H_pedido_itensajuda_hModel::busca_item_pedido($_POST['id_pedido']);
    
    
    # grava itens tabela itens_orginais
    foreach ($itens as $key => $item) {
        # busca item, se existir apaga e grava os novos
        # sempre o itens originais são os itens que no momento e envio estão gravados no pedido
        
        if($h_pedido_itens::buscaItensOriginais($item['id'])){
            $h_pedido_itens::deletaItensOriginal($item['id']);
            $h_pedido_itens::gravarItensOriginal($item);
        }else {
            $h_pedido_itens::gravarItensOriginal($item);
        }
    }
    
    
    if($h_pedido_pedid->envia_pedido($_POST) ){
        print 'sucesso';
    }
}


