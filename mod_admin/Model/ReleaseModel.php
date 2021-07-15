<?php

//require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 	
 *    Gerador de código : 1.0
 *
 * 	Classe para manipulacao da tabela cedec_release										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos	
 *      MASP: 1296844
 * 																					*
 * 	Criacao : 18/05/2021															*
 * ********************************************************************************** */

class releaseModel extends Model {

    private $table = "cedec_release";
    public static $model;
    private static $mod;
    private $marca;
    private static $con;
    private $id_release = null;
    private $texto = null;
    private $dt_release = null;

    public function getDt_release() {
        return $this->dt_release;
    }

    public function setDt_release($dt_release) {
        $this->dt_release = $dt_release;
    }

    #################  CONSTRUTOR ##################

    function __construct() {

        self::$model = $this->Tabela('cedec_release');

        self::$mod = "aju";

        self::$con = Conexao::getInstance();
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

    #################  GRAVAR  ##################
    # @ grava {$model} em banco

    public static function gravar(array $dados) {

        $sql = "INSERT INTO cedec_release (texto,
data_release 
) VALUES (:texto,
:data_release 
)";

        try {

            $result = self::$con->prepare($sql);

            $result->bindValue(":texto", $dados['texto']);
            $result->bindValue(":data_release", DataMysql::dataForm($dados['data_release']));


            $result->execute();

            #Log::GravaLog("Cadastro de marca : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir marca";
        }
    }

    #################  EDIT ##################
    ################  Atualizar dados release  ###################

    public static function edit(array $dados) {



        $con = Conexao::getInstance();

        $sql = "UPDATE cedec_release SET 
        texto= :texto,
data_release= :data_release
            WHERE id_release = :id_release";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":id_release", $dados['id_release']);
            $result->bindValue(":texto", $dados['texto']);
            $result->bindValue(":data_release", DataMysql::dataForm($dados['data_release']));


            $result->execute();

            #Log::GravaLog("Atualizar Cadastro de Release : " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao Atualizar Marca";
        }
    }

    #################  VIEW  ##################

    /**
     * View Marca
     */
    public static function view($id_release) {

        $con = Conexao::getInstance();

        $fornecedor = "";

        $sql = "SELECT cedec_release.id_release,
cedec_release.texto,
cedec_release.data_release
                              FROM cedec_release
                              
                              WHERE id_release = " . $id_release;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $release = $linha;
            }

            $model = self::$model;
            return array($release, $model);
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Release";
        }
    }

    #################  PAGINACAO  ##################
    /* paginacao */

    public function paginacao($start, $regPorPagina) {
        $con = Conexao::getInstance();

        $stmt = $con->prepare("SELECT cedec_release.id_release,
cedec_release.texto,
cedec_release.data_release
                                FROM cedec_release
                                
                                ORDER By cedec_release.data_release DESC LIMIT $start, $regPorPagina");
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    #################  DELETAR  ##################
    # @ deletar o release

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM cedec_release WHERE id_release = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar Release !";
        }
    }

    /**
     * Lista release
     */
    public function listareleases() {

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

    /*
     *  relatorio release
     */

    public function relRelease() {
        
        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT texto, data_release
                FROM cedec_release
                order by data_release desc";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

}
