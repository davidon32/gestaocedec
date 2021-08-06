<?php include_once 'Classe.Motorista.php';
    require_once 'Classe.Caminhao.php';
    require_once 'Classe.Rota.php';
    
    
    class Contrato extends Log{
    	
    	private static $d_contrato;
    	
    	private static $d_busca;
    	
   	    /**
         * Cadastro de contrato de Pipeiros
         * @param $numContrato
         * @param $idMotorista
         * @param $dtContrato
         * @param $situacao
         * @param $obs
         * @param $idCaminhao
         * @param $idRota
         * @param $ano
         * @param $dtEmpenho
         * @param $numEmpenho
         * 
         */
    	function CadastraContrato($numContrato,
    							  $idMotorista,
    							  $dtContrato, 
    							  $situacao,
    							  $obs,
    							  $idCaminhao,
    							  $idRota,
    							  $ano,
    							  $dtEmpenho,
    							  $numEmpenho) {
    		
            $con = Conexao::getInstance();
            
            try{
            
        		$sql ='INSERT INTO pip_contrato (num_contrato,
        										 id_motorista,
        										 data_contrato,
        										 situacao,
        										 obs,
        										 id_caminhao,
        										 id_rota,
        										 ano,
        										 dt_empenho,
        										 num_empenho)
        										 VALUES (:numContrato,
                                                         :idMotorista,
                                                         :dtContrato, 
                                                         :situacao,   
                                                         :obs,        
                                                         :idCaminhao, 
                                                         :idRota,     
                                                         :ano,        
                                                         :dtEmpenho,  
                                                         :numEmpenho)';
    
        		$result = $con->prepare($sql);
        		
        		$resul->bindValue(":numContrato", $numContrato);
        		$resul->bindValue(":idMotorista", $idMotorista);
        		$resul->bindValue(":dtContrato",  $dtContrato);
        		$resul->bindValue(":situacao",    $situacao);
        		$resul->bindValue(":obs",         $obs);
        		$resul->bindValue(":idCaminhao",  $idCaminhao);
        		$resul->bindValue(":idRota",      $idRota);
        		$resul->bindValue(":ano",         $ano);
        		$resul->bindValue(":dtEmpenho",   $dtEmpenho);
        		$resul->bindValue(":numEmpenho",  $numEmpenho);
        		
        		$result->execute();
        		
        		// atualiza o status do motorista para "A"
        		Motorista::updateStatus($idMotorista);
        		
        		// atualiza o status do Caminhao para "A"
        		Caminhao::updateStatusCaminhao($idCaminhao);
        		
        		// atualiza o status da rota para "A"
        		Rota::updateStatusRota($ano, $idRota);
        		
        		// grava Log
        		Log::GravaLog("Cadastro contrato No:".$numContrato."- Ano:".$ano."", "pip_log");
       		
        		return true;
            
            }catch (Exception $e){
                
                print FuncaoBase::getError($e->getMessage(), 'Mensagem');
                
            }
    		
    	}
    	
    	#@ funcao alteracao de contrato
    	function alteraContrato($_numContrato = false,
    	                        $_idMotorista = false,
    	                        $_dtContrato = false,
    	                        $_idContrato = false,
    	                        $_situacao = false,
    	                        $_obs = false,
    	                        $_dtRescisao,
    	                        $_numEmpenho,
    	                        $_dtEmpenho) {
    	                            
    	    $con = Conexao::getInstance();
    	    
    	    try{
    	
        		$sql = 'UPDATE pip_contrato 
                        	SET num_contrato  = :numContrato,
                        		id_motorista  = :idMotorista,
                        		data_contrato = :dtContrato,
                        		situacao      = :situacao,
                        		obs           = :obs,
                        		dt_rescisao   = :dtRescisao,
                        		num_empenho   = :numEmpenho,
                        		dt_empenho    = :dtEmpenho
                        		     WHERE id_contrato= :idContrato';
        		
        		$result = $con->prepare($sql);
        		
        		$result->bindValue(":numContrato", $_numContrato);
        		$result->bindValue(":idMotorista", $_idMotorista);
        		$result->bindValue(":dtContrato",  $_dtContrato);
        		$result->bindValue(":situacao",    $_situacao);
        		$result->bindValue(":obs",         $_obs);
        		$result->bindValue(":dtRescisao",  $_dtRescisao);
        		$result->bindValue(":numEmpenho",  $_numEmpenho);
        		$result->bindValue(":dtEmpenho",   $_dtEmpenho);
        		$result->bindValue(":idContato",   $_idContato);
        			
                $result->execute();           		

        		// grava Log
        		Log::GravaLog($sql, "pip_log");
        		
        		return true;
    	    
    	    }catch (Exception $e){
    	        
    	        print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    	        
    	    }
    		
    	}
    	
    	
    	/**
         * Funcao buscar contrato para Consulta
         * @param $nome
         * @param $placa
         * @param $ano
         * 
         */
    	function buscaContrato($nome = false, $placa = false, $ano = false) {

    		$filtro = '';
    		
    		if($nome != false) {
    		
    			$filtro = 'WHERE m.nome LIKE "%'.$nome.'%" ORDER BY m.nome;' ;
    		
    		}elseif ($placa != false){
    			
    			$filtro = 'WHERE ca.placa = "'.$placa.'" AND c.situacao = "A" ORDER BY m.nome';
    			
    		}elseif (($nome == false) && ($placa == false) && ($ano != false)){
    		 
                $filtro = "WHERE c.ano = ".$ano." ORDER BY m.nome";
                
            }elseif (($nome == false) && ($placa == false) && ($ano = false)){
                
                $filtro = "";
            }
    		
            $con = Conexao::getInstance();
            
            try {
    		    		
        		$sql = 'SELECT c.num_contrato,
        		               ca.placa,
        		               m.nome, 
        		               r.nome as nome_rota,
        		               r.num_rota,
        		               c.id_motorista,
        		               c.id_contrato,
        		               c.id_caminhao, 
        		               c.id_rota, 
        		               c.id_contrato,
        		               m.cpf_cnpj,
        		               m.pis_pasep,
        		               c.ano as anoContrato,
        		               c.data_contrato,
        		               ca.placa,
        		               ca.capacidade,
        		               m.pai,
        		               m.mae,
        		               c.num_empenho,
        		               c.dt_empenho,
        		               c.obs,
        		               r.momento
                                FROM pip_contrato c
                                INNER JOIN pip_caminhao ca
                                ON c.id_caminhao = ca.id_caminhao
                                INNER JOIN pip_motorista m
                                ON c.id_motorista = m.id_motorista
                                INNER JOIN pip_rota r
                                ON c.id_rota = r.id_rota '.$filtro;
        			
        		$result = $con->query($sql);
        		
        		while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
        		
        			self::$d_busca[] = $linha;
        		
        		}
        		
        		return self::$d_busca;
        		
            }catch (Exception $e){
                
                print FuncaoBase::getError($e->getMessage(), 'Mensagem');
                
            }
    		
    	}
    	
    	#@ funcao busca contrato com id
    	function buscaContratoId($_id_contrato) {
    	    
    	    $dados = array();
    	    
    	    $con = Conexao::getInstance();
    	
    	    try{
    	        
    	    
        		$sql = 'SELECT m.nome as nome,
        						c.id_motorista as id_motorista,
        						c.num_contrato as num_contrato,
        						data_contrato as data_contrato,
        						c.id_contrato as id_contrato,
        						c.situacao as situacao,
        						c.dt_rescisao as dt_rescisao,
        						c.obs as obs,
        						c.id_caminhao as id_caminhao,
        						c.id_rota as id_rota,
        						c.num_empenho,
        						c.dt_empenho
        						FROM pip_contrato c
    							INNER JOIN pip_motorista m
    							ON c.id_motorista = m.id_motorista WHERE id_contrato = :id_contrato';
        		    			
        		$result = $con->prepare($sql);
        		
        		$result->bindValue(":id_contrato", $_id_contrato);
        		
        		$result->execute();
        		
        		while($linha = $result->fetch(PDO::FETCH_ASSOC)){
        		
        		    $dados = $linha; 
        		    
        		}
        		return $dados;
        		
    	    }catch (Exception $e){
    	        
    	        print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    	    }
    		
    	}
		
		
    	function pesquisaMotSemContrato($pesquisa) {
    	    
    	    $dados = array();
    	
    		if(!empty($pesquisa))
    		{
    			
    		    try {
    				
        			$sql = "select m.nome
    						from pip_motorista m
    						where m.nome like :pesquisa";
        			
        			$result = $con->prepare($sql); 
        			
        			$result->bindValue(":pesquisa", '%'.$pesquisa.'%');
        			
        			$result->execute();
        	    				
                    while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
        		      					
        					echo "<a href=\"#\" name=\"mot\" id=\"mot\" onclick=\"levarcodigo('$nome');\">".$nome."<a/><br />";
       	
        			}
    			
    		    }catch (Exception $e){
    		        
    		        print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    		    }
    	
    		}
    	
    	
    	
    	}
    	
    	
    	#@ retorna o id do contrato baseado no id motorista
    	function idContratoid_motorista($id_motorista)
    		{
    			$dados = array();
    			
    			$sql = "select id_contrato
    				from pip_contrato
    				where id_motorista = :id_motorista";
    			
    			$result = $con->prepare($sql);
    			
    			$result->bindValue(":id_motorista", $id_motorista);
    			
    			$result->execute();
    			
	    		while($linha = $result->fetch(PDO::FETCH_ASSOC)){
	    			
	    				//var_dump($linha);
	    				$dados = $linha['id_contrato'];
    			
	    		}
	    			
    				return $dados;
    		
    		}
    		
    	#@ rescisao contrato 
    		
    	function rescisaoContrato($id_contrato, $id_motorista, $id_caminhao, $id_rota, $dt_rescisao){
    		    
    	    //rescisao contrato
    	    $sql_contrato = "update pip_contrato set situacao = 'R', dt_rescisao = '".$dt_rescisao."' where id_contrato =".$id_contrato;
    		
    		//print $sql_contrato."<br />";
    		
    		mysql_query($sql_contrato) or die ("erro Passo 1 rescisão");
    		
    		
    	    //rescisao motorista
    	    $sql_motorista = "update pip_motorista set situacao = 'R' where id_motorista = ".$id_motorista;
    	    
    		//print $sql_motorista;

    		mysql_query($sql_motorista) or die (mysql_error()."erro Passo 2 rescisão");    
    	    
    	    
    	    //rescisao caminhao
    	    $sql_caminhao = "update pip_caminhao set situacao = 'R' where id_caminhao = ".$id_caminhao;

    		//print $sql_caminhao;
    		
    		mysql_query($sql_caminhao) or die ("erro Passo 3 rescisão");
    		    
    	    // rescisao rota
    	    $sql_rota = "update pip_rota set situacao = 'R' where id_rota =".$id_rota;
    	    
    		//print $sql_rota;
    		
    		mysql_query($sql_rota) or die ("erro Passo 4 rescisão");

    		Log::GravaLog("Rescisão do Contrato id_contrato:".$id_contrato."", "pip_log");
    		
    	    return true;
    	    
    	}
    	
    	
    	   	
    	
   }?>