<?php

//require_once(PATH . '/core/classe/Classe.Data.php');
/** * ********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_h_pedido_pedid										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 21/06/2021	
 *      Atualização {VERSAO}
 * @param VERSAO														*
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

    #################  CONSTRUTOR ##################

    function __construct() {

        self::$model = $this->Tabela('aju_h_pedido_pedid');

        self::$mod = "aju";

        self::$con = Conexao::getInstance();
    }

    public function getData_hora_envio() {
        return $this->data_hora_envio;
    }

    public function setData_hora_envio($data_hora_envio) {
        $this->data_hora_envio = $data_hora_envio;
    }

    #################  LISTA  ##################
    # lista {$model}

    public static function lista($id = null) {


        $dados = array();

        $sql = "SELECT id, ";
        $sql .= " " . implode(", ", self::$model['dados']['campos']) . "";

        if (empty($id)) {

            $sql .= " FROM " . self::$model['tabela']->TABLE_NAME . " ORDER By " . self::$model['dados']['id'];

            $result = self::$con->query($sql);
        } else {

            $sql .= " FROM " . self::$model['tabela']->TABLE_NAME . "  
                            WHERE id = :id
                            ORDER BY id";

            $result = self::$con->prepare($sql);
            $result->bindValue(":id", $id);
            $result->execute();
        }


        try {

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }

    public static function listaProcessos($id_municipio) {


        try {
            $sql = "SELECT id,
                            numero,
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
                            status, tramit,
                            ano,
                            data_aprovacao,
                            status_prest,
                            parecer_prest,
                            usuario_homolog
                            FROM aju_h_pedido_pedid
                            WHERE id_municipio = {$id_municipio}
                            ORDER By id";

            $result = self::$con->query($sql);

            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }

    public static function listaPedidosTodos($municipio=null, $id_redec =null) {
        
        $con = Conexao::getInstance();
        $filtro = "";
        if (($id_redec != 1) && !is_null($id_redec)) {
            $filtro = " WHERE cedec_rpm_mun.id_rpm = '{$id_redec}' ";
        }
        
        if (($municipio != 1) && !is_null($municipio)) {
            if(empty($filtro)) {
                $filtro = " WHERE cedec_municipio.nome like '%{$municipio}%' ";
            }else {
                $filtro = " AND cedec_municipio.nome like '%{$municipio}%' ";
            }
        }

        $sql = "SELECT aju_h_pedido_pedid.numero,
                aju_h_pedido_pedid.id_municipio,
                aju_h_pedido_pedid.data_entrada_sistema,
                aju_h_pedido_pedid.tipo_decreto,
                aju_h_pedido_pedid.status,
                aju_h_pedido_pedid.tramit,
                aju_h_pedido_pedid.id_cobrade,
                dec_cobrade.descricao as cobrade,
                aju_h_pedido_pedid.data_hora_envio,
                aju_h_pedido_pedid.data_aprovacao,
                cedec_municipio.nome,
                aju_h_pedido_pedid.id
                FROM aju_h_pedido_pedid
                INNER JOIN cedec_municipio
                ON aju_h_pedido_pedid.id_municipio = cedec_municipio.id_municipio
                INNER JOIN cedec_rpm_mun
                ON cedec_rpm_mun.id_municipio = cedec_municipio.id_municipio
                inner join dec_cobrade
                on aju_h_pedido_pedid.id_cobrade = dec_cobrade.id_cobrade
                {$filtro}
                ORDER BY aju_h_pedido_pedid.status";

        try {

            $result = $con->query($sql);

            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function listaPedidosParaDespacho($id_redec = null) {

        $con = Conexao::getInstance();
        $filtro = "";
        if ($id_redec != 1) {
            $filtro = " WHERE cedec_rpm_mun.id_rpm = '{$id_redec}' ";
        }

        $sql = "SELECT aju_h_pedido_pedid.numero,
                aju_h_pedido_pedid.id_municipio,
                aju_h_pedido_pedid.data_entrada_sistema,
                aju_h_pedido_pedid.tipo_decreto,
                aju_h_pedido_pedid.status,
                cedec_municipio.nome,
                aju_h_pedido_pedid.id
                FROM aju_h_pedido_pedid
                INNER JOIN cedec_municipio
                ON aju_h_pedido_pedid.id_municipio = cedec_municipio.id_municipio
                INNER JOIN cedec_rpm_mun
                ON cedec_municipio.id_municipio = cedec_rpm_mun.id_municipio
                {$filtro} ORDER BY aju_h_pedido_pedid.data_entrada_sistema";

        try {
            
            $result = $con->query($sql);

            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $e->getMessage();
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

    #################  LISTA NOME ##################
    # lista nome {$model}

    public static function listaNome($nome = null) {

        try {

            $dados = array();

            $sql = "SELECT ";
            $sql .= " " . self::$model['dados']['id'] . ", ";
            $sql .= " " . implode(", ", self::$model['dados']['campos']) . "";

            if (empty($nome)) {

                $sql .= " FROM " . self::$model['tabela']->TABLE_NAME . " ORDER By " . self::$model['dados']['id'];

                $result = self::$con->query($sql);
            } else {

                $sql .= " FROM " . self::$model['tabela']->TABLE_NAME . "  
                            WHERE " . self::$model['dados']['campos'][0] . " LIKE :nome
                            ORDER BY nome";
                $result = self::$con->prepare($sql);
                $result->bindValue(":nome", '%' . $nome . '%');
                $result->execute();
            }

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
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
tramit,
ano) VALUES (:numero,
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
:tramit,
:ano)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":numero", $dados['numero']);
            $result->bindValue(":data_entrada_sistema", DataMysql::dataForm($dados['entrada_sistema']) . " " . date('H:i:s'));
            $result->bindValue(":despachante_analista", $dados['despachante_analista']);
            $result->bindValue(":despachante_dlog", $dados['despachante_dlog']);
            $result->bindValue(":id_municipio", $dados['id_municipio']);
            $result->bindValue(":id_regiao", $dados['id_meso']);
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
            $result->bindValue(":tramit", "edicao_compdec");
            $result->bindValue(":ano", date('Y'));

            if ($result->execute()) {
                $id = self::$con->lastInsertId();
                $result1['result'] = true;
                $result1['id'] = $id;
            } else {
                return $result1['result'] = false;
                ;
            }

            return $result1;

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
    ################  Atualizar dados h_pedido_pedid  ###################

    public static function edit(array $dados) {

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_h_pedido_pedid SET 
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
                esforcos_realizados= :esforcos_realizados
                            WHERE id = :id";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":id", $dados['id']);
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
            $result->bindValue(":esforcos_realizados", nl2br($dados['esforcos_realizados']));

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
aju_h_pedido_pedid.status,
aju_h_pedido_pedid.ano,
aju_h_pedido_pedid.tramit,
cedec_rpm_mun.id_rpm as regiao_dc
                              FROM aju_h_pedido_pedid
                              LEFT JOIN cedec_municipio
ON aju_h_pedido_pedid.id_municipio = cedec_municipio.id_municipio
LEFT JOIN com_regiao
ON aju_h_pedido_pedid.id_regiao = com_regiao.id_regiao
LEFT JOIN dec_cobrade
ON aju_h_pedido_pedid.id_cobrade = dec_cobrade.id_cobrade
inner join cedec_rpm_mun
on cedec_municipio.id_municipio = cedec_rpm_mun.id_municipio
                              WHERE aju_h_pedido_pedid.id = " . $id_h_pedido_pedid;

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
    /* paginacao */

    public function paginacao($start, $regPorPagina, $id_municipio) {
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
aju_h_pedido_pedid.tramit,
aju_h_pedido_pedid.ano
                                FROM aju_h_pedido_pedid
                                LEFT JOIN cedec_municipio
ON aju_h_pedido_pedid.id_municipio = cedec_municipio.id_municipio
LEFT JOIN com_regiao
ON aju_h_pedido_pedid.id_regiao = com_regiao.id_regiao
LEFT JOIN dec_cobrade
ON aju_h_pedido_pedid.id_cobrade = dec_cobrade.id_cobrade
WHERE aju_h_pedido_pedid.id_municipio = {$id_municipio}

                                ORDER By aju_h_pedido_pedid.id DESC LIMIT $start, $regPorPagina");
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    #################  DELETAR itens pedido  ##################
    # @ deletar itens pedido

    public static function deleteItemPedido($id) {

        $con = Conexao::getInstance();


        $sql = "DELETE FROM aju_h_pedido_itens WHERE id_pedido = " . $id;

        try {
            $con->query($sql);
            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar itens!";
        }
    }

    #################  DELETAR  ##################
    # @ deletar o h_pedido_pedid

    public static function delete($id) {

        $con = Conexao::getInstance();

        self::deleteItemPedido($id);

        $sql = "DELETE FROM aju_h_pedido_pedid WHERE id = " . $id;

        try {
            $con->query($sql);
            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar H_pedido_pedid !";
        }
    }

    #####################  Itens pedido  ######################

    public static function item_pedido($id_pedido, $tipo = "P") {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "select aju_h_pedido_itens.id,
                aju_h_pedido_itens.codigo,
                aju_h_pedido_itens.descricao_item,
                aju_h_pedido_itens.qtd,
                aju_h_pedido_itens.qtd_familia_atendida,
                aju_h_pedido_itens.id_pedido
                from aju_h_pedido_itens
                where aju_h_pedido_itens.id_pedido = " . $id_pedido . "
                And tp_item = '" . $tipo . "'";

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

    #####################  Itens pedido  ######################

    public static function get_item_pedido($id_item, $id_pedido, $tipo) {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "select aju_h_pedido_itens.id,
                aju_h_pedido_itens.codigo,
                aju_h_pedido_itens.descricao_item,
                aju_h_pedido_itens.qtd,
                aju_h_pedido_itens.qtd_familia_atendida,
                aju_h_pedido_itens.id_pedido
                from aju_h_pedido_itens
                where aju_h_pedido_itens.id_pedido = " . $id_pedido . "
                And tp_item = '" . $tipo . "'"
                . " AND aju_h_pedido_itens.id = " . $id_item;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 
     * Lista dos materiais originais do pedido
     */
    public static function item_pedido_original($id_pedido) {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "select aju_h_pedido_itens_original.id,
                aju_h_pedido_itens_original.codigo,
                aju_h_pedido_itens_original.descricao_item,
                aju_h_pedido_itens_original.qtd,
                aju_h_pedido_itens_original.qtd_familia_atendida
                from 
                aju_h_pedido_itens_original
                where aju_h_pedido_itens_original.id_pedido = " . $id_pedido;

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
    }

    /** lista autocomplete 

     * 

     */
    public function parecer_favoravel() {

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
    }

#####################  lista autocomplete ######################

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
    }

    /** lista autocomplete mesoregiao

     * 

     */
    public function listaid_mesoAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_meso, nome
                              FROM cedec_meso";

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
     * Busca Pedidos lista Index
     * @return int
     * 
     */
    public static function listaPedidos($id_municipio) {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT * FROM aju_h_pedido_pedid WHERE id_municipio = {$id_municipio}";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Ocorreu um erro !";
        }
    }

    /* gerar numeração 
      numeração pedido por ano
     */

    public function gerarNumero() {

        $con = Conexao::getInstance();

        $dado = "";

        $sql = "select max(aju_h_pedido_pedid.numero) as numero
                from aju_h_pedido_pedid
                where year(data_entrada_sistema) = year(CURDATE())";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dado = $linha['numero'];
            }

            if (is_null($dado)) {
                return 1;
            } else {
                return (int) ($dado + 1);
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
 cedec_municipio.nome as nome_municipio,
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
 where cedec_municipio.id_municipio = '" . $id_municipio . "' 
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

    /* enumStatus get status 
     * 
     * 0 - Edição Compdec
     * 1 - Analise DRD
     * 2 - Analise DLOG
     * 3 - Analise Diretor DLOG
     * 4 - Aguardando Disponibilidade Mat
     * 5 - Aguardando Retirada Mat
     * 6 - Atendido
     * 7 - Cancelado
     * 
     */

    public static function enumStatus($status) {

        switch ($status) {
            case 0:
                return 'Edição Compdec';
                break;
            case 1:
                return 'Analise DLOG';
                break;
            case 2:
                return 'Analise Diretor DLOG.';
                break;
            case 3:
                return 'Aprovado';
                break;
            case 4:
                return 'Aguardando Disponibilidade Mat.';
                break;
            case 5:
                return 'Aguardando Retirada Mat.';
                break;
            case 6:
                return 'Atendido';
                break;
            case 7:
                return 'Cancelado';
                break;
            case 8:
                return 'Pedido Reprovado';
                break;
            case 9:
                return 'Processo Finalizado';
                break;
            default:
                return 'Opção Inválida !';
                break;
        }
    }

    /* enumStatus get status */

    public static function enumFase($fase) {

        switch ($fase) {
            case 'edicao_compdec':
                return 'Processo em Edição pelo Compdec';
                break;
            case 'analise_dlog':
                return 'em Análise DLOG';
                break;
            case 'analise_coord':
                return 'em Análise Diretor Logistica';
                break;
            case 'aprovado':
                return 'Processo Aprovado';
                break;
            case 'aguard_disp':
                return 'Aguard. Disponibilidade Material';
                break;
            case 'aguard_ret':
                return 'Aguardando Retirada de Material';
                break;
            case 'atendido':
                return 'Prestação de Contas';
                break;
            case 'cancelado':
                return 'Processo Cancelado !';
                break;
            case 'reprovado':
                return 'Processo Reprovado !';
                break;
            case 'finalizado':
                return 'Processo Finalizado !';
                break;
            default:
                return 'Fase Inválida !';
                break;
        }
    }

    /* busca material para pedido ajuda */

    public static function MaterialPedido($situacao = 1) {

        $con = Conexao::getInstance();

        $dado = array();

        $sql = "select DISTINCT singular, id_unidade, descricao, nome from aju_unidade
                where pedido_h = {$situacao}
                    and singular is not null
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

    /* busca material disponivel para pedidos */

    public static function MaterialDisponivelPedido($situacao = 1) {

        $con = Conexao::getInstance();

        $dado = array();

        $sql = "select DISTINCT singular, id_unidade, descricao, nome from aju_unidade
                where pedido_h = {$situacao}
                    and singular is not null
                order by nome";
        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                /* var_dump($linha['singular'], array_column($dado, 'singular') );print "<br>";

                  if(!array_search($linha['singular'], array_column($dado, 'singular'))){ */
                $dado[] = $linha;
                /* } */
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
                # edição compdec / amarelo
                return array('fdo' => '#F3E2A9', 'fonte' => '#2E2E2E', 'title' => '');
                break;
            case 1:
                # analise_drd / cinza
                return array('fdo' => '#D8D8D8', 'fonte' => '#000000', 'title' => '');
                break;
            case 2:
                # analise dlog / azul
                return array('fdo' => '#2E64FE', 'fonte' => '#FFFFFF', 'title' => '');
                break;
            case 3:
                # analise_coord / laranja
                return array('fdo' => '#FE642E', 'fonte' => '#151515', 'title' => '');
                break;
            case 4:
                # Aguardando Disponibilidade
                return array('fdo' => '#9F81F7', 'fonte' => '#FFFFFF', 'title' => '');
                break;
            case 5:
                # Aguardando retirada  / amarelo
                return array('fdo' => '#FFD700', 'fonte' => '#000000', 'title' => '');
                break;
            case 6:
                # Atendido / verde
                return array('fdo' => '#90EE90', 'fonte' => '#2E2E2E', 'title' => '');
                break;
            case 7:
                # Cancelado / nulo
                return array('fdo' => '#B40404', 'fonte' => '#FFFFFF', 'title' => 'Processo Cancelado');
                break;
            case 8:
                # Cancelado / nulo
                return array('fdo' => '#6E6E6E', 'fonte' => '#FFFFFF', 'title' => 'Processo Reprovado');
                break;
            default:
                return array('fdo' => '-', 'fonte' => '-', 'title' => '-');
                break;
        }
    }

    /**
     * Lista de usuario cadastrados como analista
     */
    public static function listaAnalistaPedidoAjuda() {

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
                where id_usuario = " . $id_usuario;
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
                            aju_h_pedido_pedid.tramit,
                            aju_h_pedido_pedid.data_aprovacao
                            FROM gestaocedec.aju_h_pedido_pedid
                            where status > 1 and status < 5";

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
     *  busca dados do pedido
     * 
     */
    public static function buscaPedidoId($id) {

        $con = Conexao::getInstance();
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
                            aju_h_pedido_pedid.tramit,
                            aju_h_pedido_pedid.data_aprovacao
                            FROM gestaocedec.aju_h_pedido_pedid
                            where id = {$id}";

        try {

            $result = $con->query($sql);

            $linha = $result->fetchAll(PDO::FETCH_ASSOC);

            return $linha;
        } catch (Exception $e) {
            return $e->getMessage() . "erro ao selecionar o perdido !";
        }
    }

    /**
     * 
     * verifica pedido estado de envio para analise
     */
    public static function compdecVerificaPedido($id_municipio) {

        $con = Conexao::getInstance();
        $dados = array();

        $sql = "select count(id) from aju_h_pedido_pedid
                where status < 4 and id_municipio =" . $id_municipio;

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
    public static function iniciaPrestContas($id_pedido) {


        $h_pedido_pedid = new H_pedido_pedidajuda_hModel();

        # Busca materiais Pedido
        $dados = $h_pedido_pedid->item_pedido($id_pedido, "L");

        try {
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
    public function lancaMaterialPrest($dados) {

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
            $result->bindValue(":id_pedido", $dados['id_pedido']);
            $result->bindValue(":cod_material", $dados['codigo']);
            $result->bindValue(":nome_material", $dados['descricao_item']);
            $result->bindValue(":total_familia_at", $dados['qtd_familia_atendida']);
            $result->bindValue(":qtd", $dados['qtd']);
            $result->execute();

            //return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir material em prestacao de contas";
        }
    }

    /**
     *  busca status em edição para novo pedido
     * 
     */
    public static function buscaStatus($id_municipio) {

        $con = Conexao::getInstance();
        $dados = "";

        $sql = "select count(id) as id from aju_h_pedido_pedid
                where status = '0' and id_municipio =" . $id_municipio;

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
                                           status = :status,
                                           data_hora_envio = :data_hora_envio
                                           where id = :id_pedido";

        try {
            $result = $con->prepare($sql);
            $result->bindValue(":id_pedido", $dados['id_pedido']);
            $result->bindValue(":data_hora_envio", $dados['data_hora_envio']);
            $result->bindValue(":tramit", $dados['tramit']);
            $result->bindValue(":status", $dados['status']);

            $result->execute();

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "-";
        }
    }

    /**
     * remove permissao de pedir material
     * 
     */
    public function PermissaoMaterial($dados) {

        $con = Conexao::getInstance();
        $sql = "update aju_unidade set pedido_h = :pedido_h
                                           where id_unidade = :id_unidade";

        try {
            $result = $con->prepare($sql);
            $result->bindValue(":pedido_h", $dados['func']);
            $result->bindValue(":id_unidade", $dados['id_unidade']);

            $result->execute();

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "-";
        }
    }

    /**
     *  prazo Prestacao d contas
     */
    public static function prazo_presta_conta($dt_aprovacao) {

        //var_dump($dt_aprovacao);

        $config = Config::getConfig();

        $prazo_prest_conta = '+' . $config['aju_prazo_prest_conta'] . ' day';

        $data_aprovacao = date("d/m/Y", strtotime($prazo_prest_conta, strtotime($dt_aprovacao)));

        return $data_aprovacao;
    }

    /**
     * Tramitar Pedido
     */
    public static function tramitar($dados) {

        $con = Conexao::getInstance();
        $sql = "update aju_h_pedido_pedid set status = :status,
                                            tramit = :tramit
                                            where id = :id_pedido";

        try {
            $result = $con->prepare($sql);
            $result->bindValue(":status", $dados['status']);
            $result->bindValue(":tramit", $dados['tramit']);
            $result->bindValue(":id_pedido", $dados['id_pedido']);

            $result->execute();

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "-";
        }
    }
    
    /**
     * Log de tramitação Pedido
     */
    public static function logTramita($dados) {
        
        //var_dump($dados);

        $con = Conexao::getInstance();
        $sql = "INSERT INTO aju_h_pedido_tramit_log (id_pedido,
                                                status_old,
                                                status_new,
                                                obs,
                                                id_usuario)
                                                    VALUES (:id_pedido,
                                                    :status_old,
                                                    :status_new,
                                                    :obs,
                                                    :id_usuario)";

        try {
            $result = $con->prepare($sql);
            $result->bindValue(":id_pedido", $dados['id_pedido']);
            $result->bindValue(":status_old", $dados['status_old']);
            $result->bindValue(":status_new", $dados['status']);
            $result->bindValue(":obs", $dados['obs']);
            $result->bindValue(":id_usuario", $dados['id_usuario']);
            $result->execute();

            //return true;
        } catch (Exception $e) {
            return $e->getMessage() . "erro ao gravar log tramitação";
        }
        
    }

    
    
    
    /**
     *  total de Processos
     * @param status
     * 
     */
    public static function processosQtd($status) {

        $con = Conexao::getInstance();
        $dados = "";

        $sql = "select count(id) as id from aju_h_pedido_pedid
                where status = '{$status}'";

        $result = $con->query($sql);

        return $result->fetchColumn();
    }
    
    
    
    /**
     *  total de Processos
     * @param status
     * 
     */
    public static function listTramitacao($id_pedido) {

        $con = Conexao::getInstance();
        $dados = "";

        $sql = "select *from aju_h_pedido_tramit_log where id_pedido = '{$id_pedido}'";

        $result = $con->query($sql);

        return $result->fetchAll();
    }
    
    
    
    
    

}
