<?php

class LogEscola {

	function GravaLog($_acao) {
			
		$_login = $_SESSION['seguranca']['login'];
			
		$_data = date('Y/m/d H:i:s');
			
		$_ip = $_SERVER['REMOTE_ADDR'];
			
		$sql = 'INSERT INTO pip_log (login, dt_user, acao, ip) VALUES ("'.$_login.'", "'.$_data.'", "'.htmlentities($_acao).'", "'.$_ip.'")';
			
		//print_r($sql);
			
		$result = mysql_query($sql) or die (mysql_error().'erro ao gravar log');
			
	}
}


?>