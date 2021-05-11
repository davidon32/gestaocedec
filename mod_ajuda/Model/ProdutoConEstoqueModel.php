<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_produto										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/09/2020															*
 * ********************************************************************************** */

class ProdutoConEstoqueModel extends Model {

    
    private $table = "aju_cunidade";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    

    
     function __construct() {

         self::$model = $this->Tabela('aju_cunidade');

         self::$mod = "aju";
         
         self::$con = Conexao::getInstance();
     }
    # lista {$model}
  
    public static function lista($id = null) {
 
        $sql = "SELECT";
        $sql .= " '".implode("', '",self::$model['dados']['campos'])."'";
        
        if (empty($id)) {

            $sql .= " FROM ".self::$model['tabela']->table_name." ORDER By ".self::$model['dados']['id'];

            $result =  self::$con->query($sql);
        } else {

            $sql .= " FROM ".self::$model['tabela']."  
                            WHERE ".self::$model['campos'][0]." = :id
                            ORDER BY nome";
            $result = self::$con->prepare($sql);
            $result->bindValue(":id", $id);
            $result->execute();
        }

        try {

            return $result;

        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }

    # @ grava {$model} em banco

    public static function gravar(array $dados) {


        var_dump(self::$model);
        $sql = "INSERT INTO ".self::$model['tabela']->table_name;
        
        
         $sql .= " (".implode(", ",self::$model['dados']['campos']).")";
        
        $sql .= " VALUES (:".implode(", ",self::$model['dados']['campos']).")";


        try {

            $result = self::$con->prepare($sql);

            foreach (self::$model['dados']['campos'] as $campo) {
                $bind = ":".$campo;
               $result->bindValue($bind, $dados[$campo]); 
            }
 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    # Atualizar dados produto

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_produto SET 
        codProd= :codProd,
nome= :nome,
dtEntradaSaida= :dtEntradaSaida,
origem= :origem,
obs= :obs,
quantidade= :quantidade,
depDestino= :depDestino,
validade= :validade,
nota_fiscal= :nota_fiscal,


                                                WHERE id_produto = :id";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":id", $dados['id_marca']);
            $result->bindValue(":nome", $dados['nome']);
            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Marca Produto: " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    
    /**
     * View Marca
     */
    public static function view($id_produto) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT codProd,nome,dtEntradaSaida,origem,obs,quantidade,depDestino,validade,nota_fiscal
                              FROM aju_produto
                              WHERE id_produto = " . $id_produto;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $produto = $linha;
            }

           $model = self::$model;
            return array($produto, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Produto";
        }
    }
    
    
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT codProd,nome,dtEntradaSaida,origem,obs,quantidade,depDestino,validade,nota_fiscal
                                FROM aju_produto
                                ORDER By id_produto DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    
    # @ deletar o produto

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_produto WHERE id_produto = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Produto !";
        }
    }

    /**
     * Lista produto
     */
    public function listaprodutos() {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT pip_fornecedor.id,
                        pip_fornecedor.nome, 
                        pip_fornecedor.tel, 
                        pip_fornecedor.cel,
                         count(pip_dispositivo.id) as qtd
                              FROM pip_fornecedor
                              left JOIN pip_dispositivo
                              ON pip_fornecedor.id = pip_dispositivo.fornecedor_id
                              group BY pip_fornecedor.nome
                              ORDER BY pip_fornecedor.nome";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    /**
     * Lista Fornecedoress
     */
    public static function listaFornecedor($id) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT pip_fornecedor.id,
                        pip_fornecedor.nome,
                        pip_fornecedor.cpfcnpj,
                        pip_fornecedor.tel, 
                        pip_fornecedor.cel
                              FROM pip_fornecedor
                              WHERE id =" . $id;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    

    /**
     * Cadastro Dispositivos
     */
    public static function cDispositivo(array $dados) {


        $con = Conexao::getInstance();
        $sql = "INSERT INTO pip_dispositivo (cel,
                                                fornecedor_id)
                                    		      VALUES (:cel,
                                                    	  :fornecedor_id)";

        try {

            $result = $con->prepare($sql);
            $result->bindValue(":cel", $dados['cel']);
            $result->bindValue(":fornecedor_id", $dados['fornecedor_id']);
            $result->execute();

            Log::GravaLog("Cadastro de Dispositivo: " . $dados['cel'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    /**
     * Cadastro Dispositivos
     */
    public static function qrCode(array $dados) {


        $con = Conexao::getInstance();
        $sql = "INSERT INTO pip_dispositivo (telefone,
                                                fornecedor_id,
                                                hash,
                                                dt_leitura)
                                    		      VALUES (:telefone,
                                                    	  :fornecedor_id,
                                                    	  :hash,
                                                          :dt_leitura)";

        try {

            $result = $con->prepare($sql);
            $result->bindValue(":telefone", $dados['telefone']);
            $result->bindValue(":fornecedor_id", $dados['fornecedor']);
            $result->bindValue(":hash", $dados['hash']);
            $result->bindValue(":dt_leitura", $dados['dt_leitura']);
            $result->execute();

            Log::GravaLog("Cadastro de Dispositivo: " . $dados['telefone'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    /**
     * Get nome fornecedor
     */
    public static function getNome($id) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT nome"
                . " FROM pip_fornecedor"
                . " WHERE id = " . $id;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha['nome'];
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

}
