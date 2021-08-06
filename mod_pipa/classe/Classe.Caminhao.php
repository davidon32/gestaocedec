<?php

	class Caminhao extends Log {
		
		private static $buscaCaminhao_id;
		private static $buscaCaminhao_pip;
		
	
		function cadastroCaminhao($_placa,
		                          $_modelo,
		                          $_marca,
		                          $_ano,
		                          $_chassi,
		                          $_renavam,
		                          $_capacidade,
		                          $_id_rota,
		                          $_id_motorista,
		                          $_situacao = 'R') {
			try{
			    
			$con = Conexao::getInstance();
		                              
			$sql = 'INSERT INTO pip_caminhao (placa,
			                                     modelo,
			                                     marca,
			                                     ano,
			                                     chassi,
			                                     renavam,
			                                     capacidade,
			                                     id_rota,
			                                     id_motorista,
			                                     situacao) VALUES (:placa,
                                                                   :modelo,
                                                                   :marca,
                                                                   :ano,
                                                                   :chassi,
                                                                   :renavam,
                                                                   :capacidade,
                                                                   :id_rota,
                                                                   :id_motorista,
                                                                   :situacao)';
			
			$result = $con->prepare($sql);
			
			$result->bindValue(":placa",         $_placa);
			$result->bindValue(":modelo",        $_modelo);
			$result->bindValue(":marca",         $_marca);
			$result->bindValue(":ano",           $_ano);
			$result->bindValue(":chassi",        $_chassi);
			$result->bindValue(":renavam",       $_renavam);
			$result->bindValue(":capacidade",    $_capacidade);
			$result->bindValue(":id_rota",       $_id_rota);
			$result->bindValue(":id_motorista",  $_id_motorista);
			$result->bindValue(":situacao",      $_situacao);

			$result->execute();
			
			#@ grava Log
			Log::GravaLog($sql, "pip_log");
			
			return true;
			
			}catch (Exception $e){
			    
			    print FuncaoBase::getError($e->getMessage(), 'Mensagem');
			    
			}
				
		}
		
		
		#@ Alterar Cadastro Caminhao
		function AlteraCaminhao($_id_caminhao,
								$_placa,
								$_modelo,
								$_marca,
								$_ano,
								$_chassi,
								$_renavam,
								$_capacidade){
								    
		    $con = Conexao::getInstance();
		    
		    try{
			
    			$sql = "UPDATE pip_caminhao SET 
                                placa        = :placa,
                                modelo       = :modelo,
                                marca        = :marca,
                                ano          = :ano,
                                chassi       = :chassi,
                                renavam      = :renavam,
                                capacidade   = :capacidade
                                WHERE id_caminhao = :id_caminhao";
    			
    			$result = $con->prepare($sql);
    			
    			
    			$result->bindValue(":placa",         $_placa);
    			$result->bindValue(":modelo",        $_modelo);
    			$result->bindValue(":marca",         $_marca);
    			$result->bindValue(":ano",           $_ano);
    			$result->bindValue(":chassi",        $_chassi);
    			$result->bindValue(":renavam",       $_renavam);
    			$result->bindValue(":capacidade",    $_capacidade);
    			$result->bindValue(":id_caminhao",   $_id_caminhao);
    						
    			$result->execute();
    			
    			#@ grava Log
    			Log::GravaLog($sql, "pip_log");	
    			
    			return true;
    			
		    }catch (Exception $e){
		        
		        print FuncaoBase::getError($e->getMessage(), 'Mensagem');
		    }
			
		}

		
		
		
		#@ busca caminhao com base na placa
		function buscaCaminhao($_placa){
			
			$dados= array();
			
			$con = Conexao::getInstance();
			
			try{
				
    			$sql = "SELECT placa,
    							id_caminhao,
    							situacao,
    							id_motorista,
    							modelo,
    							marca,
    							ano,
    							chassi,
    							renavam,
    							id_rota,
    							capacidade
    							FROM pip_caminhao
    							WHERE placa = :placa";
    			
    			$result = $con->prepare($sql);
    			
    			$result->bindValue(":placa", $_placa);
    			
    			$result->execute();
    			
    			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    				
    				$dados[] = $linha; 
    				
    			}
    			
    			return $dados;
			}catch (Exception $e){
			    
			    print FuncaoBase::getError($e->getMessage(), 'Mensagem');
			}
	
		}

		#@ busca caminhao com base no id
		function buscaCaminhao_id($_id){
		    
		    $dados = array();
		    
		    $con = Conexao::getInstance();
		    
		    try{
			
    			$sql = 'SELECT * FROM pip_caminhao WHERE id_caminhao = :id';
    			
    			$result = $con->prepare($sql);
    			
    			$result->bindValue(":id", $_id);
    			
    			$result->execute();
    		
    			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    				
    				$dados[] = $linha; 
    				
    			}
    			
    			return $dados;
		    }catch (Exception $e) {
		        
		        print FuncaoBase::getError($e->getMessage(), 'Mensagem');
		    }
	
		}
		
		#@ busca dos caminhoes dos pipeiros baseado no cpf
		function buscaCaminhaoPipeiro($_cpf= false, $_placa = false){
			
			if($_cpf != false) {
				
				$opcao = 'm.cpf_cnpj = "'.$_cpf.'"';
				
				}

				elseif($_placa != false) {
				
					$opcao = 'c.placa = "'.$_placa.'"';
				
				}
				
				$dados = array();
				
				$con = Conexao::getInstance();
				
				try{
			
    				$sql ='select c.placa, c.capacidade, m.nome, m.cpf_cnpj, c.id_caminhao, m.id_motorista
    						from pip_motorista m
    						inner join pip_caminhao c
    						on m.id_motorista = c.id_motorista
    						where '.$opcao; 
    			
    				$result = $con->query($sql);
    				
        			while($linha = $result->fetch(PDO::FETCH_ASSOC)){
    	   			
    		      		$dados[] = $linha;
    				
        			}
    			
    			     return $dados;
    			 
				}catch (Exception $e){
				    
				    print FuncaoBase::getError($e->getMessage(), 'Mensagem');
				}
			
			
		}
		
		#@ retorna um select com as placas do caminhoes
		function PegaCaminhao(){
			
		    $con = Conexao::getInstance();
		    
		    try{
		    
    			$sql = 'SELECT placa FROM pip_caminhao';
    			
    			$result = $con->query($sql);
    			
    			print '<select name="placa" id="placa">
    					<option></option>';
    			
    			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    				
    				print '<option>'.$linha['placa'].'</option>';
    			}
    					
    			print '</select>';
		    }catch (Exception $e) {
		        
		        print FuncaoBase::getError($e->getMessage(), 'Ocorreu um erro !');
		    }
			
			
			
		}
		
		#@ retorna o id dos caminhoes baseado no id_motorista
		function buscaIdCaminhaoIdPipeiro($id_pipeiro) {
			
			$dados = array();
			
			$con = Conexao::getInstance();
			
    			try{
    			
    			$sql = "select id_caminhao 
    					from pip_caminhao 
    					where id_motorista = :id_pipeiro";
    			
    			$result = $con->prepare($sql);
    			
    			$result->bindValue(":id_pipeiro", $id_pipeiro);
    			
    			$result->execute();
    			
    			while($linha = $result->fetch(PDO::FETCH_ASSOC)){
    				
    				$dados = $linha['id_caminhao'];
    				
    			}
    			
    			return $dados;
    			}catch (Exception $e){
    			    
    			    print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    			    
    			}
				
		}
		
		
		/**
		 * Update situacao do caminhao
		 * @param $id_caminhao
		 * 
		 * 
		 */
		public static function updateStatusCaminhao($id_camimhao){
		
    		$con = Conexao::getInstance();
    		
    		try{
    		
        		$sql = "UPDATE pip_caminhao SET situacao = 'A' WHERE id_caminhao = :id_caminhao";
        		
        		$result = $con->prepare($sql);
        		
        		$result->bindValue(":id_caminhao", $id_camimhao);
        		
        		$result->execute();
        		
    		    return true;
    		
    		}catch (Exception $e) {
    		    
    		    print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    		}
    	
    		
		}
			
			 
		

}?>