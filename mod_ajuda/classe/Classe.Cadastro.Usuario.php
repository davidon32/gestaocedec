<?php
/***********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 																					*
 * 	Classe para controle de accesso de usuarios										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos													*
 * 																					*
 * 	Criacao : 01/02/2012															*
 ************************************************************************************/


	class ControleAcesso {
		
		private $id; # id usuario
		
		private $nivel ; # nivel do usuario
		
		#@ insere o usuario na tabela usuario
		
		function CadastroUsuario($_id_deposito, $_nome, $_senha, $_nivel, $_ativo, $_login){

			$this->nivel = $_nivel;
			
			$sql = "INSERT INTO aju_usuario (id_deposito, nome, senha, nivel, ativo, login) 
			        VALUES (:id_deposito, :nome, :senha', :nivel, :ativo, :login)";
			
			//print $sql;
			
			try {
			
			$result = Conexao::getInstance()->prepare($sql);
			
			$result->bindValue(":id_deposito", $_id_deposito);
			$result->bindValue(":nome", $_nome);
			$result->bindValue(":senha", $_senha);
            $result->bindValue(":nivel", $_nivel);			                
			$result->bindValue(":ativo", $_ativo);
			$result->bindValue(":login", $_login); 
			$result->execute();

			
			return true;
			
			}catch (Exception $e) {
		
			     return $e->getMessage()."Erro ao inserir usuario";
			
		    }
			
		}
		
		/**
		 * 
		 * insere as permissoes na tabela permissao 
		 * 
		 */
		function CadastroPermissao($id_usuario,
							$nivel,
							$cad_material,
							$cad_pagamento, 
							$cad_transferencia, 
							$cad_liberacao, 
							$cad_ajuda_suporte, 
							$cad_usuario, 
							$cad_cons_relatorio, 
							$rel_saldo_geral, 
							$rel_saldo_p_deposito, 
							$rel_pagamento, 
							$rel_transf_mat, 
							$rel_mat_transito, 
							$rel_liberacao, 
							$rel_mat_liberado,
							$rel_mat_espera_pgto,
							$cad_conf_ger,
							$lembrete_libera,
							$lembrete_transito){
			
			$sql = "INSERT INTO aju_permissao (id_usuario, nivel, cad_material, cad_pagamento, cad_transferencia, ".
					"cad_liberacao, cad_ajuda_suporte, cad_usuario, cad_cons_relatorio, rel_saldo_geral, rel_saldo_p_deposito, ".
					"rel_pagmto, rel_transf_mat, rel_mat_transito, rel_liberacao, rel_mat_liberado, ".
					"rel_mat_espera_pgto, cad_conf_ger, lembrete_libera, lembrete_transito)
        			VALUES ($id_usuario,
        			         $nivel,
        			         $cad_material,
        			         $cad_pagamento,
        			         $cad_transferencia,
        			         $cad_liberacao,
        			         $cad_ajuda_suporte,
        			         $cad_usuario,
        			         $cad_cons_relatorio,
        			         $rel_saldo_geral,
        			         $rel_saldo_p_deposito,
        			         $rel_pagamento,
        			         $rel_transf_mat,
        			         $rel_mat_transito,
        			         $rel_liberacao,
        			         $rel_mat_liberado,
        			         $rel_mat_espera_pgto,
        			         $cad_conf_ger,
        			         $lembrete_libera,
        			         $lembrete_transito)";
			
                try {
			
			         $result = Conexao::getInstance()->prepare($sql);
			         
			         $result->bindValue(":id_usuario", $id_usuario);
			         $result->bindValue(":nivel", $nivel);
			         $result->bindValue(":cad_material", $cad_material);
			         $result->bindValue(":cad_pagamento", $cad_pagamento);
			         $result->bindValue(":cad_transferencia", $cad_transferencia);
			         $result->bindValue(":cad_liberacao", $cad_liberacao);
			         $result->bindValue(":cad_ajuda_suporte", $cad_ajuda_suporte);
			         $result->bindValue(":cad_usuario", $cad_usuario);
			         $result->bindValue(":cad_cons_relatorio", $cad_cons_relatorio);
			         $result->bindValue(":rel_saldo_geral", $rel_saldo_geral);
			         $result->bindValue(":rel_saldo_p_deposito", $rel_saldo_p_deposito);
			         $result->bindValue(":rel_pagamento", $rel_pagamento);
			         $result->bindValue(":rel_transf_mat", $rel_transf_mat);
			         $result->bindValue(":rel_mat_transito", $rel_mat_transito);
			         $result->bindValue(":rel_liberacao", $rel_liberacao);
			         $result->bindValue(":rel_mat_liberado", $rel_mat_liberado);
			         $result->bindValue(":rel_mat_espera_pgto", $rel_mat_espera_pgto);
			         $result->bindValue(":cad_conf_ger", $cad_conf_ger);
			         $result->bindValue(":lembrete_libera", $lembrete_libera);
			         $result->bindValue(":lembrete_transit", $lembrete_transit);
			         
			         return true;
			         
                }catch (Exception $e) {
                    
                    return $e->getMessage()."Erro Cadastro de Permisoes !";
                }
			
			
			}
		
			
		/**
		 * 
		 * 
		 * 
		 * 
		 * @return unknown
		 */
		function pega_id_usuario(){
			
			$dados = array();
			
		    $sql = "SELECT id_usuario FROM aju_usuario order by id_usuario desc limit 1";

		    try{
		        
		    
    			$result = Conexao::getInstance()->query($sql);
    			$result->execute();
                
                while ($linha = $result->fetch(PDO::FETCH_NUM)) {
                    
                    $dados = $linha;
                }
    				
    			return $dados[0]; 
			
		    }catch (Exception $e) {
		        
		        return $e->getMessage();
		        
		    }
			
		}
		
    /**
     * 
     * returno nivel de usuario
     * 
     */
    function pega_nivel(){
    
        return $this->nivel;
    }

}?>