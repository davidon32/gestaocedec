<?php

class Desastre  {
    
    private $id;
    
    private $desastre;  
    
    /**
     * @return nome do desastre
     * @param identificador do desastre
     * 
     */
    public function idToNome($id){
        
        $dados = array();
        
        try{
        
	        $con = conexao::getInstance();
	        
	        
	        $sql = "SELECT descricao
	                FROM dec_cobrade
	                WHERE id_cobrade = ".$id."";
	                
	        $result = $con->query($sql);
	        
	        while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					
				$dados = $linha; 
			}
        		
            return $dados['descricao'];
            
        }catch (Exception $e){
        	
        	
        }
             
    } 
    
    
    
}



?>