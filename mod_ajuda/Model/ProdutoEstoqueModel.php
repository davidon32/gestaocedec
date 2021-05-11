<?php

require_once(PATH . '/core/classe/Classe.Data.php');
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 																					*
 * 	Classe para manipulacao de produto Controle Estoque 											*
 * 																					*
 * 	Autor: Demetrio da Silva Passos													*
 * 																					*
 * 	Criacao : 01/09/2020															*
 * ********************************************************************************** */

class ProdutoEstoqueModel extends DataMysql {
    # lista fornecedor

    public function lista($id = null) {

        $con = Conexao::getInstance();

        if (empty($id)) {

            $sql = "SELECT id_unidade,
                                nome,
                                descricao,
                                valor,
                                validade,
                                id_marca,
                                id_categoria,
                                id_almoxarifado,
                                id_fornecedor,
                                id_unidade_med
                            FROM aju_unidade
                            ORDER By nome";
            $result = $con->query($sql);
        } else {

            $sql = "SELECT id_unidade,
                                nome,
                                descricao,
                                valor,
                                validade,
                                id_marca,
                                id_categoria,
                                id_almoxarifado,
                                id_fornecedor,
                                id_unidade_med
                            FROM aju_unidade
                            WHERE id_unidade = :id
                            ORDER By nome";
            $result = $con->prepare($sql);
            $result->bindValue(":id", $id);
            $result->execute();
        }

        try {

            return $result;

        } catch (Exception $e) {
            return $e->getMessage() . "Erro lista registros";
        }
    }

    # @ adiciona a liberacao na tabela 'liberacao' do banco.

    public static function gravar(array $dados) {

        $con = Conexao::getInstance();

        $sql = "INSERT INTO aju_produto (razao,
                                                cpfcnpj,
                                                endereco,
                                                tel)
                                    		      VALUES (:nome,
                                                          :cpfcnpj,
                                                    	  :endereco,
                                                          :tel)";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":nome", $dados['nome']);
            $result->bindValue(":cpfcnpj", $dados['cpfcnpj']);
            $result->bindValue(":endereco", $dados['endereco']);
            $result->bindValue(":tel", $dados['tel']);
            $result->execute();

            Log::GravaLog("Cadastro de fornecedor Estoque: " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    # Atualizar dados fornecedor

    public static function edit(array $dados) {
        
 

        $con = Conexao::getInstance();

        $sql = "UPDATE aju_fornecedor SET razao = :razao,
                                                cpfcnpj = :cpfcnpj,
                                                endereco = :endereco,
                                                tel = :tel
                                                WHERE id_fornecedor = :id";

        try {

            $result = $con->prepare($sql);

            $result->bindValue(":id", $dados['id_fornecedor']);
            $result->bindValue(":razao", $dados['nome']);
            $result->bindValue(":cpfcnpj", $dados['cpfcnpj']);
            $result->bindValue(":endereco", $dados['endereco']);
            $result->bindValue(":tel", $dados['tel']);
            $result->execute();

            Log::GravaLog("Atualizar Cadastro de fornecedor: " . $dados['nome'] . " " . $_COOKIE['seguranca']['login'], "aju_log");

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Fornecedor";
        }
    }

    
    /**
     * View fornecedor
     */
    public static function view($produto_id) {

        $con = Conexao::getInstance();

        $produto = "";

        $sql = "SELECT id_unidade,
                        nome,
                        descricao,
                        valor,
                        validade,
                        id_marca,
                        id_categoria,
                        id_almoxarifado,
                        id_fornecedor,
                        id_unidade_med
                              FROM aju_unidade
                              WHERE id_unidade = " . $produto_id;

        try {

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $produto = $linha;
            }

            return $produto;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro ao inserir Produto";
        }
    }
    
    
    /* paginacao*/
    public function paginacao($start, $regPorPagina){
        $con = Conexao::getInstance();

            $stmt = $con->prepare("SELECT id_unidade,
                                nome,
                                descricao,
                                valor,
                                validade,
                                id_marca,
                                id_categoria,
                                id_almoxarifado,
                                id_fornecedor,
                                id_unidade_med
                            FROM aju_unidade
                            ORDER By nome DESC LIMIT $start, $regPorPagina");
            $stmt->execute();

            $result = $stmt->fetchAll();
            
            return $result;
            
    }

    
    # @ deletar o fornecedor

    public static function delete($id) {

        $con = Conexao::getInstance();

        $sql = "DELETE FROM aju_fornecedor WHERE id_fornecedor = " . $id;

        try {

            $con->query($sql);

            return true;
        } catch (Exception $e) {
            return $e->getMessage() . "Erro Deletar fornecedor !";
        }
    }

    /**
     * Lista Fornecedoress
     */
    public function listaFornecedores() {

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

?>