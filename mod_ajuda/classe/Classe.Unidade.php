<?php
    
    
    /**
     * 
     */
    class Unidade {
        
        #@ retorna o nome no Material com Base no Identificador
        static function PegaNomeId($_id_material) {

            $con = Conexao::getInstance();

            $sql = "select nome from aju_unidade where id_unidade = ".$_id_material;

            try {

                $result = $con->query($sql);
                $result->execute();

                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados = $linha;
                }
                return $dados['nome']; 
                
            }catch (Exception $e){
                print FuncaoBase::getError($e->getMessage());
            }
        }

        /**
        *  @return nome e id material 
        */
        static function getIdNome() {

            $con = Conexao::getInstance();

            $sql = "select id_unidade, nome, descricao, uni_medida, peso, valor 
            from aju_unidade ORDER BY NOME";

            $dados = array();

            try {

                $result = $con->query($sql);
                $result->execute();

                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados[] = $linha;
                }
                return $dados; 
                
            }catch (Exception $e){
                print FuncaoBase::getError($e->getMessage());
            }
        }


        /**
         * 
         * Alterar status item
         */
        static function AlteraStatusItem($id_liberacao, $status) {

            $con = Conexao::getInstance();
            
            try {

                $sql = "UPDATE aju_item set situacao = '".$status."'
                WHERE id_liberacao = '".$id_liberacao."'";

                $result = $con->query($sql);

                return true; 
                
            }catch (Exception $e){
                print FuncaoBase::getError($e->getMessage());
            }
        }
        
        
        /* lista unidade */
        public static function ListUnidade() {
            $con = Conexao::getInstance();
            
            $sql = "select id_unidade, nome, descricao "
                    . "from aju_unidade "
                    . "order by nome";
            
            $dados = array();

            try {

                $result = $con->query($sql);
                $result->execute();

                while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                    $dados[] = $linha;
                }
                return $dados; 
                
            }catch (Exception $e){
                print FuncaoBase::getError($e->getMessage());
            }
        }

        
        


        
}?>