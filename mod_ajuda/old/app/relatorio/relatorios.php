<?php 

/* acesso aos relatorios do sistema */

$_secao = isset($_GET['opcao']) ? $_GET['opcao'] : "";


if($_secao == 'liberacao') {
    
    var_dump($_POST);

	$_txt_id_deposito  = isset($_POST['txt_id_deposito']) ? $_POST['txt_id_deposito'] : ""; 
  	$_txt_dt_inicial   = isset($_POST['txt_dt_inicial'])  ? $_POST['txt_dt_inicial']  : ""; 
  	$_txt_dt_final     = isset($_POST['txt_dt_final'])    ? $_POST['txt_dt_final']    : ""; 
  	$_txt_id_municipio = isset($_POST['txt_id_municipio'])? $_POST['txt_id_municipio']: ""; 
  	$_txt_btn_enviar   = isset($_POST['txt_btn_enviar'])  ? $_POST['txt_btn_enviar']  : ""; 

	include 'rel/rel.liberacao.php';
	exit();

}


# =========================================== LIBERACAO ==============================================



#@ Relatorio de Material Liberado
if ($_secao == 'materialLiberado') {
    
    include 'rel/rel.liberacao.php';
    exit();

}



#@ Relatorio de Material pago
if ($_secao == 'materialPago') {

	include 'rel/rel.material.pago.php';
	exit();

}


#@ Lembrete de Material Liberado
if($_secao == 'lembrete'){
	
	include 'rel/rel.liberacao.lembrete.php';
	exit();
}


#@ busca 2a via recibo pagamento de material
if ($_secao == 'buscaReciboPgto') {
    
    include 'visao/sc.busca.recibo.pagamento.segunda.via.php';
    exit();

}

#@ 2a via Recibo Pagto Material
if ($_secao == '2viaRecibo') {
	
	include 'rel/rel.recibo.pagamento.php';
	exit();

}

#@ filtro relatorio cadastro material
if($_secao == 'buscaCadMaterial'){
    
    include 'visao/sc.busca.cadastro.material.php';
    exit();
    
}

#@ relatorio de cadastro de material 
if($_secao == 'relCadMaterial'){
    
    include 'rel/rel.cadastro.material.php';
    exit();
    
}    

?>


