<?php


class RepPmda {
	
	
	/**
	 * Cadastro novo de pmda
	 * 
	 */
	function novoRep($dados) {
		
		$con = Conexao::getInstance();
		
		try{

			/* contar representante  */
		    $sql1 = "SELECT COUNT(id)
            	FROM pip_representante
            		WHERE id_comunidade = :id_comunidade
		    			AND id_pmda = :id_pmda";
		    
		    $result1 = $con->prepare($sql1);
		    
		    $result1->bindParam(":id_comunidade", $dados['id_comunidade']);
		    $result1->bindParam(":id_pmda", $dados['id_pmda']);
		    $result1->execute();
		    

		    $rep = $result1->fetchColumn();
		    
			if($rep < 3){
			    	
				$sql = "INSERT INTO pip_representante (id_comunidade,
															 nome,
														 	 tel,
															 endereco,
															 bairro,
															 email,
															 cpf,
                                                             watsapp,
															 id_pmda)
																VALUE (:id_comunidade,
																	   :nome,
																	   :tel,
																	   :endereco,
																	   :bairro,
																	   :email,
																	   :cpf,
                                                                       :watsapp,
																	   :id_pmda)";
				
				$result = $con->prepare($sql);
				
				$result->bindValue(":id_comunidade", $dados['id_comunidade']);
				$result->bindValue(":nome", strtoupper(FuncaoBase::tirarAcentos($dados['txtNomeRep'])));
				$result->bindValue(":tel", $dados['txtTelRep']);
				$result->bindValue(":endereco", strtoupper(FuncaoBase::tirarAcentos($dados['txtEnderecoRep'])));
				$result->bindValue(":bairro", strtoupper(FuncaoBase::tirarAcentos($dados['txtBairroRep'])));
				$result->bindValue(":email", strtolower(FuncaoBase::tirarAcentos($dados['txtEmailRep'])));
				$result->bindValue(":cpf", $dados['txtCpfRep']);
				$result->bindValue(":watsapp", $dados['selWatsapp']);
				$result->bindValue(":id_pmda", $dados['id_pmda']);
				$result->execute();
				
				print "<script>alert(\"Registro adicionado com sucesso !\");</script>";
				
				//Log::GravaLogUserEx("Representante Cadastrado: ".strtoupper(FuncaoBase::tirarAcentos($dados['txtNomeRep'])).",".$dados['txtCpfRep'], "cedec_user_ex_log", $dados['id_pmda']);
				
				return true;
				
			}else {
				
				/* mensagem de limite de representantes */
			    print "<script>alert(\"Cada comunidade deve ter no máximo 3 representantes !\");</script>";
				
			}
					
			
		}catch (Exception $e) {
			
			//$result->debugDumpParams();
			print FuncaoBase::getError($e->getMessage(), "Representante já cadastrado", false);
		}
		
	}
	
	/**
	 * Busca Representante Duplicado PMDA
	 *
	 */
	function buscaRepDupPmda($cpf, $id_pmda) {
	
		$con = Conexao::getInstance();
	
		try{
	
			/* contar representante  */
			$sql = "SELECT cpf
            	FROM pip_representante
            		WHERE cpf = :cpf
					AND id_pmda = :id_pmda";
	
			$result = $con->prepare($sql);
	
			$result->bindParam(":cpf", $cpf);
			$result->bindParam(":id_pmda", $id_pmda);
			$result->execute();
			$rep = (int)$result->rowCount();
	
			
			if($rep >= 1){
				return true;
			}else {
				return false;
			}
				
		}catch (Exception $e) {	
			print $e->getMessage(). "";
		}
	
	}
	
	
	/**
	 * Alterar Representante 
	 *
	 */
	function alterarRep($dados) {
		
		$con = Conexao::getInstance();
		
		try{
			
			$sql = "UPDATE pip_representante SET nome = :nome,
												 tel =  :tel,
												 endereco = :endereco,
												 bairro = :bairro,
												 email = :email,
												 cpf = :cpf,
                                                 watsapp = :watsapp
													WHERE id = :id_rep";

			$result = $con->prepare($sql);
			
			$result->bindValue(":id_rep", $dados['id_rep']);
			$result->bindValue(":nome", strtoupper(FuncaoBase::tirarAcentos($dados['txtNomeRep'])));
			$result->bindValue(":tel", $dados['txtTelRep']);
			$result->bindValue(":endereco", strtoupper(FuncaoBase::tirarAcentos($dados['txtEnderecoRep'])));
			$result->bindValue(":bairro", strtoupper(FuncaoBase::tirarAcentos($dados['txtBairroRep'])));
			$result->bindValue(":email", $dados['txtEmailRep']);
			$result->bindValue(":cpf", $dados['txtCpfRep']);
			$result->bindValue(":watsapp", $dados['selWatsapp']);
			$result->execute();
			
			//Log::GravaLogUserEx("Dados de Representante Alterado: ".strtoupper(FuncaoBase::tirarAcentos($dados['txtNomeRep'])).",".$dados['txtCpfRep'], "cedec_user_ex_log", $dados['id_pmda']);
			
			return true;
			
		}catch (Exception $e) {
			
			$result->debugDumpParams();
			print FuncaoBase::getError($e->getMessage(), 'Mensagem');
		}
		
	}
	
	/**
	 * 
	 * 
	 * 
	 */


	
	/**
	 * Lista de Representante da Comunidade
	 * 
	 */
	public function listaRepComunidade($id_comunidade, $id_pmda = false){
		
		$con = Conexao::getInstance();
		$dados = array();
		
		try{
			$sql = "SELECT id,
							id_comunidade,
								 nome,
								 tel,
								 endereco,
								 bairro,
								 email,
								 cpf,
                                 watsapp
									FROM pip_representante
										WHERE id_comunidade = :id_comunidade
											AND id_pmda = :id_pmda";
			
			$result = $con->prepare($sql);
			$result->bindParam(":id_comunidade", $id_comunidade);
			$result->bindParam(":id_pmda", $id_pmda);
			$result->execute();
			
			while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
				$dados[] = $linha;
			}
			
			return $dados;
			
		}catch (Exception $e) {
			print FuncaoBase::getError($e->getMessage(), 'Mensagem');
		}
		
		
		
	}


	public function deletarRep($id_rep, $id_pmda){
		
		$con = Conexao::getInstance();
		
		try{
			
			$sql = "DELETE FROM pip_representante
                            WHERE id = :id_rep";
			
			$result = $con->prepare($sql);
			$result->bindParam(":id_rep", $id_rep);
			$result->execute();
			
			//Log::GravaLogUserEx("Remoção de Representante ", "cedec_user_ex_log", $id_pmda);
			
			return true;
			
		}catch (Exception $e){
			
			print FuncaoBase::getError($e->getMessage(), 'Mensagem');
			
		}
		
	}





}?>