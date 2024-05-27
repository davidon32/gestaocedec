<?php

//require_once PATH . '/core/Model/UsuarioModel.php';

class Pae {
          
    public static function listagem() {
        
        $con = Conexao::getInstance();
        
        $sql = "Select id, nome from pae_empdors";
        
        $result = $con->query($sql);
                
        return $result->fetchAll(PDO::FETCH_ASSOC);
        
        
    }
    


}
