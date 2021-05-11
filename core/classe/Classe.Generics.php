<?php

    include_once 'Classe.Funcao.Base.php';

class SqlGenerics extends FuncaoBase {
    
    private $parametro;
    
    
    
    
    
    
     /**
     * Classe para manipulacao generica de dados
     * 
     * 
     */
     public static function Inserir($tabela, array $parametro){
         
         $con = Conexao::getInstance();
            
         $campo = array();
         $valor = array();
         
         foreach ($parametro as $key=>$value) {
             $campo[] = $key;
             $valor[] = $value;
             
         } 
          
         $a = "".implode(",",$campo)."";
         $b = "'".implode("','",$valor)."'";

         $sql = "INSERT INTO $tabela ($a) VALUES ($b)";
                 
         $result = $con->query($sql);
         
         return true;
     }
     
     /**
      * Select tabela
      * @param $_sql
      * 
      */
      public static function Select($sql){
          
          //print $sql;
          $dados = array();
          
          $result = mysql_query($sql) or die (mysql_error().'Código: 07');
          
          while ($linha = mysql_fetch_array($result)){
          
            $dados[] = $linha;
              
          }
          
          return $dados[0];
          
                
      }
     
     
     
}?>