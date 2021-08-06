<?php session_start();
	include_once '../include.php';
	
	$_conexao = new ConexaoMysql();
    
    $_login = new Login();
	
	Login::Logado();

	Log::GravaLog('Acesso ao Módulo Equipe Apoio', 'equ_log');

	print "<script text/javascript>";

	print "window.location = 'index2.php?id=".session_id()."';";
	
	print "</script>";
	
?>