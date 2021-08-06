<?php

    class Professor{
        
    private $idProfessor = null;
    private $nome = null;
    private $numPolicia = null;
    private $profissao = null;
    private $posto = null;
    private $obs = null;
    private $cpf = null;

    public function getIdProfessor(){
        return $this->idProfessor;
    }

    public function setIdProfessor($idProfessor){
        $this->idProfessor = $idProfessor;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNumPolicia(){
        return $this->numPolicia;
    }

    public function setNumPolicia($numPolicia){
        $this->numPolicia = $numPolicia;
    }

    public function getProfissao(){
        return $this->profissao;
    }

    public function setProfissao($profissao){
        $this->profissao = $profissao;
    }

    public function getPosto(){
        return $this->posto;
    }

    public function setPosto($posto){
        $this->posto = $posto;
    }

    public function getObs(){
        return $this->obs;
    }

    public function setObs($obs){
        $this->obs = $obs;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }
    
    
   
        /**
         * cadastrar professor
         * 
         */
        function cadastrar(Professor $professor){
                     
            try {
                
            $sql = "INSERT INTO esc_professor (nome,
                                               num_policia,
                                               profissao,
                                               posto,
                                               obs,
                                               cpf)
                                               VALUES (:nome,
                                                       :num_policia,
                                                       :profissao,
                                                       :posto,
                                                       :obs,
                                                       :cpf)";
            
            $ps_sql = Conexao::getInstance()->prepare($sql);                                           
            
            $ps_sql->bindValue(":nome", $professor->getNome);     
            $ps_sql->bindValue(":num_policia", $professor->getNumPolicia);     
            $ps_sql->bindValue(":profissao", $professor->getProfissao);     
            $ps_sql->bindValue(":posto", $professor->getPosto);     
            $ps_sql->bindValue(":obs", $professor->obs);     
            $ps_sql->bindValue(":cpf", $professor->getCpf);     
                
            return $ps_sql->execute(); 
               
            } catch (Exception $e){
                print "Não foi possivel executar esta operação !";
                GeraLog::getInstance()->inserirLog("Erro: Código: " .
                $e->getCode() . " Mensagem: " . $e->getMessage());

            }                  

            //$result = mysql_query($sql) or die (mysql_error());
            
            return true;       
                                
            
        }
        
        

    /**
     * Alterar cadastro de professor
     * 
     */
    function alterarProfessor($_nome,
                              $_num_policia,
                              $_profissao,
                              $_posto,
                              $_obs,
                              $_id_professor,
                              $_cpf) {
        
        $sql = "UPDATE esc_professor  SET nome = '".$_nome."',
                                           num_policia = '".$_num_policia."',
                                           profissao = '".$_profissao."',
                                           posto = '".$_posto."',
                                           obs = '".$_obs."',
                                           cpf = '".$_cpf."'
                                           WHERE id_professor = ".$_id_professor;
                                           
        //print $sql;                                   
                                           
        $result = mysql_query($sql) or die (mysql_error());
        
        return true;
   
    }
                              
    /**
    *  pesquisa de professor pelo nome e retorna o id para alteração do cadastro de professores
    * 
    */
    function pesquisaProfessorId($_nome){
        
        $dados = array();
        
        $sql = "SELECT id_professor, nome
                FROM esc_professor
                WHERE nome LIKE '%".$_nome."%'";
                
        $result = mysql_query($sql) or die (mysql_error());
        
        while($linha = mysql_fetch_assoc($result)){
            
            $dados[] = $linha;
            
        }
        
        return $dados;
        
        
    } 

    /**
     * 
     *  Pesquisa o professor para alteração de dados pelo id
     * 
     */
     function pesquisaProfessorAlterar($_id){
         
         $dados = array();
         
         $sql = "SELECT id_professor,
                        nome,
                        num_policia,
                        profissao,
                        posto,
                        obs,
                        cpf
                        FROM esc_professor
                        WHERE id_professor = ".$_id;
                
        $result = mysql_query($sql) or die (mysql_error());
        
        $linha = mysql_fetch_assoc($result);
        
        return $linha;
            
     }

         



}?>