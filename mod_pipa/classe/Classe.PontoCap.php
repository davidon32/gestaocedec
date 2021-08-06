<?php

    class PontoCap {
        
        /**
         * Inserir Ponto de Captacao
         * @param unknown $dados
         * @return boolean
         */
        
        function novo($dados){
                
                $con = Conexao::getInstance();

                try{
                    
                    $sql = "INSERT INTO pip_ponto_cap (nome, tipo, latitude, longitude, capacidade, id_municipio)
                                            VALUES (:nome,
                                                    :tipo,
                                                    :latitude,
                                                    :longitude,
                                                    :capacidade,
                                                    :id_municipio)";
                    
                    $result = $con->prepare($sql);
                    $result->bindValue(":nome", strtoupper(FuncaoBase::tirarAcentos($dados['txtNomePontoCap'])));
                    $result->bindValue(":tipo", $dados['selTipoPontoCap']);
                    $result->bindValue(":latitude", $dados['txtLatPontoCap']);
                    $result->bindValue(":longitude", $dados['txtLongPontoCap']);
                    $result->bindValue(":capacidade", $dados['txtCapacidadePontoCap']);
                    $result->bindValue(":id_municipio", $dados['txtIdMunicipio']);
                    
                    $result->execute();
                                     
                    //Log::GravaLogUserEx("Cadastro Ponto Captação", "cedec_user_ex_log", false);
                    
                    return true;
 
                }catch (Exception $e) {

                    print FuncaoBase::getError($e->getMessage(), 'Mensagem');
                }
                
                
            }
            
            
            /**
             * Alterar Ponto de Captacao
             * @param unknown $dados
             * @return boolean
             */
            
            function alterarPonto($dados){
            	
            	$con = Conexao::getInstance();
            	
            	try{
            		
            		$sql = "UPDATE pip_ponto_cap
								SET id_municipio = :id_municipio,
									nome = :nome,
									tipo = :tipo,
									latitude = :latitude,
									longitude = :longitude,
									capacidade = :capacidade
										WHERE id_ponto = :id_ponto";
            		
            		$result = $con->prepare($sql);
            		$result->bindValue(":nome", strtoupper(FuncaoBase::tirarAcentos($dados['txtNomePontoCap'])));
            		$result->bindValue(":tipo", $dados['selTipoPontoCap']);
            		$result->bindValue(":latitude", $dados['txtLatPontoCap']);
            		$result->bindValue(":longitude", $dados['txtLongPontoCap']);
            		$result->bindValue(":capacidade", $dados['txtCapacidadePontoCap'], PDO::PARAM_INT);
            		$result->bindValue(":id_municipio", $dados['txtIdMunicipio']);
            		$result->bindValue(":id_ponto", $dados['id_ponto']);
            		
            		$result->execute();
            		
            		
            		//Log::GravaLogUserEx("Alteração dados do Ponto Captação", "cedec_user_ex_log", false);
            		
            		return true;
            		
            		
            		
            	}catch (Exception $e) {

            		print FuncaoBase::getError($e->getMessage(), 'Mensagem');
            	}
            	
            	
            }
        
        public function listaPCaptacao($id_municipio = null){
        
            $dados = array();
        
            try{
            
            $con = Conexao::getInstance();
                      
            	if(empty($id_municipio)){
                    $sql = "SELECT id_ponto,
                                   nome,
                                   tipo,
                                   latitude,
                                   longitude,
                                   capacidade,
                                   id_municipio
                                        FROM
                                            pip_ponto_cap
                                        LIMIT 10";
     
            }else{
                    
                    $sql = "SELECT id_ponto,
                                   nome,
                                   tipo,
                                   latitude,
                                   longitude,
                                   capacidade,
                                   id_municipio
                                        FROM
                                            pip_ponto_cap
                                        WHERE id_municipio = $id_municipio";
                    
            }
                    $result = $con->query($sql);

                $result->execute();
        
                while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
        
                    $dados[] = $linha;
        
                }
        
                return $dados;
        
            }catch (Exception $e) {
        
                print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        
            }
        
        
        }
        
        /**
         * Traduz o tipo do ponto de captação de água
         * @param $tipo (int)
         * @return string
         */
        public function enumTipoCap($tipo){
        
            switch ($tipo) {
                case 1:
                    return "COPASA";
                    break;
                case 2:
                    return "COPANOR";
                    break;
                case 3:
                    return "BARRAGEM";
                    break;
                case 4:
                    return "SAAE / DMAE";
                    break;
                case 5:
                    return "POÇO ARTESIANO PÚBLICO";
                    break;
                case 6:
                    return "POÇO ARTESIANO PARTICULAR";
                    break;
                default:
                    return "Oopção Invalida";
                    break;
            }
        
        }
    
    
    public function delete($id){
        
        $con = Conexao::getInstance();
        
        try{
        
            $sql = "DELETE FROM pip_ponto_cap
                            WHERE id_ponto = :id_ponto";
        
            $result = $con->prepare($sql);
            $result->bindValue(":id_ponto", $id);
            $result->execute();
            
            //Log::GravaLogUserEx("Ponto de Captação Deletado", "cedec_user_ex_log", false);
            
            return true;
            
        }catch (Exception $e){
            
            if( strpos($e->getMessage(), "SQLSTATE[23000]") == "0" ){
            	print "<p style='text-center' class='alert alert-danger'>Este ponto de Captação está cadastrado em uma Comunidade ! \n por isso não poderá ser apagado, favor remover este Ponto de Captação da Comunidade em que está cadastrado.</p>";
            }else {

        		print FuncaoBase::getError($e->getMessage(), 'Mensagem');
            }
            
        }
        
    }
    
    
    /**
     * Nome do ponto Cap
     * 
     */
	 public static function getNomePontoCap($id_ponto){
	 	
 		$con = Conexao::getInstance();
	 	$dados = array();
	 	
	 	try{
	 		$sql = "SELECT id_ponto,
                           nome
							 FROM pip_ponto_cap
								WHERE id_ponto = :id_ponto";
	 			
	 			$result = $con->prepare($sql);
	 			$result->bindValue(":id_ponto", $id_ponto);
	 			$result->execute();
	 		
		 		while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
		 			$dados = $linha;
		 		}
		 		
		 		return $dados;
		 		
		 	}catch (Exception $e) {
		 		print FuncaoBase::getError($e->getMessage(), 'Mensagem');
		 	}
	 	
	 }

}?>