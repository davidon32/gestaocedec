<?php

//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela aju_unidade										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 28/09/2020															*
 * ********************************************************************************** */

class UnidadeConEstoqueModel extends Model {

    private $table = "aju_cunidade";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    private $id_unidade = null;
    private $nome = null;
    private $descricao = null;
    private $valor = null;
    private $data_validade = null;
    private $id_marca = null;
    private $id_categoria = null;
    private $id_almoxarifado = null;
    private $id_fornecedor = null;
    private $id_unidade_med = null;

    public function getId_unidade_med() {
        return $this->id_unidade_med;
    }

    public function setId_unidade_med($id_unidade_med) {
        $this->id_unidade_med = $id_unidade_med;
    }

    function __construct() {

        self::$model = $this->Tabela('aju_cunidade');

        self::$mod = "aju";

        self::$con = Conexao::getInstance();
    }

    # lista {$model}

    public static function lista($id = null) {

        $dados = array();

        $sql = "SELECT";
        $sql .= " " . implode(", ", self::$model['dados']['campos']) . "";

        if (empty($id)) {

            $sql .= " FROM " . self::$model['tabela']->TABLE_NAME . " ORDER By " . self::$model['dados']['id'];

            $result = self::$con->query($sql);
        } else {

            $sql .= " FROM " . self::$model['tabela'] . "  
                            WHERE " . self::$model['campos'][0] . " = :id
                            ORDER BY nome";
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

    # Lista Excel Exportar

    public static function listaExportExcel($id = null) {

        $dados = array();

        if (empty($id)) {

            $filtro = "";
        } else {

            $filtro = "WHERE aju_cunidade.id_unidade = " . $id;
        }

        $sql = "select aju_cunidade.id_unidade,
            aju_cunidade.nome,
aju_cunidade.descricao,
aju_cunidade.valor,
aju_cunidade.data_validade,
aju_cmarca.id_marca as cod_marca,
aju_cmarca.nome as marca,
aju_ccategoria.id_categoria as cod_categoria,
aju_ccategoria.nome as categoria,
aju_cunidade_med.id_unidade_med as cod_unidade_med,
aju_cunidade_med.nome as unidade_medida
from aju_cunidade
inner join aju_cmarca
on aju_cunidade.id_marca = aju_cmarca.id_marca
inner join aju_ccategoria
on aju_cunidade.id_categoria = aju_ccategoria.id_categoria
inner join aju_cunidade_med
on aju_cunidade.id_unidade_med = aju_cunidade_med.id_unidade_med " . $filtro . " order by aju_cunidade.nome";

        $result = self::$con->query($sql);

        try {

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

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

    # @ grava {$model} em banco

    public static function gravar(array $dados) {

        $sql = "INSERT INTO aju_cunidade (nome,descricao,valor,data_validade,id_marca,id_categoria,id_almoxarifado,id_fornecedor,id_unidade_med) VALUES (:nome,:descricao,:valor,:data_validade,:id_marca,:id_categoria,:id_almoxarifado,:id_fornecedor,:id_unidade_med)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":nome", $dados['nome']);
            $result->bindValue(":descricao", $dados['descricao']);
            $result->bindValue(":valor", str_replace(",", ".", str_replace(".", "", $dados['valor'])));
            $result->bindValue(":data_validade", DataMysql::dataForm($dados['data_validade']));
            $result->bindValue(":id_marca", $dados['id_marca']);
            $result->bindValue(":id_categoria", $dados['id_categoria']);
            $result->bindValue(":id_almoxarifado", null);
            $result->bindValue(":id_fornecedor", null);
            $result->bindValue(":id_unidade_med", $dados['id_unidade_med']);

            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Cunidade";
        }
    }

    ################  Atualizar dados unidade  ###################

    public static function edit(array $dados) {



        $con = Conexao::getInstance();

        $sql = "UPDATE aju_cunidade SET 
        nome= :nome,
descricao= :descricao,
valor= :valor,
data_validade= :data_validade,
id_marca= :id_marca,
id_categoria= :id_categoria,
id_almoxarifado= :id_almoxarifado,
id_fornecedor= :id_fornecedor,
id_unidade_med= :id_unidade_med
            WHERE id_unidade = :id_unidade";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":id_unidade", $dados['id_unidade']);
            $result->bindValue(":nome", $dados['nome']);
            $result->bindValue(":descricao", $dados['descricao']);
            $result->bindValue(":valor", str_replace(",", ".", str_replace(".", "", $dados['valor'])));
            $result->bindValue(":data_validade", DataMysql::dataForm($dados['data_validade']));
            $result->bindValue(":id_marca", $dados['id_marca']);
            $result->bindValue(":id_categoria", $dados['id_categoria']);
            $result->bindValue(":id_almoxarifado", null);
            $result->bindValue(":id_fornecedor", null);
            $result->bindValue(":id_unidade_med", $dados['id_unidade_med']);

            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Unidade : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    /**
     * View Marca
     */
    public static function view($id_unidade) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT aju_cunidade.id_unidade,
aju_cunidade.nome,
aju_cunidade.descricao,
aju_cunidade.valor,
aju_cunidade.data_validade,
aju_cunidade.id_marca,
aju_cmarca.nome as nome_aju_marca,
aju_cunidade.id_categoria,
aju_ccategoria.nome as nome_aju_categoria,
aju_cunidade.id_unidade_med,
aju_cunidade_med.nome as nome_aju_unidade_med
                              FROM aju_cunidade
                              LEFT JOIN aju_cmarca
ON aju_cunidade.id_marca = aju_cmarca.id_marca
LEFT JOIN aju_ccategoria
ON aju_cunidade.id_categoria = aju_ccategoria.id_categoria
LEFT JOIN aju_cunidade_med
ON aju_cunidade.id_unidade_med = aju_cunidade_med.id_unidade_med

                              WHERE id_unidade = " . $id_unidade;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $unidade = $linha;
            }

            $model = self::$model;
            return array($unidade, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Unidade";
        }
    }

    /* paginacao */

    public function paginacao($start, $regPorPagina) {
        $con = Conexao::getInstance();

        $stmt = $con->prepare("SELECT aju_cunidade.id_unidade,
aju_cunidade.nome,
aju_cunidade.descricao,
aju_cunidade.valor,
aju_cunidade.data_validade,
aju_cunidade.id_marca,
aju_cmarca.nome as nome_aju_marca,
aju_cunidade.id_categoria,
aju_ccategoria.nome as nome_aju_categoria,
aju_cunidade.id_unidade_med,
aju_cunidade_med.nome as nome_aju_unidade_med
                                FROM aju_cunidade
                                LEFT JOIN aju_cmarca
ON aju_cunidade.id_marca = aju_cmarca.id_marca
LEFT JOIN aju_ccategoria
ON aju_cunidade.id_categoria = aju_ccategoria.id_categoria
LEFT JOIN aju_cunidade_med
ON aju_cunidade.id_unidade_med = aju_cunidade_med.id_unidade_med

                                ORDER By id_unidade DESC LIMIT $start, $regPorPagina");
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    # @ deletar o unidade

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_cunidade WHERE id_unidade = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Unidade !";
        }
    }

    #####################  lista autocomplete ######################

    /** lista autocomplete 

     * 

     */
    public function listaid_marcaAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_marca, nome
                              FROM aju_cmarca";

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

    /** lista autocomplete nome unidade

     * 

     */
    public function listaUnidadeSaldoAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $dados = RelatorioConEstoqueModel::saldoProduto();

        return $dados;
    }

    /**
     * LISTA OS PRODUTOS COM BASE NO ALMOXARIFADO, SELECIONADO NO PEDIDO.
     * @param type $id_tp_pedido
     * @return type
     * 
     */
    public function listaUnidadeSaldoAutocompletePorAlmoxarifado($post) {

        //var_dump($id_tp_pedido);

        $con = Conexao::getInstance();

        $dados = array();

        $dados = RelatorioConEstoqueModel::saldoProduto($post);

        return $dados;
    }

    public function listaUnidadeNomeAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "select aju_cunidade.id_unidade,
                aju_cunidade.nome,
                aju_cunidade.descricao,
                aju_cunidade.valor,
                aju_cunidade.data_validade,
                aju_cmarca.nome as marca
                from aju_cunidade
                inner join aju_cmarca
                on aju_cunidade.id_marca= aju_cmarca.id_marca";

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
    public function listaid_categoriaAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_categoria, nome
                              FROM aju_ccategoria";

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
    public function listaid_fornecedorAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_fornecedor, nome
                              FROM aju_cfornecedor";

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
    public function listaid_unidade_medAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_unidade_med, nome
                              FROM aju_cunidade_med";

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
    public function listaid_unidadeAutocomplete() {


        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT id_unidade, nome
                              FROM aju_cunidade";

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
     * Lista unidade
     */
    public function listaunidades() {

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
