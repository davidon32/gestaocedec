<?php 

    /**
     * 
     */
    class Territorio {
        
        public function dadosCombo() {
            
            $con = Conexao::getInstance();
            
            $consulta = $con->query("SELECT * FROM com_territ_desenv");
          
            try {
                
                $linha = $consulta->fetchAll(PDO::FETCH_NUM);
                
                return $linha;
            
            }catch(PDOException $e) {
                
                print $e->getMessage();
                print "<br><a href='javascript:history.back();'>Voltar</a>";
                
            }
            
        }
         
         #@ get sigla/nome regiao
    function pegaNomeTerritorio($_id_territorio){
        
        //var_dump($_id_territorio);
            
        $con = Conexao::getInstance();    

        try {
        
        $consulta = $con->prepare("SELECT nome FROM com_territ_desenv WHERE id_territ = :id_territorio");
        
        $consulta->bindParam(':id_territorio', $_id_territorio, PDO::PARAM_STR);
        $consulta->execute();
        
        return $linha = $consulta->fetch(PDO::FETCH_ASSOC);
        
        }catch (PDOException $e) {
            
            print $e->getMessage();
            
        }
       
        
    }
         
           
}?>