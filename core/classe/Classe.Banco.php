<?php

class Banco {
    
    public static function getCampos($tabela){

        $con = Conexao::getInstance();

        $sql = "SHOW COLUMNS FROM ".$tabela;

        $result = $con->query($sql);

        $dados = array();
        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
        
            $dados[] = $linha['Field'];
        
        }

        return $dados;



        

    }

}



?>