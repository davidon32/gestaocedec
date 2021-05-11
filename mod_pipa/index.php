?php session_start();
	include_once '../include.php';

	$_conexao = new ConexaoMysql();

	$_login = new Login();
	
	$_login->Logado();
	
	$_login->Sessao();

	$_logPipa = new Log();

	$_logPipa->GravaLog('Acesso ao Pipa', 'pip_log');
		
	print "<script text/javascript>";

	print "window.location = 'index2.php?id=".session_id()."';";

	print "</script>";
?>