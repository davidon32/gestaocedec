<?php include_once 'system/config.inc.php';

include_once PATH.'/classe/Classe.Login.php';
include_once PATH.'/classe/Classe.LoginExterno.php';

	$_usuario = isset($_POST['login'])? $_POST['login'] : null;
	
	$_senha = isset($_POST['senha'])? preg_replace('/[^[:alnum:]_]/', '',$_POST['senha']) : null;
	
	$_usuarioLog =null;
	
	if(preg_match('/@/', $_usuario) == 0){
		$_usuarioLog = preg_replace('/[^[:alnum:]_]/', '', $_usuario);
	}

	$_login = new Login();
	$_loginExterno = new LoginExterno();

	if(!$_login->logar($_usuario, md5($_senha), true)){
			$_loginExterno->logarExterno($_usuario, md5($_senha), true);
		
	}else{
		
		echo "erro usuario ou senha";

	}
?>