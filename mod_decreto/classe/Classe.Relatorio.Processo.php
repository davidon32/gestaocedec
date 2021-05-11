<?php

class RelatorioProcesso {
    
    
    /**
     * 
     *  resumo de status do processo
     * 
     */
    function status(){
        
        $dados = array();
        
        $sql = "SELECT status, count(status) as status
                FROM dec_processo
                GROUP BY status";
                
        $result = mysql_query($sql) or die (mysql_error());
        
        
        while ($linha = mysql_fetch_assoc($result)) {
            
            $dados[] = $linha; 
            
        }
        
        return $dados;
    
    
    }
    
    
    /**
     * 
     * Resumo de processo que estão reconhecidos ou não 
     * 
     */
    
    function reconhecido(){
        
        $dados = array();
        
        $sql = "SELECT stat_reconhecido, count(stat_reconhecido) as stat_reconhecido
                FROM dec_processo
                GROUP BY stat_reconhecido";
                
        $result = mysql_query($sql) or die (mysql_error());
        
        
        while ($linha = mysql_fetch_assoc($result)) {
            
            $dados[] = $linha; 
            
        }
        
        return $dados;
    
    
    }


}?>