<?php

class LogAjuda {

	function GravaLog($_acao) {
		
		try {
			$con = Conexao::getInstance();	
				$_login = $_SESSION['seguranca']['login'];
					
				$_data = date('Y/m/d H:i:s');
					
				$_ip = $_SERVER['REMOTE_ADDR'];
					
				$sql = 'INSERT INTO aju_log (login, dt_user, acao, ip) VALUES ("'.$_login.'", "'.$_data.'", "'.htmlentities($_acao).'", "'.$_ip.'")';
			
			$result = $con->query($sql);
			$result->execute();
			
			return true;
			
		}catch (Exception $e){
			
			print $e->getMessage();
			
		}
			
	}
}
?>