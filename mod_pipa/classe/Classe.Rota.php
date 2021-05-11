<?php
/**
 * Classe para Manipulacao de Rotas de Entrega de Água
 * Data Criação : 01/01/2013
 * @author Demetrio Silva Passos
 * 
 */


class Rota extends Log {

    private static $d_rota;

    function PegaNome($id_rota) {
        
        $dados = array();
        
        $con = Conexao::getInstance();

        $sql = "select nome, ano, num_rota from pip_rota where id_rota = :id_rota";
        
        $result = $con->prepare($sql);
        
        $result->bindValue(":id_rota", $id_rota);

        $result->execute();
                
        while($linha = $result->fetch(PDO::FETCH_ASSOC)){

           $dados =  $linha;
        
        }

        return $dados;

    }

    /**
     * Cadastro de Rotas no sistema
     * @param $nomeRota   string - Nome da Rota  
     * @param $momento    string - Momento do Transp
     * @param idMunicipio -
     * @param $situacao   -
     * @param $numRota    -
     * @param $ano
     */
    function cadastroRota($_nome_rota,
            $_momento,
            $_id_municipio,
            $_situacao = 'R',
            $_num_rota,
            $_ano) {

        $sql = 'INSERT INTO pip_rota (nome,
                                      momento,
                                      id_municipio,
                                      situacao,
                                      num_rota,
                                      ano)
                                        VALUES ("'.$_nome_rota.'",
                                        "'.$_momento.'",
                                        '.$_id_municipio.',
                                        "'.$_situacao.'",
                                        "'.$_num_rota.'",
                                        "'.$_ano.'")';

        $result = mysql_query($sql) or die (mysql_error().'erro insercao de rota');
        
        Log::GravaLog($sql, "pip_log");
        	
        return true;

    }
            
     /**
     * Alterar cadastro de Rota no sistema
     * @param $idRota  integer - identificador da rota
     * @param $numRota string  - numero da rota
     * @param $momento string  - momento de transporte
     * @return boolean
     */
     function alterarRota($idRota, $_numRota, $_momento){
       
       $sql = 'UPDATE pip_rota
               SET num_rota ="'.$_numRota.'",
               momento ="'.$_momento.'"
               WHERE id_rota ='.$idRota;

       $result = mysql_query($sql) or die (mysql_error());
       
       Log::GravaLog($sql, "pip_log");
       
       return true; 
     }

    /**
     * Visualiza as as comunidades cadastradas nas rotas
     * @param $idMunicipio integer - Identificador do Municipio
     * @param $rota 
     * @return array
     */
    function visualizarRota($id_rota){
        
        $dados = array();
        
        $con = Conexao::getInstance();
        	
        $sql ='SELECT *
                      FROM pip_rota
                      WHERE id_rota = :idMunicipio
                      ORDER BY nome';
        
        $result = $con->prepare($sql);
        $result->bindValue(":idMunicipio", $id_rota);
        $result->execute();
        
        while($linha = $result->fetch(PDO::FETCH_ASSOC)){
            
            $dados = $linha;
        }
        
        return $dados;
        	
    }

    /**
     * Exibe um select com as rotas para inclusao de comunidades
     * 
     */
    function comboIdRota(){
        	
        $sql = 'SELECT id_rota FROM pip_rota';
        	
        	
        $result = mysql_query($sql) or die (mysql_error());
        	
        print '<select name="id_rota" id="id_rota">
        <option></option>';
        	
        while ($linha = mysql_fetch_assoc($result)) {

            print '<option>'.$linha['id_rota'].'</option>';
        }
        print '</select>';
        	
    }

    #@ exibe quais rotas estão livres para adicionar caminhao
    function comboRotaLivre(){
        	
        $sql ='SELECT id_rota
        FROM pip_rota
        WHERE situacao = 0';
        	
        	
        $result = mysql_query($sql) or die (mysql_error());
        	
        print '<select name="rota" id="rota">
        <option></option>';
        	
        while($linha = mysql_fetch_assoc($result)){

            print '<option>'.$linha['id_rota'].'</option>';
        }

        print '</select>';

    }

    #@ busca de comunidade
    function buscaComunidade($comunidade) {
        	
        $dados = array();
        	
        $sql = 'SELECT nome from pip_comunidade WHERE nome LIKE "%'.$comunidade.'%"';
        	
        //print $sql;
        	
        $result = mysql_query($sql) or die (mysql_error());
        	
        while ($linha = mysql_fetch_assoc($result)) {

            print "<br /><a href=\"#\">".$linha['nome']."</a>";
        }
        	

        	
    }


    #@ busca rota
    function buscaRota($nome, $situacao = false) {
          	
    	$_operador = "= '".$situacao."'";
    	
    	try {
    	    
    	    
    	   $con = Conexao::getInstance();
        	
            $dados = array();
            	
            if($situacao == false) {
                
                $_operador = 'in ("A", "R")';
    
            }
            	
            $sql = 'SELECT nome,
            			 id_rota,
            			 num_rota,
            			 ano,
            			 momento,
            			 situacao,
                         id_municipio
            			 FROM pip_rota
            			 WHERE situacao '.$_operador.' and nome LIKE :nome';
            	
            
            $result = $con->prepare($sql);
            
            $result->bindValue(":nome", '%'.$nome.'%');
            
            $result->execute();
            	
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
    
                $dados[] = $linha;
            }
            	
            return $dados;
    	
    	}catch (Exception $e){
    	    
    	    print FuncaoBase::getError($e->getMessage(), 'Mensagem');
    	    
    	}

    }

    #@ busca a rota para nao cadastrar duclicada
    function buscaRotaDuplicada($nome, $numRota, $_ano) {
        
        
        try {
        
            $con = Conexao::getInstance();
    
            $sql = 'SELECT nome,
                           num_rota
                            FROM pip_rota
                                WHERE nome = :nome
                                AND num_rota = :numRota
                                AND ano = :ano';
            
            $result = $con->prepare($sql);
            
            $result->bindValue(":nome", $nome);
            
            $result->bindValue(":numRota", $numRota);
            
            $result->bindValue(":ano", $_ano);
    
            $result->execute();
            
            if($result->rowCount() > 0) { 
                
                return true;
            
            }
        
        }catch (Exception $e){
            
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
            
        }

    }

    /**
     *  busca dados rota para alterar 
     * @param $idRota integer - Identificador da Rota 
     * 
     */
    function buscaRotaId($idRota) {
        
        $dados = array();
        
        try {
        
            $con = Conexao::getInstance(); 
            
            $sql = 'SELECT nome,
                           momento,
                           num_rota
                            FROM pip_rota
                                WHERE id_rota = :id_rota';
            
            $result = $con->prepare($sql);
                       
            $result->bindValue(":id_rota", $idRota);
            
            $result->execute();
            
            while($linha = $result->fetch(PDO::FETCH_ASSOC)){
            
                $dados = $linha;
                
            }
            
            return $dados;
        
        }catch (Exception $e) {
            
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
            
        }
        
    }
    
    
    /**
     * Atualizar status da rota
     * @param $ano
     * @param $id_rota
     * 
     * 
     */
    public static function updateStatusRota($ano, $id_rota){
        
        
        $con = Conexao::getInstance();
        
        try {
            
            $sql = "UPDATE pip_rota SET situacao = 'A', ano = :ano WHERE id_rota = :id_rota";
            
            $result = $con->prepare($sql);
            
            $result->bindValue(":ano", $ano);
            $result->bindValue(":id_rota", $id_rota);
            
            $result->execute();
            
            return true;
            
        } catch (Exception $e) {
        
            print FuncaoBase::getError($e->getMessage(), 'Mensagem');
        
        }
        
        
    }
    
  
}?>