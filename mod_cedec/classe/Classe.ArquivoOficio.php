<?php

class ArquivoOficio {
        
    /**
     * Cadastra o Oficio no banco de Dados 
     * @author Demetrio S. Passo <demetrio.passos@gmail.com>
     * @param $numOficio - numero do Ofício
     * @param $ano - ano do Ofício
     * @param $assunto
     * @param $destinatario
     * @param $idResp
     * @param $arquivo
     * @return boolean
     */
    function arquivarOficio($numOficio,
                            $ano,
                            $assunto,
                            $destinatario,
                            $idResp,
                            $arquivo,
                            $dtOficio,
                            $observacao,
                            $idUser){
                     
        $sql = "INSERT INTO cedec_dadm_oficio (numero,
                                               ano,
                                               assunto,
                                               destinatario,
                                               id_resp,
                                               arquivo,
                                               dt_oficio,
                                               observacao,
                                               id_user)
                                               VALUE (".$numOficio.",
                                                      ".$ano.",
                                                     '".$assunto."',
                                                     '".$destinatario."',
                                                      ".$idResp.",
                                                     '".$arquivo."',
                                                     '".$dtOficio."',
                                                     '".$observacao."',
                                                     ".$idUser.")";
         
         //print $sql;                                    
         $result = mysql_query($sql) or die(mysql_error());
         
                   
         return true;
     }
                            
    /**
     * Faz busca de oficio para consulta, pelo numero do oficio e ano 
     * @author Demetrio S. Passos <demetrio.passos@gmail.com>
     * @param $numOficio - numero do Ofício
     * @param $ano - ano do Ofício
     * @return array $dados
     */
    function pesquisarOficio($numOficio = false, $ano = false){
            
        $dados = array();
        $filtro = "";
        
        if(($numOficio == "") && ($ano == "")){
            $filtro = "";
        }else if(($numOficio != "") && ($ano == "")) {
            $filtro = " WHERE numero = ".$numOficio." ORDER BY numero";
            
        }else if(($numOficio == "") && ($ano != "")) {
            $filtro = " WHERE ano = ".$ano." ORDER BY numero";
            
        }
        
                     
        $sql = "SELECT numero,
                       ano,
                       dt_oficio,
                       assunto, 
                       destinatario, 
                       id_resp, 
                       arquivo,
                       observacao,
                       id_user
                       FROM cedec_dadm_oficio ".$filtro;
         
         //print $sql;
         
         $result = mysql_query($sql) or die(mysql_error());
         
         while($linha = mysql_fetch_array($result)){
             
            $dados[] = $linha;
             
         }
         
                     
         return $dados;
     }
                            
    /**
     * Faz o upload do oficio para o sistema
     * @author Demetrio S. Passos <demetrio.passos@gmail.com>
     * @param $numOficio - numero do Ofício
     * @param $ano - ano do Ofício
     * 
     */
    function uploadArquivo($arquivo, $numOficio){


       if($arquivo['fileArquivo']['type'] == "application/pdf") {
                            
           $tmp_arquivo = $arquivo['fileArquivo']['tmp_name'];
                                    
           $pasta = "oficio/";
                                    
           copy($tmp_arquivo, $pasta."Oficio_nr.-".$numOficio.".".date('d-m-Y.H.i.s').".pdf") or die (print "error");
       }
       
       return true;     
        
    }
                              
                            

}?>