<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_fornecedor										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class FornecedorConEstoqueModel extends Model {

    
    private $table = "aju_fornecedor";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id_fornecedor = null;
private $nome = null;
private $cpfcnpj = null;
private $endereco = null;
private $municipio = null;
private $estado = null;
private $cep = null;
private $tel = null;


    
    
 public function getTel(){
        return $this->tel;
    }

            
    public function setTel($tel){
            $this->tel = $tel;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_cfornecedor');

         self::$mod = "aju";
         
         self::$con = Conexao::getInstance();

     }
   
    #################  LISTA  ##################
   # lista {$model}
  
    public static function lista($id = null) {
       
         $dados = array();
 
        $sql = "SELECT id_fornecedor,";
        $sql .= " ".implode(", ",self::$model['dados']['campos'])."";
        
        if (empty($id)) {

            $sql .= " FROM ".self::$model['tabela']->TABLE_NAME." ORDER By ".self::$model['dados']['id'];

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

            $sql .= " FROM ".self::$model['tabela']->table_name." ORDER By ".self::$model['dados']['id'];

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

        $sql = "INSERT INTO aju_cfornecedor (nome,
cpfcnpj,
endereco,
municipio,
estado,
cep,
tel 
) VALUES (:nome,
:cpfcnpj,
:endereco,
:municipio,
:estado,
:cep,
:tel 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":nome", $dados['nome']);
$result->bindValue(":cpfcnpj", $dados['cpfcnpj']);
$result->bindValue(":endereco", $dados['endereco']);
$result->bindValue(":municipio", $dados['municipio']);
$result->bindValue(":estado", $dados['estado']);
$result->bindValue(":cep", $dados['cep']);
$result->bindValue(":tel", $dados['tel']);

 
            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados fornecedor  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_cfornecedor SET 
        nome= :nome,
cpfcnpj= :cpfcnpj,
endereco= :endereco,
municipio= :municipio,
estado= :estado,
cep= :cep,
tel= :tel
            WHERE id_fornecedor = :id_fornecedor";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_fornecedor", $dados['id_fornecedor']);
            $result->bindValue(":nome", $dados['nome']);
$result->bindValue(":cpfcnpj", $dados['cpfcnpj']);
$result->bindValue(":endereco", $dados['endereco']);
$result->bindValue(":municipio", $dados['municipio']);
$result->bindValue(":estado", $dados['estado']);
$result->bindValue(":cep", $dados['cep']);
$result->bindValue(":tel", $dados['tel']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Fornecedor : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_fornecedor) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_cfornecedor.id_fornecedor,
aju_cfornecedor.nome,
aju_cfornecedor.cpfcnpj,
aju_cfornecedor.endereco,
aju_cfornecedor.municipio,
aju_cfornecedor.estado,
aju_cfornecedor.cep,
aju_cfornecedor.tel
                              FROM aju_cfornecedor
                              
                              WHERE id_fornecedor = " . $id_fornecedor;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $fornecedor = $linha;
            }

           $model = self::$model;
            return array($fornecedor, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_cfornecedor.id_fornecedor,
aju_cfornecedor.nome,
aju_cfornecedor.cpfcnpj,
aju_cfornecedor.endereco,
aju_cfornecedor.municipio,
aju_cfornecedor.estado,
aju_cfornecedor.cep,
aju_cfornecedor.tel
                                FROM aju_cfornecedor
                                
                                ORDER By id_fornecedor DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o fornecedor

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_cfornecedor WHERE id_fornecedor = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Fornecedor !";
        }
    }
            
     


     
     



    /**
     * Lista fornecedor
     */
    public function listafornecedors() {

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

}
