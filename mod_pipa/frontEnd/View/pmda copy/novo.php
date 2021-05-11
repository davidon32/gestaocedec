<?php $id_session = session_id();
    if(empty($id_session)) session_start();

	include_once $_SERVER['DOCUMENT_ROOT'] .'/core/include.php';

$pmda = new Pmda();

$post = isset($_POST) ? $_POST : "";

if($post['envia'] == 'novo'){

    

    $post['data'] = date('Y-m-d H:i:s');
    $post['status'] = 0;
    //$post['id_municipio'] = (int)$_COOKIE['session']['seguranca']['id_municipio'];
    $post['acoes'] = "";
    $post['qtd_caminhoes'] = "";
    $post['pop_at_municipio'] = "0";
    $post['pedido_altera'] = "";
    $post['em_analise'] = "";
    
    
    if($pmda->verificaCriarPmda($post['id_municipio']) == "0"){
    	if($pmda->novo($post)){
    	}
    }
    
}
    
    

?>