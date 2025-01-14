<?php


class MembroEqCompdec {
    
    
    static function novo($dados){
    
        $con = Conexao::getInstance();

        try{
    
            $sql = "INSERT INTO com_eq_comdec (nome, funcao, telefone, celular, email, id_municipio, cpf, status)
                                        VALUES (:nome,
                                                :funcao,
                                                :telefone,
                                                :celular,
                                                :email,
                                                :id_municipio,
                                                :cpf,
                                                :status)";
    
            $result = $con->prepare($sql);
            $result->bindValue(":nome", strtoupper(FuncaoBase::tirarAcentos($dados['txtNomeMembro'])));
            $result->bindValue(":funcao", strtoupper(FuncaoBase::tirarAcentos($dados['selFuncaoMembro'])));
            $result->bindValue(":telefone", $dados['txtTelMembro']);
            $result->bindValue(":celular", $dados['txtCelMembro']);
            $result->bindValue(":email", $dados['txtEmailMembro']);
            $result->bindValue(":id_municipio", $dados['txtIdMunicipio'], PDO::PARAM_INT);
            $result->bindValue(":cpf", $dados['txtCpf']);
            $result->bindValue(":status", 1);
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
    static function alterar($dados){
        
   	
    	$con = Conexao::getInstance();
    	
    	try{
    		
    		$sql = "UPDATE com_eq_comdec
                                            SET nome     = :nome,
						funcao   = :funcao,
						telefone = :telefone,
						celular  = :celular,
						email    = :email,
                                                cpf      = :cpf,
                                                status   = :status
		                		WHERE id_equipe = :id_equipe";
    		    		
    		$result = $con->prepare($sql);
    		$result->bindValue(":nome", $dados['txtNomeMembro']);
    		$result->bindValue(":funcao", $dados['selFuncaoMembro']);
    		$result->bindValue(":telefone", $dados['txtTelMembro']);
    		$result->bindValue(":celular", $dados['txtCelMembro']);
    		$result->bindValue(":email", $dados['txtEmailMembro']);
    		$result->bindValue(":cpf", $dados['txtCpf']);
    		$result->bindValue(":status", $dados['status']);
    		$result->bindValue(":id_equipe", $dados['id_equipe'], PDO::PARAM_INT);
    		$result->execute();
    		
    		return true;
    		
    		
    	}catch (Exception $e) {
    		
    		print $result->debugDumpParams();
    		print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    	}
    	
    	
    }
    
    
    /**
     * Alterar Registro
     * 
     * @param unknown $dados
     * @return boolean
     */
    static function statusMembro($dados){
        
        var_dump($dados);
        die();
    	
    	$con = Conexao::getInstance();
    	
    	try{
    		
    		$sql = "UPDATE com_eq_comdec
						SET status = :status
		                		WHERE id_equipe = :id_equipe";
    		    		
    		$result = $con->prepare($sql);
    		$result->bindValue(":status", $dados['txtStatus']);   		
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

    public function listaMembro($id_municipio, $status = 1){
    
        $dados = array();

        try{
    
            $con = Conexao::getInstance();

               $sql = "SELECT id_equipe,
                                   nome,
                                   funcao,
                                   telefone,
                                   celular,
                                   email,
                                   cpf,
                                   status
                                        FROM
                                            com_eq_comdec
                                        WHERE id_municipio = :id_municipio 
                                        and status = :status";
    
    
                $result = $con->prepare($sql);
                $result->bindValue(":id_municipio", $id_municipio);
                $result->bindValue(":status", $status);
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
     * 
     * @param type $id
     * @return array
     * 
     */
    public static function getMembroCoordenador($id_municipio){
        
        $con = Conexao::getInstance();
        
        $sql = "SELECT *from com_eq_comdec
                where id_municipio = {$id_municipio}
                and lower(funcao) = 'coordenador'
                and status = 1";
        
        $result = $con->query($sql);
               
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    
    /**
     * 
     * @param type $id
     * @return array
     * 
     */
    public static function getMembro($dados){
        
        $con = Conexao::getInstance();

        //var_dump($dados);
        
        $sql = "SELECT *from com_eq_comdec
                where id_municipio = ".$dados['id_municipio']."
                and status = 1";
        
        $result = $con->query($sql);
               
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    
    
    /**
     * 
     * @param type $id
     * @return boolean
     */
    public static function buscaMembro($id){
        
        $con = Conexao::getInstance();
        
        $sql = "SELECT * from com_eq_comdec where id_equipe = ".$id;
        
        $result = $con->query($sql);
                
        return $result->fetch(PDO::FETCH_ASSOC);
        
    }
    
    
    /**
     * 
     * @param type $id
     * @return boolean
     * @see Obs: somente desativar
     * 
     */
    public function delete($id){
    
        $con = Conexao::getInstance();
        
        try{
            
//            $sql = "DELETE FROM com_eq_comdec
//                            WHERE id_equipe = :id_equipe";
            
            $sql = "update com_eq_comdec
                            set status = 0
                            where id_equipe = :id_equipe";
    
            $result = $con->prepare($sql);
            $result->bindValue(":id_equipe", $id);
            $result->execute();
                  
    
            return true;
    
        }catch (Exception $e){
    
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    
        }
    
    }
    
    
    public static function desativaCoordAntigo($municipio_id) {
        
        $con = Conexao::getInstance();
        
        $sql = "update com_eq_comdec set status = 0
                where id_municipio = ".$municipio_id."
                and lower(funcao) = 'coordenador'";
        
        $result = $con->query($sql);
               
        return $result->fetch(PDO::FETCH_ASSOC);
        
        
    }
    
    
    public static function existeCoord($dados) {
        
        $con = Conexao::getInstance();
        
        $sql = "SELECT id_equipe from com_eq_comdec where cpf = '".$dados['txtCpf']."' and id_municipio = '".$dados['id_municipio']."'";
        
        $result = $con->query($sql);
        
        $dados = [
                'result'    => $result->rowCount(),
                'dado' =>  $result->fetch(PDO::FETCH_ASSOC),
                ];
        
        return $dados;
    }
        
    /**
     * busca qtd coordenadores ativos por municipio
     */
    public static function existeCoordMun($municipio_id) {
        
        $con = Conexao::getInstance();
        
        $sql = "SELECT count(id_equipe) as num_coord
                    from com_eq_comdec 
                    where id_municipio = '".$municipio_id."'
                    and funcao = 'COORDENADOR'
                    and status = 1";
        
        $result = $con->query($sql);
        
        $total = $result->fetchColumn();
        
       
        return ['total' => $total,
                'dados' => $result->fetch(PDO::FETCH_ASSOC)];
        
    }



}?>