<?php

class Model {

    static $contextoPagina = array(
        'pesquisaPmda' => 'Pesquisa de PMDA',
        'index' => 'Inicio',
        'usuario' => 'Manutenção de Usuários',
        'cadadm' => 'Lançamento de novo Registro',
        'editar' => 'Edição de Registro',
        'busca' => 'Pesquisa de Registro',
        'lista' => 'Listagem de registro',
        'menu' => 'Menu Principal',
    );
    
   
    public static function getContexto($controller, $action){

        switch ($action) {
            case 'value':
                # code...
                break;
            
            default:
                # code...
                break;
        }
        return $action;
    } 
    
    
    #informações da tabela
    public function Tabela($tabela) {
        $dados = array();
        $con = Conexao::getInstance();
        
        $sql = "SELECT TABLE_NAME,"
                . "TABLE_COMMENT,"
                . " TABLE_ROWS "
                . "FROM information_schema.tables"
                . " where table_name = '".$tabela."'";
        
        $result = $con->query($sql);
;             
      while ($linha = $result->fetch(PDO::FETCH_OBJ)){
          $dados['tabela'] = $linha;
      }
      
      $dados['dados'] = $this->Campos($tabela);
      //var_dump($dados);
      
      return $dados;
          
    }
    
    
    # informacoes dos campos da tabela
    public function Campos($tabela) {
        
      $con = Conexao::getInstance();  
      
      $sql = "SHOW COLUMNS FROM ".$tabela;
      $result = $con->query($sql);
      
      while ($linha = $result->fetch(PDO::FETCH_OBJ)){

          $dados['full'][] = $linha; // todos dados do campo
         if ($linha->Key == "PRI") {
            $dados['id'] = $linha->Field; // somente id
          }else {
              $dados['campos'][] = $linha->Field; // somente nome campos sem id
          }
      }
      return $dados;
        
    }
    
    /* TIPO CAMPO PARA FORMULARIO */
    public function tipoCampo($tipo){
        
        $result = "";
        if(strpos($tipo, "int(") == 0){
            $result = "text";
        }elseif (strpos($tipo, "varchar") == 0){
            $result = "text";
        }elseif(strpos($tipo, "date") == 0){
            $result = "date";
        }elseif(strpos($tipo, "tinyint") == 0){
            $result = "checkbox";
        }
        
        
        return $result;
        
    }
    
    /* TIPO CAMPOS PARA FILTRO PESQUISA SQL*/
    public function tipoCampoFiltro($tipo){

        $result = "";
        if(strpos($tipo, "int(") === 0){
            $result = "=";
        }elseif (strpos($tipo, "varchar") === 0){
            $result = "like";
        }elseif(strpos($tipo, "date") === 0){
            $result = "date";
        }else{
            $result = "=";
        }
         
        return $result;
    }

    
    /* sql filtro
        array [0] sinal (=, date, varchar)
     *          [1] nome campo campo 
     **/
    public function montaFiltro(array $campos){
        
        $result = "";
        
        $where = (count($campos) == 1) ? " WHERE " : "";
        $and = (count($campos) >= 2) ? " AND " : "";
        
        //var_dump($campos);
        $result .= $where;
        foreach ($campos as $key => $value) {
            
            if($value['sinal'] == "="){
                $result .= $value['campo']." = ".$value['valor'].$and;
            }elseif($value['sinal'] == "data") {
                $result .= $value['campo']." >= ".$value['valor']. " AND <= ".$value['valor'].$and;
            }elseif($value['sinal'] == 'varchar'){
                $result .= $value['campo'] ." like '%' $".$value['valor']."'%' ".$and;
                
            }
        }
        
        //var_dump($result);
        
        return $result;
    }
    
}