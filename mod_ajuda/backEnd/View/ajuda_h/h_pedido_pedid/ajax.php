<?php include_once $_SERVER['DOCUMENT_ROOT'].'/core/include.php';

$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] :"";

$opcao = isset($_POST['opcao']) ? $_POST['opcao'] :"";

$h_pedido_pedid = new H_pedido_pedidajuda_hModel();

/* buscar dados do compdec */
if($opcao == 'dados_compdec') {
    $dados = $h_pedido_pedid->buscaDadosPedido($id_municipio);
    print json_encode($dados);

/* Adicionar Permissao */ 
}elseif($opcao == 'add_permissao'){

    #busca permissao
    if(count($h_pedido_pedid->buscaAnalista($_POST['id_usuario'])) == 0){
    
        # nova permissao
        $h_pedido_pedid->AddPermissao($_POST);
    }else {
        
       $h_pedido_pedid->AtualizarPermissao($_POST);  
    }
 
// Remover Permissao
}elseif($opcao == 'remover_permissao'){
    
    $h_pedido_pedid->removerPermissao($_POST);
  
// Alta Performance
}elseif($opcao == 'ck_alta_perf'){
      
    if(Config::AtualizaConfig('aju_h_alta_perf', $_POST['aju_h_alta_perf']) && 
        Config::AtualizaConfig('aju_prazo_prest_conta', $_POST['aju_prazo_prest_conta'])){
        print 'sucesso';
    }

// Enviar processo para edição
}elseif($opcao == 'envia_edicao') {
    
    $dados = array('tramit' => 'edicao_compdec',
                    'status' => '0',
                    'id_pedido' => $_POST['id_pedido'],
                    'data_hora_envio' => date('Y-m-d H:i:s'));
    $h_pedido_pedid->envia_pedido($dados);
    
    print 'sucesso';

// Permissao pedir material
}elseif ($opcao == 'permis_material_pedido') {
    
    if($h_pedido_pedid->PermissaoMaterial($_POST)){
        print 'sucesso';
    }
    
}elseif( $opcao =='alterar_material') {

    $dados = $_POST;
    if(H_pedido_itensajuda_hModel::edit($dados)) {
        print 'sucesso';
    }
    
}elseif( $opcao =='salvar_novo_mat') {

    $dados = $_POST;
    if(H_pedido_itensajuda_hModel::gravar($dados)) {
        print 'sucesso';
    } 
/* gravar despacho */
}elseif( $opcao =='gravar_despacho') {

    $dados = $_POST;
    $dados['data_parecer'] = date('d-m-Y H:i:s');
    // if($dados['parecer_sit'] == 2){
    //     $dados['tramit_parecer'] = '0';
    // }

    if(H_pedido_an_tecajuda_hModel::gravar($dados)) {

        /* DESPACHO FAVORAVEL DO ANALISTA */
        if($dados['parecer_sit'] == 1 && $dados['secao'] == "DLOG" || $dados['id_usuario'] == 1) {
            $dados['status'] = '3';
            $dados['tramit'] = 'analise_coord';
            /* tramitar para coord adj */
            if(H_pedido_pedidajuda_hModel::tramitar($dados)){
                print 'sucesso';
            }
        }elseif ( $dados['parecer_sit'] == 1 && $dados['secao'] == "CHEFIA" ) {
            $dados['status'] = '4';
            $dados['tramit'] = 'aguard_disp';
            /* tramitar para aguardar disponibilidade */
            if(H_pedido_pedidajuda_hModel::tramitar($dados)){
                print 'sucesso';
            }
        }else {
            print 'sucesso';
        }

    }
 
//tramitar pedido
}elseif( $opcao == 'tramitar'){
    $dados = $_POST;

    if(H_pedido_pedidajuda_hModel::tramitar($dados)) {
        print 'sucesso';
    }   
    
    
}

