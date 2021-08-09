<?php

/**
 * Diario do Plantão do CCE
 */
class Diario  {
	
    /**
     * Cadastro de Itens no diário do plantão
     * 
     */
	static function CadastroAbreDiario($_dt_diario,
	                  $_periodo,
	                  $_id_funcionario) {
	    
	    $con = Conexao::getInstance();
	    
        $sql = "INSERT INTO cce_diario (dt_diario,
                                        periodo,
                                        id_funcionario) VALUES ('".$_dt_diario."',
                                                              '".$_periodo."',
                                                              ".$_id_funcionario.")";
        
        $result = $con->query($sql);
        
       return true;
		
	}
                      
    function Alterar($_id_historico){
        
        $sql = "";
        
    }
    
    function pesquisaHistorico($_id){
        
        $con = Conexao::getInstance();
        
        $linha = array();
        
        $sql = "SELECT dt_diario, 
                       historico,
                       id_funcionario,
                       hora,
                       turno,
                       id_diario
                       FROM cce_historicod
                       WHERE id_historico = ".$_id;
        
        $result = $con->query($sql);
        $result->execute();
        
        while($dados = $result->fetch(PDO::FETCH_ASSOC)){
        
            $linha = $dados; 
        
        }
        return $linha;
        
    }
    
    
    
    function lancaHistorico($_dt_diario, $_historico, $_id_funcionario, $_hora, $_num, $_num_sub, $_dt_altera, $_turno, $_id_diario){

        try{
        
            $con = Conexao::getInstance();
            
            $sql = "INSERT INTO cce_historicod (dt_diario,
                                                historico,
                                                id_funcionario,
                                                hora,
                                                num,
                                                num_sub,
                                                dt_altera,
                                                turno,
                                                id_diario)
                                                VALUES (:dt_diario,
                                                        :historico,
                                                        :id_funcionario,
                                                        :hora,
                                                        :num,
                                                        :num_sub,
                                                        :dt_altera,
                                                        :turno,
                                                        :id_diario)";
            $result = $con->prepare($sql);
            
            $result->bindParam(":dt_diario",      $_dt_diario);
            $result->bindParam(":historico",      $_historico);
            $result->bindParam(":id_funcionario", $_id_funcionario);
            $result->bindParam(":hora",           $_hora);
            $result->bindParam(":num",            $_num);
            $result->bindParam(":num_sub",        $_num_sub);
            $result->bindParam(":dt_altera",      $_dt_altera);
            $result->bindParam(":turno",          $_turno);
            $result->bindParam(":id_diario",      $_id_diario);
                    
            $result->execute();
        
            return "true";
            
        }catch(Exception $e){
            print $e;
        }
    
    }
    
    /**
     *  Atualizar historico
     * 
     */
    function atualizarHistorico($_dt_diario, $_historico, $_hora, $_id_historico){
        
        $con = Conexao::getInstance();
        
        $sql = "UPDATE cce_historicod set dt_diario = '".$_dt_diario."',
                                          historico = \"".str_replace("\"", "'", $_historico)."\",
                                          hora = '".$_hora."'
                                          WHERE id_historico = ".$_id_historico;
                

        $result = $con->query($sql);
    
        return true;
    
    }
    
    
    
    /**
     * Busca o livro do diario aberto no dia atual
     * 
     * 
     */
        public static function getDiario(){
            
            $con = Conexao::getInstance();
            
            $dados = array();
            
            $sql = "SELECT id_diario,
                            dt_diario,
                            periodo,
                            id_funcionario,
                            periodo
                            FROM cce_diario
                            ORDER BY dt_diario
                            DESC
                            LIMIT 10";
            
            $result = $con->query($sql);
            $result->execute();
            
                           
            //print $sql;
            
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }
            return $dados;
   
        }
        
        /**
         * Busca o diario do dia para novo cadastro ou atualizacao do historico
         * 
         * 
         */
         function BuscaDiario($_dt_diario){
             
             $con = Conexao::getInstance();
             
             $dados = array();
             
             $sql = "SELECT dt_diario,
                            periodo
                            FROM cce_diario
                            WHERE dt_diario = '".$_dt_diario."'";
             
            // print $sql;
            
             $result = $con->query($sql);
             $result->execute();
             
             while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                 
                 $dados[] = $linha;
                 
             }
                      
             return $dados;
                 
         }
         
         /**
          * Busca qual plantão
          * @author Demetrio Silva Passos
          */
         function buscaPeriodo($_diario){
             
             
             
         }
         
         
         /**
          * Consulta de Historico de Diário
          * 
          * /
          */
         function ConsultaDiario($_dt_diario){
             
             $dados = array();
             
             $sql = "SELECT historico
                            FROM cce_historicod
                            WHERE dt_diario = '".$_dt_diario."'";
                            
             $result = mysql_query($sql) or die (nysaql_error());
             
             while ($linha = mysql_fetch_array($result)){
                 
                 $dados[] = $linha;
             
             } 
             
             return $dados;
             
         }
         
         /**
          * Lista o historico do diário
          * 
          */
         function ListaHistorico($id_diario){
             
             $con = Conexao::getInstance();
                
            $dados = array();    
             
            $sql = "SELECT h.historico as historico,
                    h.id_funcionario as id_funcionario,
                    h.hora as hora,
                    h.num as num,
                    h.num_sub as num_sub,
                    h.dt_altera as dt_altera,
                    d.periodo as periodo,
                    h.id_historico as id_historico,
                    h.id_diario as id_diario,
                    h.dt_diario as dt_diario
                    FROM cce_historicod h
                    INNER JOIN cce_diario d
                    ON h.id_diario = d.id_diario
                    WHERE h.id_diario = ".$id_diario."
                    ORDER BY h.num, h.num_sub";
            
            $result = $con->query($sql);
            
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                
                $dados[] = $linha;
                
            }
            
            return $dados;
            
             
         } 
         
         
         /**
          * 
          * 
          * 
          */
            function getNumLancDiario($_dt_diario, $_id_diario){
                
                $con = Conexao::getInstance();
                
                $sql = "SELECT MAX(num) as num
                        FROM cce_historicod
                        WHERE dt_diario = '".$_dt_diario."'
                        AND id_diario =".$_id_diario;
                
                $result = $con->query($sql);
                $result->execute();
                
                $linha = $result->fetch(PDO::FETCH_ASSOC); 
                
                return $linha['num'];
            }
            
            
            /**
             * @return o numero de sub-registros 
             * @param numero do registro no diario
             * */
            function getSubNum($_num, $_id_diario) {
                
                $con = Conexao::getInstance();
                
                $linha = array();
                    
                $sql = "SELECT count(num) as num
                            FROM cce_historicod
                                WHERE num = '".$_num."'
                                AND id_diario = '".$_id_diario."'";
                
                $result = $con->query($sql);
                $result->execute();
                
                while ($dados = $result->fetch(PDO::FETCH_ASSOC)){
                
                        $linha = $dados;
                }
                
                return $linha['num'];
                  
            }
            
            function relatorioDiario($_dtInicial, $_dtFinal, $palavra){
                
                    $con = Conexao::getInstance();
                
                    $dados = array();
                    
                    //var_dump($_dtInicial);
                    //var_dump($palavra);
                    
                    $_filtro = "";
                    
                    /* datas em branco */
                    if(($_dtInicial == '') && ($_dtFinal == '') && ($palavra == '')) {
                        
                        $_filtro = "";
                        
                    /* data inicial preenchida e final em branco e palavra chave em branco */
                    } elseif (($_dtInicial != "") && ($_dtFinal == "") && ($palavra == "")) {
                        
                        $_filtro = "WHERE dt_diario >= '".$_dtInicial."'";
                    
                    
                    /* data final preenchida e data inicial em branco e palavra chave em branco */
                    } elseif (($_dtInicial == "") && ($_dtFinal != "") && ($palavra == "")) {
                        
                        $_filtro = "WHERE dt_diario <= '".$_dtInicial."'";
                    
                    }else if(($_dtInicial != "") && ($_dtFinal == "") && ($palavra != "")) {
                    
                        $_filtro = "WHERE dt_diario >= '".$_dtInicial."' AND historico LIKE '%".$palavra."%'";    
                    
                    }else {
                        
                    $_filtro = " WHERE dt_diario BETWEEN '".$_dtInicial."' AND '".$_dtFinal."'";     
                        
                    }
  
                    $sql = "SELECT num, num_sub,
                                   historico,
                                   dt_diario,
                                   hora,
                                   id_funcionario,
                                   dt_altera 
                                    FROM cce_historicod ".$_filtro." ORDER BY dt_diario, num";
                                    
                    $result = $con->query($sql);
                    
                    while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                            
                        $dados[] = $linha; 
                        
                    }
                    
                    return $dados;
                                        
                
            }
     
     /**
      *  realiza a busca do id dp diario
      * @param data diario
      * @param perido diário
      */
     function buscaIdDiario($_dt_diario, $_periodo) {
         
         $con = Conexao::getInstance();
         
         $dados = array();
             
         $sql = "SELECT id_diario
                FROM cce_diario
                WHERE dt_diario = '".$_dt_diario."'
                AND periodo = '".$_periodo."'";
         
         $result = $con->query($sql);
         $result->execute();
         
         while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
             
             $dados = $linha;
         }
                
         //print $sql;

         return $dados;    
         
     } 
     
     /**
      * retorna os dados do diário para inclusao de historico
      * 
      */
     
     function buscaDiarioId($_id_diario) {
         
         $con = Conexao::getInstance();
         
         $sql="select d.dt_diario as dt_diario,
                d.id_funcionario as id_funcionario,
                h.turno as turno
                from cce_diario d
                left join cce_historicod h
                on d.id_diario = h.id_diario 
                where d.id_diario = ".$_id_diario;

         $result = $con->query($sql);
         
         
         $linha = $result->fetch(PDO::FETCH_ASSOC);
         
         
         return $linha;
         
         
     } 
     
     /**
      *  busca o historico para alteracao
      * 
      */    
     function buscaHistorico($_id_historico) {
         
         $con = Conexao::getInstance();
         
         $sql = "SELECT historico,
                dt_diario,
                hora
                FROM cce_historicod
                WHERE id_historico=".$_id_historico;
         
         $result = $con->query($sql);
         
         $result->execute();
         
         $linha = $result->fetch(PDO::FETCH_ASSOC);
         
         return $linha;
     }
     
     /**
      * retorna se o plantao já foi aberto
      * @param periodo
      * @param data diario
      */
     function buscaPlantaoAberto($_periodo, $_dt_diario){
         
         $con = Conexao::getInstance();
          
        $sql ="SELECT id_diario from cce_diario
               WHERE periodo = '".$_periodo."'
               AND dt_diario = '".$_dt_diario."'";
        
        $result = $con->query($sql);
        $result->execute();
        
        $linha = $result->fetch(PDO::FETCH_ASSOC);
        
        //print $sql;
        
        return $linha;
         
     }
}?>