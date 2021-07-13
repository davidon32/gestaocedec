<?php
require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_h_pedido_pedid										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/06/2021															*
 * ********************************************************************************** */

class H_pedido_pedidajuda_hModel extends Model {

    
    private $table = "aju_h_pedido_pedid";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    
    
private $id = null;
private $numero = null;
private $data_entrada_sistema = null;
private $despachante_analista = null;
private $despachante_dlog = null;
private $id_municipio = null;
private $id_regiao = null;
private $nome_coordenador = null;
private $tel_coordenador = null;
private $cel_coordenador = null;
private $email_coordenador = null;
private $nome_prefeito = null;
private $tel_prefeito = null;
private $cel_prefeito = null;
private $email_prefeito = null;
private $id_cobrade = null;
private $pop_atendida = null;
private $decreto_se_ecp_vig = null;
private $numero_decreto = null;
private $data_vigencia = null;
private $tipo_decreto = null;
private $esforcos_realizados = null;
private $data_hora_envio = null;


    
    
 public function getData_hora_envio(){
        return $this->data_hora_envio;
    }

            
    public function setData_hora_envio($data_hora_envio){
            $this->data_hora_envio = $data_hora_envio;
    }
    

    #################  CONSTRUTOR ##################
     function __construct() {

         self::$model = $this->Tabela('aju_h_pedido_pedid');

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
         
         
    #####################  Busca nome do ID do Fk  ######################
       
     /** Busca nome do ID Fk 

     * 

     */ 

    public function getNomeIdFk($nome_tabela, $id_tabela, $id) {

        if(!is_null($id)){
        
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
                var_dump($sql);
            }
        }else {
            $dados = new \stdClass();
            $dados->nome = '-';
            return $dados;
        }
        
    }
    
    #################  LISTA NOME ##################
    # lista nome {$model}
  
    public static function listaNome($nome = null) {
         
         try {
         
         $dados = array();
 
        $sql = "SELECT ";
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

       $sql = "INSERT INTO aju_h_pedido_pedid (numero,
data_entrada_sistema,
despachante_analista,
despachante_dlog,
id_municipio,
id_regiao,
nome_coordenador,
tel_coordenador,
cel_coordenador,
email_coordenador,
nome_prefeito,
tel_prefeito,
cel_prefeito,
email_prefeito,
id_cobrade,
pop_atendida,
decreto_se_ecp_vig,
numero_decreto,
data_vigencia,
tipo_decreto,
esforcos_realizados,
data_hora_envio,
tramit
) VALUES (:numero,
:data_entrada_sistema,
:despachante_analista,
:despachante_dlog,
:id_municipio,
:id_regiao,
:nome_coordenador,
:tel_coordenador,
:cel_coordenador,
:email_coordenador,
:nome_prefeito,
:tel_prefeito,
:cel_prefeito,
:email_prefeito,
:id_cobrade,
:pop_atendida,
:decreto_se_ecp_vig,
:numero_decreto,
:data_vigencia,
:tipo_decreto,
:esforcos_realizados,
:data_hora_envio, 
:tramit)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":numero", $dados['numero']);
$result->bindValue(":data_entrada_sistema", DataMysql::dataForm($dados['data_entrada_sistema']));
$result->bindValue(":despachante_analista", $dados['despachante_analista']);
$result->bindValue(":despachante_dlog", $dados['despachante_dlog']);
$result->bindValue(":id_municipio", $dados['id_municipio']);
$result->bindValue(":id_regiao", $dados['id_regiao']);
$result->bindValue(":nome_coordenador", $dados['nome_coordenador']);
$result->bindValue(":tel_coordenador", $dados['tel_coordenador']);
$result->bindValue(":cel_coordenador", $dados['cel_coordenador']);
$result->bindValue(":email_coordenador", $dados['email_coordenador']);
$result->bindValue(":nome_prefeito", $dados['nome_prefeito']);
$result->bindValue(":tel_prefeito", $dados['tel_prefeito']);
$result->bindValue(":cel_prefeito", $dados['cel_prefeito']);
$result->bindValue(":email_prefeito", $dados['email_prefeito']);
$result->bindValue(":id_cobrade", $dados['id_cobrade']);
$result->bindValue(":pop_atendida", $dados['pop_atendida']);
$result->bindValue(":decreto_se_ecp_vig", $dados['decreto_se_ecp_vig']);
$result->bindValue(":numero_decreto", $dados['numero_decreto']);
$result->bindValue(":data_vigencia", DataMysql::dataForm($dados['data_vigencia']));
$result->bindValue(":tipo_decreto", $dados['tipo_decreto']);
$result->bindValue(":esforcos_realizados", $dados['esforcos_realizados']);
$result->bindValue(":data_hora_envio", DataMysql::dataForm($dados['data_hora_envio']));
$result->bindValue(":tramit", "analise_drd");

            if($result->execute()){
                $id = self::$con->lastInsertId();

                print "<script>";
                print "window.location.href = '".(FuncaoBase::geraLink("ajuda", "h_pedido_itens", "cadastro", array("id" => $id)))."';";
                print "</script>";
            }else {
                print 'erro';
            }

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
            
            
    ################  Atualizar dados h_pedido_pedid  ###################

    public static function edit(array $dados) {

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_h_pedido_pedid SET 
        numero= :numero,
data_entrada_sistema= :data_entrada_sistema,
despachante_analista= :despachante_analista,
despachante_dlog= :despachante_dlog,
id_municipio= :id_municipio,
id_regiao= :id_regiao,
nome_coordenador= :nome_coordenador,
tel_coordenador= :tel_coordenador,
cel_coordenador= :cel_coordenador,
email_coordenador= :email_coordenador,
nome_prefeito= :nome_prefeito,
tel_prefeito= :tel_prefeito,
cel_prefeito= :cel_prefeito,
email_prefeito= :email_prefeito,
id_cobrade= :id_cobrade,
pop_atendida= :pop_atendida,
decreto_se_ecp_vig= :decreto_se_ecp_vig,
numero_decreto= :numero_decreto,
data_vigencia= :data_vigencia,
tipo_decreto= :tipo_decreto,
esforcos_realizados= :esforcos_realizados,
data_hora_envio= :data_hora_envio
            WHERE id = :id";

        try {

            $result = $con->prepare($sql);
            
            $result->bindValue(":id", $dados['id']);
            $result->bindValue(":numero", $dados['numero']);
$result->bindValue(":data_entrada_sistema", DataMysql::dataForm($dados['data_entrada_sistema']));
$result->bindValue(":despachante_analista", $dados['despachante_analista']);
$result->bindValue(":despachante_dlog", $dados['despachante_dlog']);
$result->bindValue(":id_municipio", $dados['id_municipio']);
$result->bindValue(":id_regiao", $dados['id_regiao']);
$result->bindValue(":nome_coordenador", $dados['nome_coordenador']);
$result->bindValue(":tel_coordenador", $dados['tel_coordenador']);
$result->bindValue(":cel_coordenador", $dados['cel_coordenador']);
$result->bindValue(":email_coordenador", $dados['email_coordenador']);
$result->bindValue(":nome_prefeito", $dados['nome_prefeito']);
$result->bindValue(":tel_prefeito", $dados['tel_prefeito']);
$result->bindValue(":cel_prefeito", $dados['cel_prefeito']);
$result->bindValue(":email_prefeito", $dados['email_prefeito']);
$result->bindValue(":id_cobrade", $dados['id_cobrade']);
$result->bindValue(":pop_atendida", $dados['pop_atendida']);
$result->bindValue(":decreto_se_ecp_vig", $dados['decreto_se_ecp_vig']);
$result->bindValue(":numero_decreto", $dados['numero_decreto']);
$result->bindValue(":data_vigencia", DataMysql::dataForm($dados['data_vigencia']));
$result->bindValue(":tipo_decreto", $dados['tipo_decreto']);
$result->bindValue(":esforcos_realizados", $dados['esforcos_realizados']);
$result->bindValue(":data_hora_envio", DataMysql::dataForm($dados['data_hora_envio']));

            
            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de H_pedido_pedid : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */
    public static function view($id_h_pedido_pedid) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_h_pedido_pedid.id,
aju_h_pedido_pedid.numero,
aju_h_pedido_pedid.data_entrada_sistema,
aju_h_pedido_pedid.despachante_analista,
aju_h_pedido_pedid.despachante_dlog,
aju_h_pedido_pedid.id_municipio,
cedec_municipio.nome as nome_cedec_municipio,
aju_h_pedido_pedid.id_regiao,
com_regiao.nome as nome_com_regiao,
aju_h_pedido_pedid.nome_coordenador,
aju_h_pedido_pedid.tel_coordenador,
aju_h_pedido_pedid.cel_coordenador,
aju_h_pedido_pedid.email_coordenador,
aju_h_pedido_pedid.nome_prefeito,
aju_h_pedido_pedid.tel_prefeito,
aju_h_pedido_pedid.cel_prefeito,
aju_h_pedido_pedid.email_prefeito,
aju_h_pedido_pedid.id_cobrade,
dec_cobrade.descricao as nome_dec_cobrade,
aju_h_pedido_pedid.pop_atendida,
aju_h_pedido_pedid.decreto_se_ecp_vig,
aju_h_pedido_pedid.numero_decreto,
aju_h_pedido_pedid.data_vigencia,
aju_h_pedido_pedid.tipo_decreto,
aju_h_pedido_pedid.esforcos_realizados,
aju_h_pedido_pedid.data_hora_envio,
aju_h_pedido_pedid.status

                              FROM aju_h_pedido_pedid
                              LEFT JOIN cedec_municipio
ON aju_h_pedido_pedid.id_municipio = cedec_municipio.id_municipio
LEFT JOIN com_regiao
ON aju_h_pedido_pedid.id_regiao = com_regiao.id_regiao
LEFT JOIN dec_cobrade
ON aju_h_pedido_pedid.id_cobrade = dec_cobrade.id_cobrade

                              WHERE id = " . $id_h_pedido_pedid;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $h_pedido_pedid = $linha;
            }

           $model = self::$model;
            return array($h_pedido_pedid, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir H_pedido_pedid";
        }
    }
    
    #################  PAGINACAO  ##################
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT aju_h_pedido_pedid.id,
aju_h_pedido_pedid.numero,
aju_h_pedido_pedid.data_entrada_sistema,
aju_h_pedido_pedid.despachante_analista,
aju_h_pedido_pedid.despachante_dlog,
aju_h_pedido_pedid.id_municipio,
cedec_municipio.nome as nome_cedec_municipio,
aju_h_pedido_pedid.id_regiao,
com_regiao.nome as nome_com_regiao,
aju_h_pedido_pedid.nome_coordenador,
aju_h_pedido_pedid.tel_coordenador,
aju_h_pedido_pedid.cel_coordenador,
aju_h_pedido_pedid.email_coordenador,
aju_h_pedido_pedid.nome_prefeito,
aju_h_pedido_pedid.tel_prefeito,
aju_h_pedido_pedid.cel_prefeito,
aju_h_pedido_pedid.email_prefeito,
aju_h_pedido_pedid.id_cobrade,
dec_cobrade.descricao as nome_dec_cobrade,
aju_h_pedido_pedid.pop_atendida,
aju_h_pedido_pedid.decreto_se_ecp_vig,
aju_h_pedido_pedid.numero_decreto,
aju_h_pedido_pedid.data_vigencia,
aju_h_pedido_pedid.tipo_decreto,
aju_h_pedido_pedid.esforcos_realizados,
aju_h_pedido_pedid.data_hora_envio,
aju_h_pedido_pedid.status,
aju_h_pedido_pedid.tramit
                                FROM aju_h_pedido_pedid
                                LEFT JOIN cedec_municipio
ON aju_h_pedido_pedid.id_municipio = cedec_municipio.id_municipio
LEFT JOIN com_regiao
ON aju_h_pedido_pedid.id_regiao = com_regiao.id_regiao
LEFT JOIN dec_cobrade
ON aju_h_pedido_pedid.id_cobrade = dec_cobrade.id_cobrade

                                ORDER By aju_h_pedido_pedid.id DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    #################  DELETAR  ##################
    # @ deletar o h_pedido_pedid

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_h_pedido_pedid WHERE id_h_pedido_pedid = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar H_pedido_pedid !";
        }
    }
        

    #####################  Iten pedido  ######################
    public static function item_pedido($id_pedido) {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "select aju_h_pedido_itens.id,
                aju_h_pedido_itens.codigo,
                aju_h_pedido_itens.descricao_item,
                aju_h_pedido_itens.qtd,
                aju_h_pedido_itens.qtd_familia_atendida
                from 
                aju_h_pedido_itens
                where aju_h_pedido_itens.id_pedido = ".$id_pedido;

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
     


     #####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_municipioAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_municipio, nome
                              FROM cedec_municipio";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }#####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_regiaoAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_regiao, nome
                              FROM com_regiao";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }#####################  lista autocomplete ######################
       
     /** lista autocomplete 

     * 

     */ 

    public function listaid_cobradeAutocomplete() {

        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_cobrade, descricao
                              FROM dec_cobrade";

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
     * Lista h_pedido_pedid
     */
    public function listah_pedido_pedids() {

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
    
    
    /* gerar numeração 
        numeração pedido por ano
    */
    public function gerarNumero(){
        
        $con = Conexao::getInstance();
        
        $dado = "";
        
        $sql = "select aju_h_pedido_pedid.numero
                from aju_h_pedido_pedid
                where year(data_entrada_sistema) = year(CURDATE())";
        
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dado = $linha['numero'];
            }
            
            if(is_null($dado)){
                return 1;
            }else {
                return $dado+1;
            }
        } catch (Exception $e) {
            return $e->getMessage() . "Ocorreu um erro !";
        }
    }
    
    
    
    /*

     *      */
    
    public function buscaDadosPedido($id_municipio) {
        
        $con = Conexao::getInstance();
        
        $dado = "";
        
        $sql = "select com_eq_comdec.nome as nome_coordenador,
 com_eq_comdec.funcao as funcao_coordenador, 
 com_eq_comdec.telefone as tel_coordenador,
 com_eq_comdec.celular as cel_coordenador,
 com_eq_comdec.email as email_coordenador,
 cedec_municipio.nome as nome_coordenador,
 cedec_municipio.prefeito as nome_prefeito,
 cedec_municipio.tel_pref as tel_prefeito,
 cedec_municipio.cel_pref as cel_prefeito,
 cedec_municipio.email as email_prefeito,
 cedec_meso.id_meso,
 cedec_meso.nome as nome_meso
 from com_eq_comdec
 inner join cedec_municipio
 on cedec_municipio.id_municipio = com_eq_comdec.id_municipio
 inner join cedec_meso
 on cedec_municipio.id_meso = cedec_meso.id_meso
 where cedec_municipio.id_municipio = '".$id_municipio."' 
 and com_eq_comdec.funcao = 'COORDENADOR'";
                
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dado = $linha;
            }
            
            return $dado;
            
        } catch (Exception $e) {
            return $e->getMessage() . "Ocorreu um erro !";
        }
    }
    
    
    /* enumStatus get status */
    public static function enumStatus($status) {
        
        switch ($status) {
            case 0:
                return 'Edição Compdec';
                break;
            case 1:
                return '-';
                break;
            case 2:
                return 'Analise DRD';
                break;
            case 3:
                return 'Analise DLOG';
                break;
            case 4:
                return 'Analise Coord.';
                break;
            case 5:
                return 'Atendido';
                break;
            case 6:
                return 'Cancelado';
                break;
            default:
                break;
        }
        
    }
    
    /* enumStatus get status */
    public function enumFase($fase) {
        
        switch ($fase) {
            case 'analise_drd':
                return 'em Análise DRD';
                break;
            case 'analise_dlog':
                return 'em Análise DLOG';
                break;
            case 'analise_coord':
                return 'em Análise Coord. Adjunto CEDEC';
                break;
            default:
                break;
        }
        
    }
    
    
    /* busca material para pedido ajuda*/
    public static function MaterialPedido(){
        
        $con = Conexao::getInstance();
        
        $dado = array();
        
        $sql = "select id_unidade, nome, descricao from aju_unidade
                where pedido_h = 1
                order by nome";
        
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dado[] = $linha;
            }
            
            return $dado;
            
        } catch (Exception $e) {
            return $e->getMessage() . "Ocorreu um erro !";
        }
        
    }
    
    
    /**
     * 
     * 
     */
    public function getCorStatus($status) {
        
        switch ($status) {
            case 0:
                # edição compdec
                return '#e6e600';
                break;
            case 1:
                # -
                return '#275bf5';
                break;
            case 2:
                # analise_drd
                return '#e6e600';
                break;
            case 3:
                # analise dlog
                return '#e6e600';
                break;
            case 4:
                # analise_coord
                return '#e6e600';
                break;
            case 5:
                # Atendido
                return '#00cc00';
                break;
            case 6:
                # Cancelado
                return '#f53682';
                break;
            default:
                break;
        }
                
    }
    
    /**
     * Lista de usuario cadastrados como analista
     */
    public static function listaAnalistaPedidoAjuda(){
        
        $con = Conexao::getInstance();
        $dado = array();
        
        $sql = "SELECT id_permissao,
                    login,
                    id_usuario,
                    analista_drd,
                    analista_dlog,
                    analista_coord
                FROM aju_h_permissao";
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dado[] = $linha;
            }
            
            return $dado;
            
        } catch (Exception $e) {
            return $e->getMessage() . "erro ao selecionar as permissões !";
        }
        
        
    }
    
    
    /**
     * Busca analista 
     */
    public function buscaAnalista($id_usuario) {
        
        $con = Conexao::getInstance();
        
        $dado = array();
        $sql = "select analista_drd,
                analista_dlog,
                analista_coord
                from aju_h_permissao
                where id_usuario = ".$id_usuario;
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dado[] = $linha;
            }
            
            return $dado;
            
        } catch (Exception $e) {
            return $e->getMessage() . "erro ao selecionar as permissões !";
        }
    }
        
        
        /**
     * Adicionar permissao usuario
     */
    public function AddPermissao(array $dados) {
        
        $con = Conexao::getInstance();
        $sql = "INSERT INTO aju_h_permissao (login,
                                                id_usuario,
                                                analista_drd,
                                                analista_dlog,
                                                analista_coord)
                                                    VALUES (:login,
                                                    :id_usuario,
                                                    :analista_drd,
                                                    :analista_dlog,
                                                    :analista_coord)";

        try {
            $result = $con->prepare($sql);
            $result->bindValue(":login", $dados['login']);
            $result->bindValue(":id_usuario", $dados['id_usuario']);
            $result->bindValue(":analista_drd", $dados['analista_drd']);
            $result->bindValue(":analista_dlog", $dados['analista_dlog']);
            $result->bindValue(":analista_coord", $dados['analista_coord']);
            $result->execute();

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Permissao";
        }
        
    }
        
        
     /**
     * atualizar permissao usuario
     */
    public function AtualizarPermissao(array $dados) {
        
        $con = Conexao::getInstance();
        $sql = "update aju_h_permissao set analista_drd = :analista_drd,
                                           analista_dlog = :analista_dlog,
                                           analista_coord = :analista_coord
                                           where id_usuario = :id_usuario";

        try {
            $result = $con->prepare($sql);
            $result->bindValue(":id_usuario", $dados['id_usuario']);
            $result->bindValue(":analista_drd", $dados['analista_drd']);
            $result->bindValue(":analista_dlog", $dados['analista_dlog']);
            $result->bindValue(":analista_coord", $dados['analista_coord']);
            $result->execute();

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Permissao";
        }
        
            
    }
    
        /**
     * Remover permissao usuario 
     */
    public function removerPermissao($dados) {
        
        $con = Conexao::getInstance();
        $sql = "update aju_h_permissao set analista_drd = 0,
                                           analista_dlog = 0,
                                           analista_coord = 0
                                           where id_usuario = :id_usuario";

        try {
            $result = $con->prepare($sql);
            $result->bindValue(":id_usuario", $dados);
            
            $result->execute();

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao remover Permissao";
        }      
    }
    
    
    /**
     *  busca dados do pedido
     * 
     */
    public function buscaPedidoH() {
        
        $con = Conexao::getInstance();
        $dados = array();
        
        $sql = "SELECT aju_h_pedido_pedid.id,
                            aju_h_pedido_pedid.numero,
                            aju_h_pedido_pedid.data_entrada_sistema,
                            aju_h_pedido_pedid.despachante_analista,
                            aju_h_pedido_pedid.despachante_dlog,
                            aju_h_pedido_pedid.id_municipio,
                            aju_h_pedido_pedid.id_regiao,
                            aju_h_pedido_pedid.nome_coordenador,
                            aju_h_pedido_pedid.tel_coordenador,
                            aju_h_pedido_pedid.cel_coordenador,
                            aju_h_pedido_pedid.email_coordenador,
                            aju_h_pedido_pedid.nome_prefeito,
                            aju_h_pedido_pedid.tel_prefeito,
                            aju_h_pedido_pedid.cel_prefeito,
                            aju_h_pedido_pedid.email_prefeito,
                            aju_h_pedido_pedid.id_cobrade,
                            aju_h_pedido_pedid.pop_atendida,
                            aju_h_pedido_pedid.decreto_se_ecp_vig,
                            aju_h_pedido_pedid.numero_decreto,
                            aju_h_pedido_pedid.data_vigencia,
                            aju_h_pedido_pedid.tipo_decreto,
                            aju_h_pedido_pedid.esforcos_realizados,
                            aju_h_pedido_pedid.data_hora_envio,
                            aju_h_pedido_pedid.status,
                            aju_h_pedido_pedid.tramit
                            FROM gestaocedec.aju_h_pedido_pedid";
        
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }
            
            return $dados;
            
        } catch (Exception $e) {
            return $e->getMessage() . "erro ao selecionar as perdidos !";
        }
        
        
    }
    
    
    /**
     * 
     * verifica pedido estado de envio para analise
     */
    public static function compdecVerificaPedido($id_municipio){
        
        $con = Conexao::getInstance();
        $dados = array();
        
        $sql = "select count(id) from aju_h_pedido_pedid
                where status < 4 and id_municipio =".$id_municipio;
        
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }
            
            return (count($dados) > 0) ? true : false;
            
        } catch (Exception $e) {
            return $e->getMessage() . "erro ao selecionar as perdidos !";
        }
        
    }
    
    
    
    /**
     *  inicia prestação de contas
     * 
     */
    public function iniciaPrestContas($id_pedido){
        
        
        $h_pedido_pedid = new H_pedido_pedidajuda_hModel();
        
        # Busca materiais Pedido
        $dados = $h_pedido_pedid->item_pedido($id_pedido);

        try{
            # lanca materiais perestaçao de contas
            foreach ($dados as $key => $value) {      
                $h_pedido_pedid->lancaMaterialPrest($value); 
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        
        return true;
    }
    
    
    /**
     * Lancamento de materiais para prestação de contas
     * 
     */
    public function lancaMaterialPrest($dados){
        
        $con = Conexao::getInstance();
        $sql = "INSERT INTO aju_h_pedido_prest (id_pedido,
                                                cod_material,
                                                nome_material,
                                                total_familia_at,
                                                qtd)
                                                    VALUES (:id_pedido,
                                                    :cod_material,
                                                    :nome_material,
                                                    :total_familia_at,
                                                    :qtd)";

        try {
            $result = $con->prepare($sql);
            $result->bindValue(":id_pedido", $dados['id']);
            $result->bindValue(":cod_material", $dados['codigo']);
            $result->bindValue(":nome_material", $dados['descricao_item']);
            $result->bindValue(":total_familia_at", $dados['qtd_familia_atendida']);
            $result->bindValue(":qtd", $dados['qtd']);
            $result->execute();

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir material em prestacao de contas";
        }
        
    }
    
    
    /**
     *  busca status em edição para novo pedido
     * 
     */ 
    public static function buscaStatus($id_municipio){
        
        $con = Conexao::getInstance();
        $dados = "";
        
        $sql = "select count(id) as id from aju_h_pedido_pedid
                where status = '0' and id_municipio =".$id_municipio;
        
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }
            
            return ($dados['id'] > 0) ? true : false;
            
        } catch (Exception $e) {
            return $e->getMessage() . "erro ao selecionar as perdidos !";
        }
        
    }
    
    
     /**
     * Envia pedido para analise
      * @param id_pedido
      * @param tramit
     */
    public function envia_pedido(array $dados) {
        
        $con = Conexao::getInstance();
        $sql = "update aju_h_pedido_pedid set tramit = :tramit,
                                           status = 2
                                           where id = :id_pedido";

        try {
            $result = $con->prepare($sql);
            $result->bindValue(":id_pedido", $dados['id_pedido']);
            $result->bindValue(":tramit", $dados['tramit']);
            
            $result->execute();

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "-";
        }      
    }
    
       
}
