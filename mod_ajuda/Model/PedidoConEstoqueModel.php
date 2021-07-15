<?php

//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_pedido										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 05/10/2020															*
 * ********************************************************************************** */

class PedidoConEstoqueModel extends Model {

    private $table = "aju_cpedido";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    private $id_pedido = null;
    private $id_tp_pedido = null;
    private $data_emissao = null;
    private $data_entrega = null;
    private $id_almoxarifado = null;
    private $id_transportadora = null;
    private $id_destinatario = null;
    private $id_destinatario_final = null;
    private $nome_destinatario_final = null;
    private $obs = null;

    public function getObs() {
        return $this->obs;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    #################  CONSTRUTOR ##################

    function __construct() {

        self::$model = $this->Tabela('aju_cpedido');

        self::$mod = "aju";

        self::$con = Conexao::getInstance();
    }

    /**
     * 
     *  @param integer $id_pedido Cancelamento de Pedido
     * 
     */
    public static function cancelar(array $dados) {

        $dadosPedido = self::lista($dados['id_pedido']);
        
        $itemPedido = self::lista_produto_pedido($dados['id_pedido']);
        

        $con = Conexao::getInstance();
        
        $sql = "UPDATE aju_cpedido SET situacao = 2,
                       justificativa = '".$dados['justificativa']."'
                       WHERE id_pedido = ".$dados['id_pedido'];

        foreach ($itemPedido['valor'] as $key => $value) {

            $item = array('id_almoxarifado' => $dadosPedido[0]['id_almoxarifado'],
                      'data_registro'   => date('Y-m-d'),
                      'id_unidade'      => $value->id_unidade,
                      'qtd'             => $value->qtd,
                      'val_unid'        => $value->val_unid,
                      'val_total'       => $value->val_total,
                      'historico'       => "Entrada - Cancelamento Pedido Nr :".$dados['id_pedido'],
                      'tipo'            => 'entrada',
                      'id_pedido'       => $dados['id_pedido']);

            self::creditar($item);
            
        }

        try {
            $result = self::$con->prepare($sql);

            $result->execute();

            return true;
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    ################## Debita saldo  ####################
    /**
     * 
     * @param array $item 'id_pedido'  => $id_pedido,
                          'data_registro',                   
                          'id_almoxarifado' ( Armazem ),
                          'historico'  =>"Saida Pedido Nr :".$id_pedido,
                          'tipo_lancamento'       => 'saida',
                          'id_unidade' - id_produto,
                          'qtd',
                          'val_unitario',
                          'val_total',
     * 
     */

    public static function debitar(array $item) {

        $con = Conexao::getInstance();

        $sql = "INSERT INTO aju_ccc (data_reg,
                                        id_unidade,
                                        historico,
                                        tipo,
                                        qtd,
                                        id_pedido,
                                        val_unit,
                                        val_total,
                                        id_almoxarifado,
                                        id_nota,
                                        id_tp_pedido)
                                            VALUES (:data_registro,
                                                    :id_unidade,
                                                    :historico,
                                                    :tipo,
                                                    :qtd,
                                                    :id_pedido,
                                                    :val_unit,
                                                    :val_total,
                                                    :id_almoxarifado,
                                                    :id_nota,
                                                    :id_tp_pedido)";
        try {
            $result = self::$con->prepare($sql);
            
            $result->bindValue(":id_pedido",       $item['id_pedido']);
            $result->bindValue(":data_registro",   $item['data_registro']);
            $result->bindValue(":id_almoxarifado", $item['id_almoxarifado']);
            $result->bindValue(":historico",       $item['historico']);
            $result->bindValue(":tipo",            $item['tipo_lancamento']);      
            $result->bindValue(":id_unidade",      $item['id_unidade']);
            $result->bindValue(":qtd",             -$item['qtd']);
            $result->bindValue(":val_unit",        $item['val_unitario']);
            $result->bindValue(":val_total",       $item['val_total']);
            $result->bindValue(":id_nota",       $item['id_nota']);
            $result->bindValue(":id_tp_pedido",       $item['id_tp_pedido']);
            

            $result->execute();

            return true;
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    ################## credita saldo ####################
    /**
     * 
     * @param array $item 'id_pedido'  => $id_pedido,
                          'data_registro',                   
                          'id_almoxarifado' ( Armazem ),
                          'historico'  =>"Saida Pedido Nr :".$id_pedido,
                          'tipo_lancamento'       => 'saida',
                          'id_unidade' - id_produto,
                          'qtd',
                          'val_unitario',
                          'val_total',
     * 
     */

    public static function creditar(array $item) {

        $con = Conexao::getInstance();

        $sql = "INSERT INTO aju_ccc (data_reg,
                                        id_unidade,
                                        historico,
                                        tipo,
                                        qtd,
                                        id_pedido,
                                        val_unit,
                                        val_total,
                                        id_almoxarifado)
                                            VALUES (:data_reg,
                                                    :id_unidade,
                                                    :historico,
                                                    :tipo,
                                                    :qtd,
                                                    :id_pedido,
                                                    :val_unit,
                                                    :val_total,
                                                    :id_almoxarifado)";
        try {
            $result = self::$con->prepare($sql);

            $result->bindValue(":id_pedido", $item['id_pedido']);
            $result->bindValue(":data_reg", $item['data_registro']);
            $result->bindValue(":id_almoxarifado", $item['id_almoxarifado']);
            $result->bindValue(":id_unidade", $item['id_unidade']);
            $result->bindValue(":historico", $item['historico']);
            $result->bindValue(":tipo", $item['tipo']);
            $result->bindValue(":qtd", $item['qtd']);
            $result->bindValue(":val_unit", $item['val_unid']);
            $result->bindValue(":val_total", $item['val_total']);
            

            $result->execute();

            return true;
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    #################  LISTA  ##################
    # lista {$model}

    public static function lista($id = null) {

        $dados = array();

        $sql = "SELECT";
        $sql .= " " . implode(", ", self::$model['dados']['campos']) . "";

        if (empty($id)) {

            $sql .= " FROM " . self::$model['tabela']->TABLE_NAME . " ORDER By " . self::$model['dados']['id'];

            $result = self::$con->query($sql);
        } else {

            $sql .= " FROM " . self::$model['tabela']->TABLE_NAME . "  
                            WHERE " . self::$model['dados']['id'] . " = :id
                            ORDER BY id_pedido DESC";
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

    ################## LISTA DADOS PEDIDO #################

    public function listadadosPedido($id_pedido) {

        $con = Conexao::getInstance();
        $dados = array();

        $sql = "SELECT aju_cpedido.id_pedido,
aju_cpedido.id_tp_pedido,
aju_ctp_pedido.nome as nome_aju_tp_pedido,
aju_cpedido.data_emissao,
aju_cpedido.data_entrega,
aju_cpedido.id_almoxarifado,
aju_cpedido.situacao,
aju_calmoxarifado.nome as nome_aju_almoxarifado,
aju_cpedido.id_transportadora,
aju_ctransportadora.nome as nome_aju_transportadora,
aju_cpedido.id_destinatario,
aju_cdestinatario.nome as nome_aju_destinatario,
aju_cpedido.id_destinatario_final,
aju_cdestinatario_final.nome as nome_aju_destinatario_final,
aju_cdestinatario.cnpj,
aju_cpedido.nome_destinatario_final,
aju_cpedido.obs,
aju_cdestinatario.endereco,
aju_cdestinatario.cep,
aju_cdestinatario.municipio,
aju_cdestinatario.estado
FROM aju_cpedido
LEFT JOIN aju_ctp_pedido 
ON aju_cpedido.id_tp_pedido = aju_ctp_pedido.id_tp_pedido
LEFT JOIN aju_calmoxarifado 
ON aju_cpedido.id_almoxarifado = aju_calmoxarifado.id_almoxarifado
LEFT JOIN aju_ctransportadora 
ON aju_cpedido.id_transportadora = aju_ctransportadora.id_transportadora
LEFT JOIN aju_cdestinatario 
ON aju_cpedido.id_destinatario = aju_cdestinatario.id_destinatario
LEFT JOIN aju_cdestinatario_final 
ON aju_cpedido.id_destinatario_final = aju_cdestinatario_final.id_destinatario_final
WHERE aju_cpedido.id_pedido = " . $id_pedido;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
                $dados = $linha;
            }

            return $dados;
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

            $sql = "SELECT";
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

    #################  PEDIDOS EM ABERTO ##################

    public static function separacaoLista($_dados = null) {

        $pedido = array();

        $filtro = "";

        /* acabar outro momento
         * $pedidoModel = new Model;
          array_pop($_dados);
          $camposFiltro = array();
          $filtro = "";
          var_dump($_dados);
          foreach ($_dados as $key => $_dado) {
          if(strpos($key, "id_") === 0){
          $sinal = "=";
          }elseif(strpos($key, "data") === 0){
          $sinal = "data";
          }else{
          $sinal = "varchar";
          }
          if(!empty($_dado)){
          //print $_dado;
          $camposFiltro[] = ['sinal' => $sinal,'campo' => $key, 'valor' => $_dado];
          }
          $filtro = $pedidoModel->montaFiltro($camposFiltro);
          } */

        $_id_pedido = isset($_dados['id_pedido']) ? $_dados['id_pedido'] : "";
        $_dt_inicial = isset($_dados['data_pedido_inicio']) ? $_dados['data_pedido_inicio'] : "";
        $_dt_final = isset($_dados['data_pedido_fim']) ? $_dados['data_pedido_fim'] : "";
        $_destinatario = isset($_dados['destinatario']) ? $_dados['destinatario'] : "";


        /* id_pedido */
        if (strlen($_id_pedido) > 0) {

            $filtro = ' WHERE aju_cpedido.id_pedido = ' . $_id_pedido;
        }

        /* data inicial e final */
        if (( strlen($_dt_inicial) > 0) && (strlen($_dt_final) > 0)) {
            $filtro = ' WHERE aju_cpedido.data_emissao BETWEEN "' . DataMysql::dataForm($_dt_inicial) . '" AND "' . DataMysql::dataForm($_dt_final) . '" ';
        }

        /* destinatario */
        if (strlen($_destinatario) > 0) {
            $filtro = " WHERE aju_cdestinatario.nome like '%" . $_destinatario . "%' ";
        }



        $con = Conexao::getInstance();

        $sql = "SELECT aju_cpedido.id_pedido,
aju_cpedido.id_tp_pedido,
aju_ctp_pedido.nome as nome_aju_tp_pedido,
aju_cpedido.data_emissao,
aju_cpedido.data_entrega,
aju_cpedido.id_almoxarifado,
aju_cpedido.situacao,
aju_calmoxarifado.nome as nome_aju_almoxarifado,
aju_cpedido.id_transportadora,
aju_ctransportadora.nome as nome_aju_transportadora,
aju_cpedido.id_destinatario,
aju_cdestinatario.nome as nome_aju_destinatario,
aju_cpedido.id_destinatario_final,
aju_cdestinatario_final.nome as nome_aju_destinatario_final,
aju_cpedido.nome_destinatario_final,
aju_cpedido.obs
                              FROM aju_cpedido
                              LEFT JOIN aju_ctp_pedido
ON aju_cpedido.id_tp_pedido = aju_ctp_pedido.id_tp_pedido
LEFT JOIN aju_Calmoxarifado
ON aju_cpedido.id_almoxarifado = aju_calmoxarifado.id_almoxarifado
LEFT JOIN aju_Ctransportadora
ON aju_cpedido.id_transportadora = aju_ctransportadora.id_transportadora
LEFT JOIN aju_cdestinatario
ON aju_cpedido.id_destinatario = aju_cdestinatario.id_destinatario
LEFT JOIN aju_cdestinatario_final
ON aju_cpedido.id_destinatario_final = aju_cdestinatario_final.id_destinatario_final " . $filtro . "
ORDER by aju_cpedido.id_pedido DESC";

        try {
            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $pedido[] = $linha;
            }
            return $pedido;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro listar Pedido";
        }
    }

    #################  GRAVAR  ##################
    # @ grava {$model} em banco

    public static function gravar(array $dados) {

        $sql = "INSERT INTO aju_cpedido (id_tp_pedido,
                data_emissao,
                id_almoxarifado,
                id_transportadora,
                id_destinatario,
                id_destinatario_final,
                nome_destinatario_final,
                obs 
                ) VALUES (:id_tp_pedido,
                :data_emissao,
                :id_almoxarifado,
                :id_transportadora,
                :id_destinatario,
                :id_destinatario_final,
                :nome_destinatario_final,
                :obs 
                )";

        try {
            
            $result = self::$con->prepare($sql);

            $result->bindValue(":id_tp_pedido", $dados['id_tp_pedido']);
            $result->bindValue(":data_emissao", DataMysql::dataForm($dados['data_emissao']));
            $result->bindValue(":id_almoxarifado", $dados['id_almoxarifado']);
            $result->bindValue(":id_transportadora", $dados['id_transportadora']);
            $result->bindValue(":id_destinatario", $dados['id_destinatario']);
            $result->bindValue(":id_destinatario_final", $dados['id_destinatario_final']);
            $result->bindValue(":nome_destinatario_final", $dados['nome_destinatario_final']);
            $result->bindValue(":obs", $dados['obs']);

            $dadosItens = json_decode(str_replace("\\", "", $dados['itens']));
            
            $result->execute();

            $id_pedido = self::$con->lastInsertID();

            # adiciona itens de nota
            foreach ($dadosItens as $key => $value) {

                if ($value->data_validade == "") {
                    $value->data_validade = null;
                }
                $sql = "INSERT INTO aju_citens_pedido (id_unidade,"
                        . "qtd,"
                        . "val_unid,"
                        . "val_total,"
                        . "data_validade,"
                        . "id_pedido,"
                        . "id_nota)"
                        . " VALUES (:id_unidade, :qtd, :val_unid, :val_total, :data_validade, :id_pedido, :id_nota)";

                $result = self::$con->prepare($sql);

                # remove R$ e ponto de existir, depois troca a virgula por ponto
                $val_total = str_replace(",", ".", str_replace(".", "", substr($value->val_total, 4)));

                $val_unid = str_replace(",", ".", str_replace(".", "", substr($value->val_unid, 4)));

                $result->bindValue(":id_unidade", $value->id_unidade);
                $result->bindValue(":qtd", $value->qtd);
                $result->bindValue(":val_unid", $val_unid);
                $result->bindValue(":val_total", $val_total);
                $result->bindValue(":data_validade", DataMysql::dataForm($value->data_validade));
                $result->bindValue(":id_pedido", $id_pedido);
                $result->bindValue(":id_nota", $value->id_nota);

                $result->execute();
                
                $dados_ccc = array('id_pedido'         => $id_pedido,
                                     'data_registro'   => DataMysql::dataForm($dados['data_emissao']),                   
                                     'id_almoxarifado' => $dados['id_almoxarifado'],
                                     'historico'       =>"Saida - Pedido Nr :".$id_pedido,
                                     'tipo_lancamento' => 'saida',
                                     'id_unidade'      => $value->id_unidade,
                                     'qtd'             => $value->qtd,
                                     'val_unitario'    => $val_unid,
                                     'val_total'       => $val_total,
                                     'id_tp_pedido'         => $dados['id_tp_pedido'],
                                     'id_nota'         => $value->id_nota);

                

                self::debitar($dados_ccc);
            }

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            print 'sucesso';
            
            
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir item";
        }
    }

    #################  EDIT ##################
    ################  Atualizar dados pedido  ###################

    public static function edit(array $dados) {

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_cpedido SET 
        id_tp_pedido= :id_tp_pedido,
        data_emissao= :data_emissao,
        id_almoxarifado= :id_almoxarifado,
        id_transportadora= :id_transportadora,
        id_destinatario= :id_destinatario,
        id_destinatario_final= :id_destinatario_final,
        nome_destinatario_final= :nome_destinatario_final,
        obs= :obs
                    WHERE id_pedido = :id_pedido";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":id_pedido", $dados['id_pedido']);
            $result->bindValue(":id_tp_pedido", $dados['id_tp_pedido']);
            $result->bindValue(":data_emissao", DataMysql::dataForm($dados['data_emissao']));
            $result->bindValue(":id_almoxarifado", $dados['id_almoxarifado']);
            $result->bindValue(":id_transportadora", $dados['id_transportadora']);
            $result->bindValue(":id_destinatario", $dados['id_destinatario']);
            $result->bindValue(":id_destinatario_final", $dados['id_destinatario_final']);
            $result->bindValue(":nome_destinatario_final", $dados['nome_destinatario_final']);
            $result->bindValue(":obs", $dados['obs']);


            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Pedido : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Pedido";
        }
    }

    #################  GRAVAR SEPARACAO MERCADORIA ##################
    ################  Atualizar dados pedido  ###################

    public static function gravarSeparacao(array $dados) {
        

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_cpedido set 
                data_entrega= :data_entrega,
                volume= :volume,
                situacao= :situacao
                WHERE id_pedido = :id_pedido";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":id_pedido", $dados['id_pedido']);
            $result->bindValue(":data_entrega", DataMysql::dataForm($dados['data_entrega']));
            $result->bindValue(":volume", $dados['volume']);
            $result->bindValue(":situacao", $dados['situacao']);

            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Pedido : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao atualizar Pedido !";
        }
    }

    #################  VIEW  ##################
    /**
     * View Marca
     */

    public static function view($id_pedido) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_cpedido.id_pedido,
aju_cpedido.id_tp_pedido,
aju_ctp_pedido.nome as nome_aju_tp_pedido,
aju_cpedido.data_emissao,
aju_cpedido.data_entrega,
aju_cpedido.id_almoxarifado,
aju_calmoxarifado.nome as nome_aju_almoxarifado,
aju_cpedido.id_transportadora,
aju_ctransportadora.nome as nome_aju_transportadora,
aju_cpedido.id_destinatario,
aju_cdestinatario.nome as nome_aju_destinatario,
aju_cdestinatario.cnpj as cnpj_destinatario,
aju_cdestinatario.endereco as endereco_destinatario,
aju_cdestinatario.estado as estado_destinatario,
aju_cdestinatario.municipio as municipio_destinatario,
aju_cdestinatario.cep as cep_destinatario,
aju_cpedido.id_destinatario_final,
aju_cdestinatario_final.nome as nome_aju_destinatario_final,
aju_cpedido.nome_destinatario_final,
aju_cpedido.obs,
aju_cpedido.situacao
                              FROM aju_cpedido
                              LEFT JOIN aju_ctp_pedido
ON aju_cpedido.id_tp_pedido = aju_ctp_pedido.id_tp_pedido
LEFT JOIN aju_calmoxarifado
ON aju_cpedido.id_almoxarifado = aju_calmoxarifado.id_almoxarifado
LEFT JOIN aju_ctransportadora
ON aju_cpedido.id_transportadora = aju_ctransportadora.id_transportadora
LEFT JOIN aju_cdestinatario
ON aju_cpedido.id_destinatario = aju_cdestinatario.id_destinatario
LEFT JOIN aju_cdestinatario_final
ON aju_cpedido.id_destinatario_final = aju_cdestinatario_final.id_destinatario_final

                              WHERE id_pedido = " . $id_pedido;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $pedido = $linha;
            }

            $model = self::$model;
            return array($pedido, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Pedido";
        }
    }

    #################  PAGINACAO  ##################
    /* paginacao */

    public function paginacao($start, $regPorPagina) {
        $con = Conexao::getInstance();

        $stmt = $con->prepare("SELECT aju_cpedido.id_pedido,
aju_cpedido.id_tp_pedido,
aju_ctp_pedido.nome as nome_aju_tp_pedido,
aju_cpedido.data_emissao,
aju_cpedido.data_entrega,
aju_cpedido.id_almoxarifado,
aju_calmoxarifado.nome as nome_aju_almoxarifado,
aju_cpedido.id_transportadora,
aju_ctransportadora.nome as nome_aju_transportadora,
aju_cpedido.id_destinatario,
aju_cdestinatario.nome as nome_aju_destinatario,
aju_cpedido.id_destinatario_final,
aju_cdestinatario_final.nome as nome_aju_destinatario_final,
aju_cpedido.nome_destinatario_final,
aju_cpedido.obs,
aju_cpedido.situacao
                                FROM aju_cpedido
                                LEFT JOIN aju_ctp_pedido
ON aju_cpedido.id_tp_pedido = aju_ctp_pedido.id_tp_pedido
LEFT JOIN aju_calmoxarifado
ON aju_cpedido.id_almoxarifado = aju_calmoxarifado.id_almoxarifado
LEFT JOIN aju_ctransportadora
ON aju_cpedido.id_transportadora = aju_ctransportadora.id_transportadora
LEFT JOIN aju_cdestinatario
ON aju_cpedido.id_destinatario = aju_cdestinatario.id_destinatario
LEFT JOIN aju_cdestinatario_final
ON aju_cpedido.id_destinatario_final = aju_cdestinatario_final.id_destinatario_final
                                ORDER By id_pedido DESC LIMIT $start, $regPorPagina");
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }
    
    
    #################  DELETAR Iten Conta Corrente PEDIDO ##################
    # @ deletar Conta corrente

    public static function deletarCc($id) {

        $con = Conexao::getInstance();
       
        $sql = "DELETE FROM aju_ccc WHERE id_pedido = " . $id;
        try {
            $con->query($sql);
            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar conta corrente !";
        }
    }
    
    #################  DELETAR itens PEDIDO ##################
    # @ deletar o pedido

    public static function deletarItensPedido($id) {

        $con = Conexao::getInstance();
       
        $sql = "DELETE FROM aju_citens_pedido WHERE id_pedido = " . $id;
        try {
            $con->query($sql);
            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Pedido !";
        }
    }
    

    #################  DELETAR  ##################
    # @ deletar o pedido

    public static function delete($id) {

        $con = Conexao::getInstance();
       
        $sql = "DELETE FROM aju_cpedido WHERE id_pedido = " . $id;
        try {
            $con->query($sql);
            
            
            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Pedido !";
        }
    }

    #####################  lista autocomplete ######################

    /** lista autocomplete 

     * 

     */
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

    ####################  lista autocomplete Pedido ######################

    /** lista autocomplete 

     * 

     */
    public function listaid_pedidoAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT distinct aju_cpedido.id_pedido,
                        aju_cpedido.data_emissao,
                        aju_cpedido.volume,
                        aju_cdestinatario.nome,
                        (select sum(aju_citens_pedido.val_total) from aju_citens_pedido 
                        where aju_citens_pedido.id_pedido = aju_cpedido.id_pedido group by aju_citens_pedido.id_pedido) as total_pedido
                            FROM aju_cpedido
                            INNER join aju_cdestinatario
                        on aju_cpedido.id_destinatario = aju_cdestinatario.id_destinatario
                        left join aju_citens_pedido
                        ON aju_cpedido.id_pedido = aju_citens_pedido.id_pedido";

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

#####################  lista autocomplete ######################

    /** lista autocomplete 

     * 

     */
    public function listaid_transportadoraAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_transportadora, nome
                              FROM aju_ctransportadora";

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
    public function listaid_destinatarioAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_destinatario, nome
                              FROM aju_cdestinatario";

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
    public function listaid_destinatario_finalAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_destinatario_final, nome
                              FROM aju_cdestinatario_final";

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

    /*     * *
     * ####################### LISTA PRODUTOS DO PEDIDO #################
     * 
     */

    public static function lista_produto_pedido($id_pedido) {

        $con = Conexao::getInstance();

        $dados = array();
        $total = "";

        $sql = "SELECT aju_citens_pedido.id_itens_pedido,
                        aju_citens_pedido.id_unidade,
                        aju_cunidade.nome,
                        aju_cunidade.descricao,
                        aju_citens_pedido.qtd,
                        aju_citens_pedido.val_unid,
                        aju_citens_pedido.val_total,
                        aju_citens_pedido.data_validade,
                        aju_citens_pedido.id_pedido,
                        aju_citens_pedido.id_nota,
                        aju_cmarca.nome as nome_marca,
                        aju_cunidade_med.nome as unidade_med
                              FROM aju_citens_pedido
                              left JOIN aju_cunidade
                              ON aju_citens_pedido.id_unidade = aju_cunidade.id_unidade
                              LEFT JOIN aju_cmarca
                              ON aju_cunidade.id_marca = aju_cmarca.id_marca
                              left join aju_cunidade_med
                              on aju_cunidade.id_unidade_med = aju_cunidade_med.id_unidade_med
                              WHERE aju_citens_pedido.id_pedido = {$id_pedido}";

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_OBJ)) {
                $dados['valor'][] = $linha;
                $total += $linha->val_total;
            }

            $dados['total'] = $total;
            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro";
        }
    }

    /**
     * Lista pedido
     */
    public function listapedidos() {

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
    
    
    # get situacao pedido
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

}
