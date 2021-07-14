<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';

$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] :"";

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] :"";

$h_pedido_pedid = new H_pedido_pedidajuda_hModel();

if($opcao == 'dados_compdec') {

    $dados = $h_pedido_pedid->buscaDadosPedido($id_municipio);
    print json_encode($dados);

    /* inicia o processo de prestação de contas */
}elseif($opcao == 'inicia_prestconta'){
    
    if($dados = $h_pedido_pedid->iniciaPrestContas($_POST['id_pedido'])){
        print 'sucesso';
    }
  
}elseif($opcao == 'envia_pedido'){
    
    if($h_pedido_pedid->envia_pedido($_POST)){
        print 'sucesso';
    }
}


