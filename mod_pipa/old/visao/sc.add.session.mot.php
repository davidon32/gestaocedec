<?php
	session_start();
	
	include_once '../../include.php';

	$con = new ConexaoMysql();

	$d_motorista = Motorista::buscaMotorista($_GET['id']);
	
	
	//FuncaoBase::vd($d_motorista);

	$_SESSION['motorista'][] = array('id'=>$_GET['id'], 'nome'=>$d_motorista[0]['nome'], 'cpf'=>$d_motorista[0]['cpf'], 'cnh'=>$d_motorista[0]['cnh']);
	

	//FuncaoBase::vd($_SESSION);
	
	
	

	print '<br />';
	
	#@ fechar Janela
	FuncaoBase::Fechar();
?>
