<?php
//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_h_pedido_itens										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/06/2021															*
 * ********************************************************************************** */

class H_pedido_itensajuda_hModel extends Model {

    
    private $table = "aju_h_pedido_itens";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id = null;
private $codigo = null;
private $descricao_item = null;
private $qtd = null;
private $qtd_familia_atendida = null;


    
    
 public function getQtd_familia_atendida(){
        return $this->qtd_familia_atendida;
    }

            
    public function setQtd_familia_atendida($qtd_familia_atendida){
            $this->qtd_familia_atendida = $qtd_familia_atendida;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_h_pedido_itens');

         self::$mod = "aju";
         
         self::$con = Conexao::getInstance();
     }
   
    #################  LISTA  ##################
   # lista {$model}
  
    public static function lista($id = null) {
         
         $dados = array();
         
        $sql = "SELECT";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($id)) {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME." ORDER By ".self::$model['dados']['id'];

            $result =  self::$con->query($sql);
        } else {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME."  
                            WHERE ".self::$model['campos'][0]." = :id
                            ORDER BY nome";
            $result = self::$con->prepare($sql);
            $result->bindValue(":id", $id);
            $result->execute();
        }

        try {
         
            while($linha = $result->fetch(PDO::FETCH_ASSOC)){
         
                $dados[] = $linha;
            }

            return $dados;

        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }
         
         
    
    
    #################  LISTA NOME ##################
    # lista nome {$model}
  
    public static function listaNome($nome = null) {
         
         try {
         
         $dados = array();
 
        $sql = "SELECT";
        $sql .= " ".self::$model['dados']['id'].", ";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($nome)) {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME." ORDER By ".self::$model['dados']['id'];

            $result =  self::$con->query($sql);
        } else {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME."  
                            WHERE ".self::$model['dados']['campos'][0]." LIKE :nome
                            ORDER BY nome";
            $result = self::$con->prepare($sql);
            $result->bindValue(":nome", '%'.$nome.'%');
            $result->execute();
        }
         
         while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
                $dados[] = $linha;
            }

        

            return $dados;

        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }

    #################  GRAVAR  ##################
    # @ grava {$model} em banco
    /**
     * 
     * @param array $dados
     * @param type $duplo gera os itens do pedido original e os itens q será efetivamente liberados.
     * @return boolean
     * 
     */

    public static function gravar(array $dados, $duplo=false) {

        $con = Conexao::getInstance();

        $sql = "INSERT INTO aju_h_pedido_itens (codigo,
                                                descricao_item,
                                                qtd,
                                                qtd_familia_atendida,
                                                id_pedido,
                                                tp_item
                                                ) VALUES (:codigo,
                                                :descricao_item,
                                                :qtd,
                                                :qtd_familia_atendida,
                                                :id_pedido,
                                                :tp_item
                                                )";

        try {
            
            /* tipo P - pedido lancado pelo municipio
               tipo L - a ser liberado / alterado pelo pelo analista
             *              */
            if($duplo) {
                $result = $con->prepare($sql);
                $result->bindValue(":codigo", $dados['codigo']);
                $result->bindValue(":descricao_item", $dados['descricao_item']);
                $result->bindValue(":qtd", $dados['qtd']);
                $result->bindValue(":qtd_familia_atendida", $dados['qtd_familia_atendida']);
                $result->bindValue(":id_pedido", $dados['id_pedido']);
                $result->bindValue(":tp_item", $dados['tipo']);
                $result->execute();
                
                $result->bindValue(":tp_item", "L");
                $result->execute();
                
            }else {
                $result = $con->prepare($sql);
                $result->bindValue(":codigo", $dados['codigo']);
                $result->bindValue(":descricao_item", $dados['descricao_item']);
                $result->bindValue(":qtd", $dados['qtd']);
                $result->bindValue(":qtd_familia_atendida", $dados['qtd_familia_atendida']);
                $result->bindValue(":id_pedido", $dados['id_pedido']);
                $result->bindValue(":tp_item", $dados['tipo']);
                $result->execute();
            }

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados h_pedido_itens  ###################

    public static function edit(array $dados) {
        
        $con = Conexao::getInstance();

        $sql = "UPDATE aju_h_pedido_itens SET 
                codigo= :codigo,
                descricao_item= :descricao_item,
                qtd= :qtd,
                qtd_familia_atendida= :qtd_familia_atendida
                WHERE id = :id";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id", $dados['id']);
            $result->bindValue(":codigo", $dados['codigo']);
            $result->bindValue(":descricao_item", $dados['descricao_item']);
            $result->bindValue(":qtd", $dados['qtd']);
            $result->bindValue(":qtd_familia_atendida", $dados['qtd_familia_atendida']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de H_pedido_itens : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_h_pedido_itens) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_h_pedido_itens.id,
aju_h_pedido_itens.codigo,
aju_h_pedido_itens.descricao_item,
aju_h_pedido_itens.qtd,
aju_h_pedido_itens.qtd_familia_atendida,
aju_h_pedido_itens.id_pedido
                              FROM aju_h_pedido_itens
                              
                              WHERE id = " . $id_h_pedido_itens;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $h_pedido_itens = $linha;
            }

           $model = self::$model;
            return array($h_pedido_itens, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir H_pedido_itens";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_h_pedido_itens.id,
aju_h_pedido_itens.codigo,
aju_h_pedido_itens.descricao_item,
aju_h_pedido_itens.qtd,
aju_h_pedido_itens.qtd_familia_atendida
                                FROM aju_h_pedido_itens
                                
                                ORDER By id_h_pedido_itens DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o h_pedido_itens

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_h_pedido_itens WHERE id = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar H_pedido_itens !";
        }
    }
            

    /**
     * busca itens do pedido
     */
    public static function busca_item_pedido($id_pedido) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id,
                        codigo,
                        descricao_item,
                        qtd,
                        qtd_familia_atendida,
                        id_pedido
                        FROM aju_h_pedido_itens
                        WHERE id_pedido = ".$id_pedido;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro listando pedido";
        }
    }
    
    
    
    /**
     * # Grava itens inseridos pelo compdec
     */

    public static function gravarItensOriginal(array $dados) {

        $con = Conexao::getInstance();
        $sql = "INSERT INTO aju_h_pedido_itens_original (codigo,
                                                descricao_item,
                                                qtd,
                                                qtd_familia_atendida,
                                                id_pedido,
                                                id_item) VALUES (:codigo,
                                                :descricao_item,
                                                :qtd,
                                                :qtd_familia_atendida,
                                                :id_pedido,
                                                :id_item)";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":codigo", $dados['codigo']);
            $result->bindValue(":descricao_item", $dados['descricao_item']);
            $result->bindValue(":qtd", $dados['qtd']);
            $result->bindValue(":qtd_familia_atendida", $dados['qtd_familia_atendida']);
            $result->bindValue(":id_pedido", $dados['id_pedido']);
            $result->bindValue(":id_item", $dados['id']);

 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

     /**
     * # Busca itens originais para remover 
     */

    public static function buscaItensOriginais($id_item) {

        $dados = array();
        $con = Conexao::getInstance();
        $sql = "select id
                 from aju_h_pedido_itens_original
                 WHERE id_item = ".$id_item;

        try {

            $result = $con->query($sql);

             while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return (count($dados) > 0) ? true : false;

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }
    
    /**
     * # Busca itens originais para remover 
     */

    public static function deletaItensOriginal($id_item) {

        $dados = array();
        $con = Conexao::getInstance();
        $sql = "delete from aju_h_pedido_itens_original
                 WHERE id_item = ".$id_item;

        try {

            $result = $con->query($sql);

            return true;

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }
    
    
}
