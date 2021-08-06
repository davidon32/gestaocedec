<?php 


/**
 * 
 */
class UnidadeController {

    /* Pega Unidades produtos 
  */
    public static function getUnidade(){

        $dados = array();
        
        $con = Conexao::getInstance();

        $sql = "Select id_unidade, nome, descricao from aju_unidade order by nome";

        $result = $con->query($sql);

        while($linha = $result->fetch(PDO::FETCH_ASSOC)){
            $dados[] = $linha;
        }

        return $dados;
    }

    



}

?>