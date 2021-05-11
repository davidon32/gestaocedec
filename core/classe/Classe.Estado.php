<?php
    
    /**
     * 
     */
    class Estado {
        
        static function getArrayNomeUf() {
            
            $dados = array();
            
            $sql = "SELECT nome, uf
                        FROM cedec_estado
                        ORDER BY nome";
                        
            $result = mysql_query($sql) or die (mysql_error().'Código : 02');
            
            while ($linha = mysql_fetch_assoc($result)) {
                
                $dados[] = utf8_encode($linha['nome']." /". $linha['uf']);
                
            }
            
            return $dados;
            
        }
    }
    
    
    
?>