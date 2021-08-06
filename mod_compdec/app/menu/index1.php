<?php session_start();

	include_once '/include.php';
	
	$_conexao = new ConexaoMysql();
	
	$_login = new Login();

	$_login->Logado();

	$_logCompdec = new Log();

	$_logCompdec->GravaLog('Acesso ao Compdec', 'com_log');
		
	print "<script text/javascript>";

	print "window.location = 'index.php?id=".session_id()."';";

	print "</script>";
	
	
	
?>