<?php
//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_transportadora										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 29/09/2020															*
 * ********************************************************************************** */

class TransferenciaConEstoqueModel extends Model {

    
    private $table = "aju_ctransferencia";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
    private $id_transferencia = null;



    
    
 public function getTel(){
        return $this->tel;
    }

            
    public function setTel($tel){
            $this->tel = $tel;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_ctransferencia');

         self::$mod = "aju";
         
         self::$con = Conexao::getInstance();
     }
   
    #################  LISTA  ##################
   # lista {$model}
  
    public static function lista($id = null) {
         
         $dados = array();
 
        $sql = "SELECT id, ";
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
        
        var_dump($dados, Unidade::PegaNomeId($dados['id_unidade']));
        //die();

        $sql = "INSERT INTO aju_ctransferencia
                    (data_transf,
                        motorista,
                        identificacao,
                        veiculo,
                        placa,
                        id_almoxarifado_ori,
                        id_almoxarifado,
                        obs,
                        id_tp_pedido,
                        id_unidade,
                        qtd) VALUES (:data_transf,
                                    :motorista,
                                    :identificacao,
                                    :veiculo,
                                    :placa,
                                    :id_almoxarifado_ori,
                                    :id_almoxarifado,
                                    :obs,
                                    :id_tp_pedido,
                                    :id_unidade,
                                    :qtd)";

        try {

            $result = self::$con->prepare($sql);
            
            $result->bindValue(":data_transf", DataMysql::dataCompletaForm($dados['data_transferencia']));
            $result->bindValue(":motorista",    $dados['motorista']);
            $result->bindValue(":identificacao",$dados['identificacao']);
            $result->bindValue(":veiculo",      $dados['veiculo']);
            $result->bindValue(":placa",        $dados['placa']);
            $result->bindValue(":id_almoxarifado_ori",$dados['id_almoxarifado_ori']);
            $result->bindValue(":id_almoxarifado", $dados['id_almoxarifado']);
            $result->bindValue(":obs",          $dados['obs']." \\n".Unidade::PegaNomeId($dados['id_unidade'])." ".$dados['val_unit']);
            $result->bindValue(":id_tp_pedido", $dados['id_tp_pedido']);
            $result->bindValue(":id_unidade", $dados['id_unidade']);
            $result->bindValue(":qtd", $dados['qtd']);
            
            $exec = $result->execute();
            
            return array('result' => $exec,
                         'id_transferencia' => self::$con->lastInsertId()
                        );
            
            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }
     

    #################  EDIT ##################
            
            
    ################  editar transferencia  ###################

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_ctransportadora SET 
        nome= :nome,
cnpj= :cnpj,
tel= :tel
            WHERE id_transportadora = :id_transportadora";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id_transportadora", $dados['id_transportadora']);
            $result->bindValue(":nome", $dados['nome']);
$result->bindValue(":cnpj", $dados['cnpj']);
$result->bindValue(":tel", $dados['tel']);

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Transportadora : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_transferencia) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_ctransferencia.id,
                        aju_ctransferencia.motorista,
                        aju_ctransferencia.identificacao,
                        aju_ctransferencia.veiculo,
                        aju_ctransferencia.placa,
                        aju_ctransferencia.id_almoxarifado_ori,
                        aju_ctransferencia.id_almoxarifado,
                        aju_ctransferencia.obs,
                        aju_ctransferencia.id_tp_pedido,
                        aju_ctransferencia.situacao,
                        aju_ctransferencia.id_unidade,
                        aju_ctransferencia.qtd
                            FROM aju_ctransferencia
                            WHERE id = " . $id_transferencia;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $transferencia = $linha;
            }

           //$model = self::$model;
            return $transferencia;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao buscar registro";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_ctransportadora.id_transportadora,
aju_ctransportadora.nome,
aju_ctransportadora.cnpj,
aju_ctransportadora.tel
                                FROM aju_ctransportadora
                                
                                ORDER By id_transportadora DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  CANCELAR  ##################
    #   marca como cancelado 0
    #   compoe o saldo origem em aju_ccc
    #   apaga os registros destino aju_ccc
    #

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_ctransportadora WHERE id_transportadora = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Transportadora !";
        }
    }
    
    #####################  Busca nome do ID do Fk  ######################

    /** Busca nome do ID Fk 

     * 

     */
    public function getNomeIdFk($nome_tabela, $id_tabela, $id) {



        if (!is_null($id)) {

            $con = Conexao::getInstance();

            $dados = "";

            $sql = "SELECT nome
                                  FROM {$nome_tabela}
                                  WHERE {$id_tabela} = $id";

            try {

                $result = $con->query($sql);

                while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
                    $dados = $linha;
                }

                return $dados;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            $dados = new \stdClass();
            $dados->nome = '-';
            return $dados;
        }
    }
    
    #####################  lista almoxarifado ( armazem )autocomplete ######################

    public function listaid_almoxarifadoAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_almoxarifado, nome
                              FROM aju_calmoxarifado";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

            
     
    #####################  lista autocomplete tp_pedido ######################

    public function listaid_tp_pedidoAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_tp_pedido, nome
                              FROM aju_ctp_pedido";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


     
     



    /**
     * Lista transportadora
     */
    public function listatransportadoras() {

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
    
    
    # get situacao transferencia
    public function getSituacao($situacao) {
        
        switch ($situacao) {
            case 0:
                return 'Em Aberto';
                break;
            case 1:
                return 'Fechado';
                break;
            case 2:
                return '<b style="color:red">Cancelado</b>';
                break;
            default:
                return 'Código Inválido';
                break;
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
