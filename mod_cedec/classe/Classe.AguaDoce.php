<?php include_once PATH.'/core/classe/Classe.Anexo.php';
    class AguaDoce extends Anexo
    {

        /**
         *  Cadastro Agua Doce
         */
        public function cadastro($dados){

            $con = Conexao::getInstance();
			
            $sql = "INSERT INTO cedec_agua_doce (autor,
                                                 orgao,
                                                 imagem1,
                                                 texto, 
                                                 categoria,
                                                 status1,
                                                 data_hora)
                                                 VALUES (:autor, 
                                                        :orgao, 
                                                        :imagem1, 
                                                        :texto, 
                                                        :categoria, 
                                                        :status1, 
                                                        :data_hora)";
            $result = $con->prepare($sql);

            $result->bindParam(":autor", $dados['txtAutor'], PDO::PARAM_STR);
            $result->bindParam(":orgao", $dados['txtOrgao'], PDO::PARAM_STR);
            $result->bindParam(":imagem1", $dados['txtImagem']);
            $result->bindParam(":texto", $dados['txtTexto'], PDO::PARAM_STR);
            $result->bindParam(":categoria", $dados['txtCategoria'], PDO::PARAM_STR);
            $result->bindParam(":status1", $dados['status'], PDO::PARAM_INT);
            $result->bindParam(":data_hora", $dados['txtDtHora'], PDO::PARAM_STR);
            
            $result->execute ();

            return true;

        }

        /**
         * Validar DFAgora
         */
        public function editar($dados){

           $con = Conexao::getInstance();
			
            $sql = "UPDATE cedec_agua_doce SET autor      = :autor,
                                                orgao     = :orgao,
                                                texto     = :texto, 
                                                categoria = :categoria,
                                                status1   = :status1,
                                                data_hora = :data_hora,
                                                imagem1   = :imagem1
                                            WHERE id      = :id";

            $result = $con->prepare($sql);

            $result->bindParam(":autor", $dados['autor']);
            $result->bindParam(":orgao", $dados['orgao']);
            $result->bindParam(":texto", $dados['texto']);
            $result->bindParam(":categoria", $dados['categoria']);
            $result->bindParam(":status1", $dados['status']);
            $result->bindParam(":data_hora", $dados['data_hora']);
            $result->bindParam(":imagem1", $dados['nomeImagem']);
            $result->bindParam(":id", $dados['id']);
            
            $result->execute ();

            return true;



        }

        /**
         * Deletar DF. Agora
         * 
         */
        public function deletar($id) {

            try{
        
                $con = Conexao::getInstance();
                    
                $sql = "delete from cedec_agua_doce where id = :id";
                    
                $result = $con->prepare($sql);
                $result->bindParam("id", $id['id']);
                $result->execute();
        
                return true;
        
            }catch (Exception $e){
                    
                $e." Erro ao deletar arquivo";
            }
        }

         /**
         * Deletar DF. Agora
         * 
         */
        public function deletarImagem($id) {

            try{
        
                $con = Conexao::getInstance();
                    
                $sql = "update cedec_agua_doce set imagem1 = null where id = :id";
                    
                $result = $con->prepare($sql);
                $result->bindParam("id", $id['id']);
                $result->execute();
                           
                chdir(PATH.'/anexo/def_civil_agora');
		        $dirAnexo = getcwd();
		
                    if(file_exists($dirAnexo.'/'.$id['imagem1'])){
                        unlink($dirAnexo.'/'.$id['imagem1']);
                    }
        
                return true;
        
            }catch (Exception $e){
                    
                $e." Erro ao deletar arquivo";
            }
        }


        /**
         * Validar DFAgora
         */
        public function validar($id){
            try{
        
                $con = Conexao::getInstance();
                    
                $sql = "update cedec_agua_doce 
                            set status1 = 1 
                            where id = :id";
                    
                $result = $con->prepare($sql);
                $result->bindParam("id", $id['id']);
                $result->execute();
        
                return true;
        
            }catch (Exception $e){
                    
                $e." Erro ao deletar arquivo";
            }

        }

        /**
         * Lista site DFAgora para site
         */
        public function lista($param = false, $texto = false, $status = null){

            $dados = array();
            $filtro = "";
            $filtroStatus = "";

            if(!is_null($status)){
                $filtroStatus = $status;

            }else if (is_null($status)){
                $filtroStatus = "in('0', '1', '2')";
            }

            if($param == "autor"){
                $filtro = "and autor like '%".$texto."%'";
            }elseif($param == "data"){
                $filtro = "and data_hora = '".$texto."'";
            }elseif($param == "texto"){
                $filtro = "and texto like '%".$texto."%'";
            }

            $con = Conexao::getInstance();

            $sql = "select id, autor, orgao, imagem1, texto, categoria, status1, data_hora 
                    from cedec_agua_doce
                    where status1 ".$filtroStatus." ".$filtro." order by data_hora limit 50";
                    
                    
                    $result = $con->query($sql);

                    
                    while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                        
                        $dados[] = $linha;
                    }
                    return $dados;
                }

                /**
         * EDITAR
         */
        public function listaId($id){

            $dados = array();

            $con = Conexao::getInstance();
            $sql = "select id, autor, orgao, imagem1, texto, categoria, status1, data_hora 
                    from cedec_agua_doce
                    where id = :id";

                   
                    $result = $con->prepare($sql);
                    $result->bindParam(":id", $id);
                    $result->execute();

                    while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                        
                        $dados[] = $linha;
                    }
                    return $dados;
                }

               /**
         * Lista Adm (sit. dos ultimos lancamentos)
         */
        public function listaAdm(){

            $dados = array();

            $con = Conexao::getInstance();
            $sql = "select id, autor, orgao, imagem1, texto, categoria, status1, data_hora 
                    from cedec_agua_doce
                    order by status1, data_hora
                    limit 50";

                   
                    $result = $con->query($sql);
                    

                    while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                        
                        $dados[] = $linha;
                    }
                    return $dados;
                }

        /**
        * Lista site DFAgora interno
        */
        public function listaSite(){

            $dados = array();
            $con = Conexao::getInstance();

                $sql = "select id, autor, orgao, imagem1, texto, categoria, status1, data_hora 
                        from cedec_agua_doce
                        where status1 = 1
                        ORDER BY data_hora DESC
                        LIMIT 50";
           

            $result = $con->query($sql);
                    
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                         
                $dados[] = $linha;
            }
            return $dados;

            
        }

    /**
     * 
     * 
     */
    public function status($status){

        switch ($status) {
            case '0':
                return "Pendente";
                break;
            case '1':
                return "Ativo";
                break;
            
            default:

                break;
        }

    }


        
}
?>