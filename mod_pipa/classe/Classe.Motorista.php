<?php

	include_once PATH.'/core/classe/Classe.Log.php';

	class Motorista extends Log {
		
		
		private static $buscaMotorista;
		
	
		#@ cadastro de motorista
		function cadastroMotorista($nome, $endereco, $bairro, $cidade, $email, $cep, $uf, $tel, $cel, $cpf_cnpj, $rg,
								$orgao, $inscr_est, $pis_pasep, $cnh, $inscr_mun, $banco, $agencia, $conta, $tipo, $mbanco, 
								$pessoa, $nome_rep, $cpf_rep, $rg_rep, $orgao_rep, $est_civil_rep, $natural_rep, $pai, $mae, $placa, $dt_nasc, $situacao = 'R') {
								  
			$con = Conexao::getInstance();
			
			try{
			
    			$sql = 'INSERT INTO pip_motorista
    				(nome, endereco, bairro, cidade, email, cep, uf, tel, cel, cpf_cnpj, rg, orgao, inscr_est,
    				pis_pasep, cnh, inscr_mun, banco, agencia, conta,  tipo, mbanco, pessoa, nome_rep, cpf_rep, 
    				rg_rep, orgao_rep, est_civil_rep, natural_rep, pai, mae, placa, dt_nasc, situacao) 
    				VALUES (:nome,
                            :endereco,
                            :bairro,
                            :cidade,
                            :email,
                            :cep,
                            :uf,
                            :tel,
                            :cel,
                            :cpf_cnpj,
                            :rg,
                            :orgao,
                            :inscr_est,
                            :pis_pasep,
                            :cnh,
                            :inscr_mun,
                            :banco,
                            :agencia,
                            :conta,
                            :tipo,
                            :mbanco,
                            :pessoa,
                            :nome_rep,
                            :cpf_rep,
                            :rg_rep,
                            :orgao_rep,
                            :est_civil_rep,
                            :natural_rep,
                            :pai,
                            :mae,
                            :placa,
                            :dt_nasc,
                            :situacao)';
    			
    			$result = $con->prepare($sql);
    			
    			$result->bindValue(":nome"         , $nome);
    			$result->bindValue(":endereco"     , $endereco);
    			$result->bindValue(":bairro"       , $bairro);
    			$result->bindValue(":cidade"       , $cidade);
    			$result->bindValue(":email"        , $email);
    			$result->bindValue(":cep"          , $cep);
    			$result->bindValue(":uf"           , $uf);
    			$result->bindValue(":tel"          , $tel);
    			$result->bindValue(":cel"          , $cel);
    			$result->bindValue(":cpf_cnpj"     , $cpf_cnpj);
    			$result->bindValue(":rg"           , $rg);
    			$result->bindValue(":orgao"        , $orgao);
    			$result->bindValue(":inscr_est"    , $inscr_est);
    			$result->bindValue(":pis_pasep"    , $pis_pasep);
    			$result->bindValue(":cnh"          , $cnh);
    			$result->bindValue(":inscr_mun"    , $inscr_mun);
    			$result->bindValue(":banco"        , $banco);
    			$result->bindValue(":agencia"      , $agencia);
    			$result->bindValue(":conta"        , $conta);
    			$result->bindValue(":tipo"         , $tipo);
    			$result->bindValue(":mbanco"       , $mbanco);
    			$result->bindValue(":pessoa"       , $pessoa);
    			$result->bindValue(":nome_rep"     , $nome_rep);
    			$result->bindValue(":cpf_rep"      , $cpf_rep);
    			$result->bindValue(":rg_rep"       , $rg_rep);
    			$result->bindValue(":orgao_rep"    , $orgao_rep);
    			$result->bindValue(":est_civil_rep", $est_civil_rep);
    			$result->bindValue(":natural_rep"  , $natural_rep);
    			$result->bindValue(":pai"          , $pai);
    			$result->bindValue(":mae"          , $mae);
    			$result->bindValue(":placa"        , $placa);
    			$result->bindValue(":dt_nasc"      , $dt_nasc);
    			$result->bindValue(":situacao"     , $situacao);
    			
    			$result->execute();
    					
    			Log::GravaLog($sql, "pip_log");
    			
    			return true;
    			
			}catch (Exception $e) {
			    
			    print FuncaoBase::getError($e->getMessage(), 'Erro ao Cadastrar Motorista');
			}
				
		}
		
		#@ altera cadastro de motorista
		function AlteraCadastroMotorista($nome, $endereco, $bairro, $cidade, $email, $cep, $uf, $tel, $cel, $cpf_cnpj, $rg,
								$orgao, $inscr_est, $pis_pasep, $cnh, $inscr_mun, $banco, $agencia, $conta, $tipo, $mbanco, 
								$pessoa, $nome_rep, $cpf_rep, $rg_rep, $orgao_rep, $est_civil_rep, $natural_rep, $pai, $mae, $placa, $_id_motorista, $_dt_nasc) {
			
			$con = Conexao::getInstance();
			
			try{
			
    			$sql = 'UPDATE pip_motorista SET nome = "'.$nome.'", endereco = "'.$endereco.'", bairro = "'.$bairro.'", cidade = "'.$cidade.'",
    					email = "'.$email.'", cep = "'.$cep.'", uf = "'.$uf.'", tel = "'.$tel.'", cel = "'.$cel.'", cpf_cnpj = "'.$cpf_cnpj.'",
    					rg = "'.$rg.'", orgao = "'.$orgao.'", inscr_est = "'.$inscr_est.'",
    				pis_pasep = "'.$pis_pasep.'", cnh = "'.$cnh.'", inscr_mun = "'.$inscr_mun.'", banco = "'.$banco.'", agencia = "'.$agencia.'", conta = "'.$conta.'",  tipo = "'.$tipo.'", mbanco = "'.$mbanco.'",
    				pessoa = "'.$pessoa.'", nome_rep = "'.$nome_rep.'", cpf_rep = "'.$cpf_rep.'", rg_rep = "'.$rg_rep.'", orgao_rep = "'.$orgao_rep.'",
    				est_civil_rep = "'.$est_civil_rep.'", natural_rep = "'.$natural_rep.'", pai = "'.$pai.'", mae = "'.$mae.'", placa = "'.$placa.'", dt_nasc = "'.$_dt_nasc.'"
    				WHERE id_motorista = "'.$_id_motorista.'"'; 
    							
    			FuncaoBase::vd($sql);
    			
    		
    			mysql_query($sql) or die (mysql_error());
    			
    			Log::GravaLog($sql, "pip_log");
    			
    			return true;
			
			}catch (Exception $e) {
			    
			    print FuncaoBase::getError($e->getMessage(), 'Mensagem');
			}
				
		}
		
		
		#@ mostra motorista
		function mostraMotorista($_id_motorista) {
			
		    $dados = array();
		    
		    $con = Conexao::getInstance();
		    
		    try{
			
    			$sql = 'Select *from pip_motorista';
    			
    			$result = $con->query($sql);
    			
    			while ($linha =$result->fetch(PDO::FETCH_ASSOC)) {
    					
    				$dados[] = $linha;
    				 
    			}
    			return $dados;
		    }catch (Exception $e){
		        
		        print FuncaoBase::getError($e->getMessage(), 'Mensagem');
		    }
			
		}
		
		
		#@ busca todos os dados do motorista com base no cpf 
		static function buscaMotorista($_cpf){
		    
		    $dados = array();
		    
		    $con = Conexao::getInstance();
		    
		    try{
			
    			$sql = 'SELECT * FROM pip_motorista WHERE cpf_cnpj = :cpf';
    			
    			$result = $con->prepare($sql);
    			
    			$result->bindValue(":cpf", $_cpf);
    			
    			$result->execute();
    			
    			while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    				
    				$dados [] = $linha; 
    				
    			}
    			
    			return $dados;
    			
    			
		    }catch (Exception $e){
		        
		        print FuncaoBase::getError($e->getMessage(), 'Mensagem');
		    }
	
		}
        
        
        /**
         * busca motorista cadastrado na base, pelo cpf
         * @param cpf
         * return bool
         * 
         */ 
        static function verificaMotoristaCadastrado($_cpf, $placa){
            
            $dados = array();
            
            $con = Conexao::getInstance();
            
            try{
            
                $sql = 'SELECT cpf_cnpj, pessoa, placa FROM pip_motorista WHERE cpf_cnpj = :cpf and placa = :placa';
                
                $result = $con->prepare($sql);
                
                $result->bindValue(":cpf", $_cpf);
                $result->bindValue(":placa", $placa);
                
                $result->execute();
                
                while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                
                    $dados = $linha;
                
                }
                    
                if($result->rowCount() > 0){
                    
                    return true;   
                    
                }else {
                    
                    return false;
                }
            }catch (Exception $e){
                
                print FuncaoBase::getError($e->getMessage(), 'Mensagem');
            }
                
                
        }

		
		#@ busca todos os dados do motorista com base no id
		static function buscaDadosMotoristaId($_id){
		    
		    $con = Conexao::getInstance();
		    
		    $dados = array();
		    	
		    try{
		        
    		    $sql = 'SELECT * FROM pip_motorista WHERE id_motorista = :id';
    		    
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
		
				
		#@ busca motorista com base id
		function buscaMotoristaNome($_id){
			
			try{
			
				$con = Conexao::getInstance();
					
				$sql = 'SELECT nome FROM pip_motorista WHERE id_motorista = :id';
					
				$result = $con->prepare($sql);
				$result->bindParam(":id", $_id);
					
				$linha = $result->fetch(PDO::FETCH_ASSOC); 
			
				return utf8_encode($linha['nome']);
			}catch (Exception $e){
				
				print $e->getMessage();
				
			}

		}
		
				
		#@ busca id motorista com base nome
		function buscaMotoristaid($_nome){
				
			$sql = 'SELECT id_motorista FROM pip_motorista WHERE nome = "'.$_nome.'"';
				
			$result = mysql_query($sql) or die (mysql_error());
				
			$linha = mysql_fetch_assoc($result); 
		
			return $linha['id_motorista'];

		}
		
		#@ consulta dados motorista com base nome
		function consultaMotoristaNome($_nome){
			
			$dados = array();
		
			$sql = 'SELECT * FROM pip_motorista WHERE nome like "%'.$_nome.'%"';
			
			//print $sql;
		
			$result = mysql_query($sql) or die (mysql_error());
		
			while ($linha = mysql_fetch_assoc($result)) {
		
				$dados[] = $linha;
				
			}
			
			return $dados;
		
		}
		
		#@ alimenta um select com nome de motorista que não tem caminhao
		function nomeMotorista(){
			
			$sql = "SELECT m.nome
					from pip_motorista m
					where m.id_motorista not in (select id_motorista from pip_contrato where situacao = 'A')";
			
		
			$result = mysql_query($sql) or die (mysql_error());
			
			print '<select name="nome_mot" id="nome_mot">' .
						'<option></option>';
						
			while ( $linha = mysql_fetch_array($result) ) {
	
				print '<option>'.htmlentities($linha[0]).'</option>';
	
			}
			
			print '</select>';
			
			
		}
		
		
		#@ alimenta um select com nome de motorista que não tem contrato
		static function MotoristaSemContrato($_cpf){
			
			$dados = array();
			
			$con = Conexao::getInstance();
			
			try{
			
    			$sql = "SELECT id_motorista, nome, situacao, placa, pessoa
    					FROM pip_motorista
    					WHERE cpf_cnpj = :cpf";
    			
    			$result = $con->prepare($sql);
    			
    			$result->bindValue(":cpf", $_cpf);
    				
    			$result->execute();
    			
    			while ( $linha = $result->fetch(PDO::FETCH_ASSOC)) {
    	
    				$dados[] = $linha;
    			
    			}
    					
    			 return $dados;
			}catch (Exception $e){
			    
			    print FuncaoBase::getError($e->getMessage(), 'Mensagem');
			}
						
			
		}
		
		#@ select com motorista sem rota
		function MotoristaSemRota(){
			
			$d_motSemRota = array();
						
			$sql = 'select m.nome 
					from pip_motorista m
					inner join pip_rota r
					on m.id_motorista = r.id_motorista
					where r.num_rota is null';

			$result = mysql_query($sql) or die (mysql_error());
			
			print '<select>
					<option></option>';
			
			while ($linha = mysql_fetch_array($result)) {

				print '<option>'.htmlentities($linha['nome']).'</option>';
			}
			print '</select>';
			
			
		}
		
		
		
	#@ atualiza placa motorista
	function atualiza_placa($_id_motorista, $_placa){
		
		$sql ='UPDATE pip_motorista SET placa="'.$_placa.'"
				WHERE id_motorista='.$_id_motorista.'';
						
		$result = mysql_query($sql) or die (mysql_error());
		
		#@ grava Log
		Log::GravaLog($sql, "pip_log");
		
		return true;	
	
	
	}
	
	
	/**
	 * 
	 * Atualizaçao status motorista 
	 * 
	 * @param id_motorista
	 * 
	 */
	public static function updateStatusMotorista($id_motorista){
	    
	    $con = Conexao::getInstance();
	    
	    try{
	    
    	    $sql = "UPDATE pip_motorista SET situacao = 'A' WHERE id_motorista = :id_motorista";
    	    
    	    $result = $con->prepare($sql);
    	    
    	    $result->bindValue(":id_motorista", $id_motorista);
    	    
    	    $result->execute();
    	
    	   return true;
	    
	    }catch (Exception $e) {
	        
	        print FuncaoBase::getError($e->getMessage(), 'Mensagem');
            
	    }
	
	}
	
	
	
	
	
	
	
	
	
	
}?>