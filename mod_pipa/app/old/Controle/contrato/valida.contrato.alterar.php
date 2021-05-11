<?php session_start(); 
    include_once '../include.php';

	$_conexao = new ConexaoMysql();

	//FuncaoBase::vd($_POST);
	
	#@ numero do contrato
	$_numContrato = isset($_POST['num_contrato']) ? $_POST['num_contrato'] : "";
	
	#@ data assinatura do contrato
	$_dtAssinatura = isset($_POST['dt_assinatura']) ? Datamysql::dataForm($_POST['dt_assinatura']) : "";
	
	#@ identificador do motorista
	$_idMotorista = isset($_POST['id_motorista']) ? $_POST['id_motorista'] : "";
	
	#@ identificador do contrato
	$_idContrato = isset($_POST['id_contrato']) ? $_POST['id_contrato'] : "";
	
	#@ situacao contrato
	$_situacao = isset($_POST['situacao']) ? strtoupper($_POST['situacao']) : "";
	
	#@ data rescisao
	$_dtRescisao = isset($_POST['dt_rescisao']) ? DataMysql::dataForm($_POST['dt_rescisao']) : "";
	
	#@ observacao
	$obs = isset($_POST['obs']) ? $_POST['obs'] : "";
    
    #@ situacao contrato
    $_numEmpenho = isset($_POST['num_empenho']) ? $_POST['num_empenho'] : "";
    
    #@ data rescisao
    $_dtEmpenho = isset($_POST['dt_empenho']) ? DataMysql::dataForm($_POST['dt_empenho']) : "";
    
	

	$_altera = Contrato::alteraContrato($_numContrato,
	                                    $_idMotorista,
	                                    $_dtAssinatura,
	                                    $_idContrato,
	                                    $_situacao,
	                                    $obs,
	                                    $_dtRescisao,
	                                    $_numEmpenho,
	                                    $_dtEmpenho);
	
	if($_altera) {
		
		FuncaoBase::vifs('sucesso', 'secao.php?secao=contrato&acao=buscar', 'Alteração Realizada com Sucesso !');	
		
	}

?>