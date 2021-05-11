<?php
	session_start();
	
	include_once '../../include.php';

	$_conexao = new ConexaoMysql();
	
	//$_SESSION['id_caminhao'] = array();

	$d_caminhao = Caminhao::buscaCaminhao_id($_GET['id']);
	
	
	//FuncaoBase::vd($d_caminhao);

	$_SESSION['caminhoes'][] = array('id'=>$_GET['id'], 'placa'=>$d_caminhao[0]['placa'], 'modelo'=>$d_caminhao[0]['modelo'], 'ano'=>$d_caminhao[0]['ano'], 'capacidade'=>$d_caminhao[0]['capacidade']);
	

	//FuncaoBase::vd($_SESSION);
	
	

	print '<br />';
	
	#@ fechar Janela
	FuncaoBase::Fechar();

?>

	
