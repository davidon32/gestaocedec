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
        var_dump($h_pedido_pedid->AddPermissao($_POST));

    }
}elseif($opcao == 'add_permissao'){
    
   // $h_pedido_pedid->
}

