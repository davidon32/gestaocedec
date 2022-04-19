<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';

$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] :"";

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] :"";

$h_pedido_pedid = new H_pedido_pedidajuda_hModel();

if($opcao == 'dados_compdec') {
    $dados = $h_pedido_pedid->buscaDadosPedido($id_municipio);
    print json_encode($dados);

}elseif($opcao == 'add_permissao'){

    #busca permissao
    if(empty($h_pedido_pedid->buscaAnalista($_POST['id_usuario']))){
    
        # nova permissao
        $h_pedido_pedid->AddPermissao($_POST);
    }else {
        
       $h_pedido_pedid->AtualizarPermissao($_POST);  
    }
    
}elseif($opcao == 'remover_permissao'){
    
    $h_pedido_pedid->removerPermissao($_POST);
    
}elseif($opcao == 'ck_alta_perf'){
      
    if(Config::AtualizaConfig('aju_h_alta_perf', $_POST['aju_h_alta_perf']) && 
            Config::AtualizaConfig('aju_prazo_prest_conta', $_POST['aju_prazo_prest_conta'])){
        print 'sucesso';
    }
    
}elseif($opcao == 'envia_edicao') {
    
    $dados = array('tramit' => 'edicao_compdec',
                    'status' => '0',
                    'id_pedido' => $_POST['id_pedido'],
                    'data_hora_envio' => date('Y-m-d H:i:s'));
    $h_pedido_pedid->envia_pedido($dados);
    
    print 'sucesso';
}

