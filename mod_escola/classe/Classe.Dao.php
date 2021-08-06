<?php
    
    
    class Dao {
        
        private function Cadastrar($_campos, $_tabela){
            
            $_dados = implode(",", $_campos);
            
            $sql = "INSERT INTO ".$_tabela." ".$_dados." VALUES (".$_dados.")";
                
            print $sql;
            
            //$result = mysql_query($sql) or die(mysql_error());
            
            //return true;
            
            
        } 
        
        public function Alterar(){
            
            
            
        }
        
        
        
        
    }
?>