<?php
//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_h_pedido_prest										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/06/2021															*
 * ********************************************************************************** */

class H_pedido_prestajuda_hModel extends Model {

    
    private $table = "aju_h_pedido_prest";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id = null;
private $id_pedido = null;
private $cod_material = null;
private $nome_material = null;
private $total_familia_at = null;


    
    
 public function getTotal_familia_at(){
        return $this->total_familia_at;
    }

            
    public function setTotal_familia_at($total_familia_at){
            $this->total_familia_at = $total_familia_at;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_h_pedido_prest');

         self::$mod = "aju";
         
         self::$con = Conexao::getInstance();
     }
   
    #################  LISTA  ##################
   # lista {$model}
  
    public static function lista($id = null) {
         
         $dados = array();
 
        $sql = "SELECT ";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($id)) {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME." ORDER By ".self::$model['dados']['id'];

            $result =  self::$con->query($sql);
        } else {

            $sql .= " FROM ".self::$model['tabela']."  
                            WHERE ".self::$model['campos'][0]." = :id
                            ORDER BY nome";
            
            var_dump($sql);
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

    public static function gravar(array $dados) {


        var_dump(self::$model);
        $sql = "INSERT INTO aju_h_pedido_prest (id_pedido,
cod_material,
nome_material,
total_familia_at 
) VALUES (:id_pedido,
:cod_material,
:nome_material,
:total_familia_at 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":id_pedido", $dados['id_pedido']);
$result->bindValue(":cod_material", $dados['cod_material']);
$result->bindValue(":nome_material", $dados['nome_material']);
$result->bindValue(":total_familia_at", $dados['total_familia_at']);

 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados h_pedido_prest  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_h_pedido_prest SET 
        id_pedido= :id_pedido,
cod_material= :cod_material,
nome_material= :nome_material,
total_familia_at= :total_familia_at
            WHERE id = :id";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id", $dados['id']);
            $result->bindValue(":id_pedido", $dados['id_pedido']);
$result->bindValue(":cod_material", $dados['cod_material']);
$result->bindValue(":nome_material", $dados['nome_material']);
$result->bindValue(":total_familia_at", $dados['total_familia_at']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de H_pedido_prest : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_h_pedido_prest) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_h_pedido_prest.id,
aju_h_pedido_prest.id_pedido,
aju_h_pedido_prest.cod_material,
aju_h_pedido_prest.nome_material,
aju_h_pedido_prest.qtd,
aju_h_pedido_prest.total_familia_at

                              FROM aju_h_pedido_prest
                              
                              WHERE id = " . $id_h_pedido_prest;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $h_pedido_prest = $linha;
            }

           $model = self::$model;
            return array($h_pedido_prest, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir H_pedido_prest";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_h_pedido_prest.id,
aju_h_pedido_prest.id_pedido,
aju_h_pedido_prest.cod_material,
aju_h_pedido_prest.nome_material,
aju_h_pedido_prest.total_familia_at
                                FROM aju_h_pedido_prest
                                
                                ORDER By id DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o h_pedido_prest

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_h_pedido_prest WHERE id_h_pedido_prest = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar H_pedido_prest !";
        }
    }
            
     


     
     



    /**
     * Lista h_pedido_prest
     */
    public function listah_pedido_prests() {

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
    public static function getFornecedorNome($id) {

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
    
    /**
     *  Lista de materiais para fazer a prestacao d contas
     *  
     */
    public static function listaPrestContasporPedido($id_pedido){
        
         $con = Conexao::getInstance();

        $dados = array();
        
        $sql = "SELECT id,
                    id_pedido,
                    cod_material,
                    nome_material,
                    total_familia_at,
                    qtd
                FROM aju_h_pedido_prest
                where id_pedido = ".$id_pedido;
        
         try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }
            
            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro seleciona os prestacao de contas";
        }
       
        
    }

    
    /**
     *  qtd benefiarios prestação de contas 
     * @param id do item da prestacao de contas (material para prestar contas)
     */
    public static function percBenef($id_prest_conta){
        
        $con = Conexao::getInstance();

        $dados = "";

        
        $sql = "select sum(qtd) as id from aju_h_pedido_benef
                where id_prest_conta = ".$id_prest_conta;
        
         try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return (empty($dados['id']) ? 0 : $dados['id']);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro seleciona os beneficiarios";
        }
    }
    
    
    /**
     *  qtd material pedido 
     * @param id_prest_cont
     */
    public static function QtdMaterialPrest($id_prest_conta){
        
        $con = Conexao::getInstance();

        $dados = "";

        
        $sql = "select qtd from aju_h_pedido_prest
                where id = ".$id_prest_conta;
         try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return $dados['qtd'];
        } catch (Exception $e) {
            return $e->getMessage() . "Erro seleciona os beneficiarios";
        }
        
    }
    
    
    /**
     *  Total de materiais para prestação de contas 
     * @param id_pedido
     */
    public static function totalMaterialPrestConta($id_pedido){
        
        $con = Conexao::getInstance();

        $dados = "";

        
        $sql = "SELECT SUM(aju_h_pedido_prest.qtd) as qtd_prest_cont
                            FROM aju_h_pedido_prest
                            WHERE aju_h_pedido_prest.id_pedido = ".$id_pedido;
         try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return is_null($dados['qtd_prest_cont']) ? 0 : $dados['qtd_prest_cont'];
        } catch (Exception $e) {
            
            return $e->getMessage() . "Erro qtd itens para prestacão de contas";
        }
        
    }
    /**
     *  Total de materiais para prestação de contas 
     * @param id_pedido
     */
    public static function totalMaterialBeneficiarios($id_pedido){
        
        $con = Conexao::getInstance();

        $dados = "";

        
        $sql = "select SUM(aju_h_pedido_benef.qtd) as qtd_benef
                            FROM aju_h_pedido_benef
                            where aju_h_pedido_benef.id_pedido = ".$id_pedido;
         try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return is_null($dados['qtd_benef']) ? 0 : $dados['qtd_benef'];
            
        } catch (Exception $e) {
            return $e->getMessage() . "Erro qtd materiais dos beneficiarios";
        }
        
    }
    
    
}
