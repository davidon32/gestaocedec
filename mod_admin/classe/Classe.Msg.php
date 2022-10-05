<?php

/*	Classe para Manipulação de mensagens do sistema
 * 
 * 
 * */

	class MensagemSistema {
		
		static function cadastroMensagem($titulo, $mensagem) {

			$con = Conexao::getInstance();

			$sql = "INSERT INTO cedec_mensagem (titulo, mensagem) VALUE ('".$titulo."', '".$mensagem."')";

			$result = $con->query($sql);
					
			return true;
			
		}


		#@ Mostrar mensagem do módulo ajuda
		static function mostraMensagem() {

			$dados = array();
			
			$sql = "SELECT id_mensagem,
							titulo, 
							mensagem
							FROM cedec_mensagem
							WHERE tipo = '{$_COOKIE['seguranca']['tipo']}'
							ORDER BY id_mensagem DESC";

			try { 
				$result = Conexao::getInstance()->query($sql);
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {   
					$dados[] = $linha;
				}
                                foreach ($dados as $key => $value) {
        				print "<ul class='list-group'>";
                                        print "<li class='list-group-item' align='justify'>".$value['mensagem']."</li>";
                                        print "</ul>";
                                    
                                }
			
				
			} catch (Exception $e) { 
				return $e->getMessage()."Código 3";
			} 
		}


}?>