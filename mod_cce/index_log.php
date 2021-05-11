<?php session_start();
include_once PATH.'/include.php';
	
	$_conexao = new ConexaoMysql();
	
	$_login = new Login();
	
	$_login->logado();
	
	$_login->Sessao();

	Log::GravaLog('Acesso ao Módulo CCE', 'cce_log');

	print "<script text/javascript>";

	print "window.location = 'index.php?secao=cce&acao=index';";

	print "</script>";
		
?>