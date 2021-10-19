<?php

//require_once(PATH . '/core/classe/Classe.Data.php');
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

class RelatorioConEstoqueModel extends Model {

    private static $con;

    function __construct() {

        self::$con = Conexao::getInstance();
    }

    public static function saldoProduto(array $filtro = null) {

        $con = Conexao::getInstance();

        $dados = array();

        if (isset($filtro['id_unidade'])) {
            $id_unidade = " and aju_ccc.id_unidade = " . $filtro['id_unidade'] . " ";
        } else {
            $id_unidade = "";
        }
        
        if (isset($filtro['id_tp_pedido'])) {
            if($filtro['id_tp_pedido'] == 1){
                //$almoxarifado = ""
            }
            $id_tp_pedido = " and aju_ccc.id_tp_pedido = " . $filtro['id_tp_pedido'] . " ";
        } else {
            $id_tp_pedido = "";
        }
        
        

        $sql = "select aju_ccc.id_unidade, 
                        aju_cunidade.nome as nome,
                        aju_cunidade.descricao,
                        aju_cunidade_med.nome as unid_med_nome,
                        aju_cunidade.data_validade,
                        aju_cmarca.nome as marca_nome,
                        aju_cunidade.descricao,
                        aju_ctp_pedido.nome as almoxarifado,
                        sum(aju_ccc.qtd) as qtd,
                        aju_ccc.val_unit,
                        aju_calmoxarifado.nome as armazem,
                        aju_ccc.id_nota
                        from aju_ccc
                        inner join aju_cunidade
                        on aju_ccc.id_unidade = aju_cunidade.id_unidade
                        inner join aju_cunidade_med
                        on aju_cunidade.id_unidade_med = aju_cunidade_med.id_unidade_med
                        inner join aju_cmarca
                        on aju_cunidade.id_marca = aju_cmarca.id_marca
                        inner join aju_calmoxarifado
                        on aju_ccc.id_almoxarifado = aju_calmoxarifado.id_almoxarifado
                        inner join aju_ctp_pedido
                        on aju_ccc.id_tp_pedido = aju_ctp_pedido.id_tp_pedido
                        where aju_ccc.id_aju_ccc > 0 " . $id_unidade . " " . $id_tp_pedido . "
                        group by aju_ccc.id_unidade, aju_ccc.val_unit, aju_ccc.id_nota
                        order by aju_cunidade.nome";

        $result = $con->prepare($sql);
        $result->execute();

        try {
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }

    public static function inventario(array $param) {

        /* implementar parametros via post */

        $dados = RelatorioConEstoqueModel::saldoProduto();

        return $dados;
    }

    public static function pedidos(array $param) {

        /* implementar parametros via post */

        $dados = RelatorioConEstoqueModel::relPedidos();

        // return $dados;
    }

    public static function rel_pedidoModel(array $filtro = null) {
        
        $data_inicial = " ";
        if (strlen($filtro['data_inicio']) > 0) {
            $data_inicial = " and aju_cpedido.data_emissao >= '" . date("Y-m-d", strtotime(str_replace("/","-",$filtro['data_inicio']))) . "' ";
        }

        $data_final = " ";
        if (strlen($filtro['data_final']) > 0) {
            $data_final = " and aju_cpedido.data_emissao <= '" . date("Y-m-d", strtotime(str_replace("/","-",$filtro['data_final']))) . "' ";
        }

        $municipio = " ";
        if (strlen($filtro['id_destinatario']) > 0) {
            $municipio = " and aju_cpedido.id_destinatario = " . $filtro['id_destinatario'] . " ";
        }

        $material = " "; # unidade
        if (strlen($filtro['id_unidade']) > 0) {
            $material = " and aju_cunidade.id_unidade = " . $filtro['id_unidade'] . " ";
        }

        $armazem = " ";
        if (strlen($filtro['id_tp_pedido']) > 0) {
            $armazem = " and aju_cpedido.id_tp_pedido = " . $filtro['id_tp_pedido'] . " ";
            
        }

        $almoxarifado = " ";
        if (strlen($filtro['id_almoxarifado']) > 0) {
            $almoxarifado = " and aju_cpedido.id_almoxarifado = " . $filtro['id_almoxarifado'] . " ";
        }
        
        $id_fornecedor = " ";
        if (strlen($filtro['id_fornecedor']) > 0) {
            $id_nota = " and aju_cpedido.id_fornecedor = " . $filtro['id_fornecedor'] . " ";
        }
        
        $id_destinatario_final = "";
        if (strlen($filtro['id_destinatario_final']) > 0) {
            $id_nota = " and aju_cpedido.id_destinatario_final = " . $filtro['id_destinatario_final'] . " ";
        }
        
        $id_nota = " ";
        if (strlen($filtro['id_nota']) > 0) {
            $id_nota = " and aju_citens_pedido.id_nota = " . $filtro['id_nota'] . " ";
        }
        
        $filtro_dados = $data_inicial.$data_final.$municipio.$armazem.$almoxarifado.$id_fornecedor.$id_destinatario_final.$id_nota;
        
        
        $con = Conexao::getInstance();

        $dados = array();

        # filtro de material 
        if(strlen($material) > 1) {
            
            $filtro_dados .= $material; 
        }
        
        $sql = "select aju_cpedido.id_pedido,
                        aju_cpedido.id_tp_pedido,
                        aju_ctp_pedido.nome as almoxarifado,
                        aju_cpedido.data_emissao,
                        aju_cpedido.data_entrega,
                        aju_cpedido.id_almoxarifado,
                        aju_calmoxarifado.nome as armazem, 
                        aju_cpedido.id_transportadora,
                        aju_ctransportadora.nome as transportadora,
                        aju_cpedido.id_destinatario,
                        aju_cdestinatario.nome as destinatario,
                        aju_cpedido.id_destinatario_final,
                        aju_cdestinatario_final.nome as destinatario_final,
                        aju_cpedido.nome_destinatario_final,
                        aju_cpedido.obs,
                        aju_cpedido.situacao,
                        aju_cpedido.volume,
                        aju_cpedido.justificativa,
                        aju_cfornecedor.nome,
                        aju_cunidade.id_unidade,
                        aju_cunidade.nome as material,
                        aju_citens_pedido.qtd,
                        aju_citens_pedido.val_unid,
                        aju_citens_pedido.id_nota
                        from aju_cpedido
                        inner join aju_ctp_pedido
                        on aju_cpedido.id_tp_pedido = aju_ctp_pedido.id_tp_pedido
                        inner join aju_calmoxarifado
                        on aju_cpedido.id_almoxarifado = aju_calmoxarifado.id_almoxarifado
                        inner join aju_ctransportadora 
                        on aju_cpedido.id_transportadora = aju_ctransportadora.id_transportadora
                        inner join aju_cdestinatario
                        on aju_cpedido.id_destinatario = aju_cdestinatario.id_destinatario
                        inner join aju_cdestinatario_final
                        on aju_cpedido.id_destinatario_final = aju_cdestinatario_final.id_destinatario_final
                        inner join aju_citens_pedido
                        on aju_cpedido.id_pedido = aju_citens_pedido.id_pedido
                        inner join aju_centrada_nota
                        on aju_citens_pedido.id_nota = aju_centrada_nota.id_entrada_nota
                        inner join aju_cfornecedor
                        on aju_centrada_nota.id_fornecedor = aju_cfornecedor.id_fornecedor
                        inner join aju_cunidade
                        on aju_citens_pedido.id_unidade = aju_cunidade.id_unidade
                        where aju_cpedido.id_pedido > 0 ".$filtro_dados;
        
        

        $result = $con->prepare($sql);
        $result->execute();

        try {
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
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
            $sql .= " " . self::$model['dados']['id'] . ", ";
            $sql .= " " . implode(", ", self::$model['dados']['campos']) . "";

            if (empty($nome)) {

                $sql .= " FROM " . self::$model['tabela']->table_name . " ORDER By " . self::$model['dados']['id'];

                $result = self::$con->query($sql);
            } else {

                $sql .= " FROM " . self::$model['tabela']->table_name . "  
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


        var_dump(self::$model);
        $sql = "INSERT INTO aju_fornecedor (nome,
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

        $sql = "UPDATE aju_fornecedor SET 
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

        $sql = "SELECT aju_fornecedor.id_fornecedor,
aju_fornecedor.nome,
aju_fornecedor.cpfcnpj,
aju_fornecedor.endereco,
aju_fornecedor.municipio,
aju_fornecedor.estado,
aju_fornecedor.cep,
aju_fornecedor.tel
                              FROM aju_fornecedor
                              
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
    /* paginacao */

    public function paginacao($start, $regPorPagina) {
        $con = Conexao::getInstance();

        $stmt = $con->prepare("SELECT aju_fornecedor.id_fornecedor,
aju_fornecedor.nome,
aju_fornecedor.cpfcnpj,
aju_fornecedor.endereco,
aju_fornecedor.municipio,
aju_fornecedor.estado,
aju_fornecedor.cep,
aju_fornecedor.tel
                                FROM aju_fornecedor
                                
                                ORDER By id_fornecedor DESC LIMIT $start, $regPorPagina");
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    #################  DELETAR  ##################
    # @ deletar o fornecedor

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_fornecedor WHERE id_fornecedor = " . $id;

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
