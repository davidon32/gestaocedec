<?php include_once 'include.php';

	//$_conexao = new ConexaoMysql();

	$_loginExterno = new LoginExterno();
	
	$_usuario = isset($_POST['login'])? $_POST['login'] : null;
	
	if(preg_match('/@/', $_usuario) == 0)
	 	$_usuario = preg_replace('/[^[:alnum:]_]/', '', $_usuario);

	$_senha = isset($_POST['senha'])? preg_replace('/[^[:alnum:]_]/', '',$_POST['senha']) : null;
	
    $_loginExterno->logarExterno($_usuario, md5($_senha), true);
    
?>