<?php


class MembroEqCompdec {
    
    
    function novo($dados){
    
        $con = Conexao::getInstance();

        try{
    
            $sql = "INSERT INTO com_eq_comdec (nome, funcao, telefone, celular, email, id_municipio)
                                        VALUES (:nome,
                                                :funcao,
                                                :telefone,
                                                :celular,
                                                :email,
                                                :id_municipio)";
    
            $result = $con->prepare($sql);
            $result->bindValue(":nome", strtoupper(FuncaoBase::tirarAcentos($dados['txtNomeMembro'])));
            $result->bindValue(":funcao", strtoupper(FuncaoBase::tirarAcentos($dados['selFuncaoMembro'])));
            $result->bindValue(":telefone", $dados['txtTelMembro']);
            $result->bindValue(":celular", $dados['txtCelMembro']);
            $result->bindValue(":email", $dados['txtEmailMembro']);
            $result->bindValue(":id_municipio", $dados['txtIdMunicipio'], PDO::PARAM_INT);
            $result->execute();
    
            return true;
    
    
    
        }catch (Exception $e) {
    
            $result->debugDumpParams();
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        }
    
    
    }
    
    /**
     * Alterar Registro
     * 
     * @param unknown $dados
     * @return boolean
     */
    function alterar($dados){
    	
    	$con = Conexao::getInstance();
    	
    	try{
    		
    		$sql = "UPDATE com_eq_comdec
						SET nome = :nome,
							funcao = :funcao,
							telefone = :telefone,
							celular = :celular,
							email = :email
		                		WHERE id_equipe = :id_equipe";
    		    		
    		$result = $con->prepare($sql);
    		$result->bindValue(":nome", $dados['txtNomeMembro']);
    		$result->bindValue(":funcao", $dados['selFuncaoMembro']);
    		$result->bindValue(":telefone", $dados['txtTelMembro']);
    		$result->bindValue(":celular", $dados['txtCelMembro']);
    		$result->bindValue(":email", $dados['txtEmailMembro']);
    		$result->bindValue(":id_equipe", $dados['id_equipe'], PDO::PARAM_INT);
    		$result->execute();
    		
    		return true;
    		
    		
    		
    	}catch (Exception $e) {
    		
    		print $result->debugDumpParams();
    		print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    	}
    	
    	
    }
    
    
    /**
     * 
     * 
     * @param unknown $id_municipio
     */

    public function listaMembro($id_municipio){
    
        $dados = array();

        try{
    
            $con = Conexao::getInstance();

               $sql = "SELECT id_equipe,
                                   nome,
                                   funcao,
                                   telefone,
                                   celular,
                                   email
                                        FROM
                                            com_eq_comdec
                                        WHERE id_municipio = :id_municipio";
    
    
                $result = $con->prepare($sql);
                $result->bindValue(":id_municipio", $id_municipio);
                $result->execute();
    
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
    
                $dados[] = $linha;
    
            }
    
            return $dados;
    
        }catch (Exception $e) {
    
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    
        }
    
    
    }
    
    
    public function delete($id){
    
        $con = Conexao::getInstance();
    
        try{
    
            $sql = "DELETE FROM com_eq_comdec
                            WHERE id_equipe = :id_equipe";
    
            $result = $con->prepare($sql);
            $result->bindValue(":id_equipe", $id);
            $result->execute();
    
            return true;
    
        }catch (Exception $e){
    
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    
        }
    
    }



}?>