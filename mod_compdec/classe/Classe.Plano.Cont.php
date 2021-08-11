<?php

class Plano {

    /**
     * Novo plano de Contingencia 
     */
    public function novoPlano($dados) {
        $ultimoPlano = "";

        $con = Conexao::getInstance();

        $sqlNumPlano = "select max(num_plano) as num_plano from com_plano where id_municipio = " . $dados['id_municipio'];
        $resultNumPlano = $con->query($sqlNumPlano);

        while ($linha = $resultNumPlano->fetch(PDO::FETCH_ASSOC)) {

            $ultimoPlano = $linha;
        }

        if (!isset($ultimoPlano['num_plano'])) {
            $ultimoPlano['num_plano'] = 1;
        } else {
            $ultimoPlano['num_plano'] += 1;
        }

        $sql = "INSERT INTO com_plano (num_plano, id_municipio, dt_criacao)
											VALUES ('" . $ultimoPlano['num_plano'] . "',
													'" . $dados['id_municipio'] . "',
													'" . date(
                        "Y-m-d - h:i:s"
                ) . "')";
        try {

            $result = $con->query($sql);
            //$result->execute();

            return true;
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage());
        }
    }

    /**
     *  Gravar vias de Acesso 
     */
    public function GravarViasAcesso($dados) {
        $con = Conexao::getInstance();

        $sql = "INSERT INTO com_plano_vias_acesso (mun_proximo, acesso, id_plano)
										VALUES ('" . $dados['0'] . "',
												'" . $dados['1'] . "',
												'" . $dados['2'] . "')";
        try {

            $result = $con->query($sql);
            //$result->execute();

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage());
        }
    }

    /**
     *  Busca Registro Gravado 
     * @_municipio 
     */
    public function buscaDuplicidade($dados) {
        $con = Conexao::getInstance();

        $sql = "select mun_proximo,
							 acesso,
							 id_plano
							 from com_plano_vias_acesso
							 where mun_proximo = :mun_proximo and
									 acesso = :acesso and
									 id_plano = :id_plano";
        try {

            $result = $con->prepare($sql);
            $result->bindValue(":mun_proximo", $dados['0']);
            $result->bindValue(":acesso", $dados['1']);
            $result->bindValue(":id_plano", $dados['2']);
            $result->execute();
            $linhas = $result->rowCount();

            if (empty($linhas)) {
                return (int) 0;
            } else {
                return (int) $linhas;
            }
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage());
        }
    }

    /**
     *  ultimo id do Plano de Contingencia
     * 
     */
    public function ultimoID() {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT MAX(id) as id from com_plano";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }

        return $dados['id'];
    }

    /**
     *  mostra as vias de acesso do plano de contigencia
     * 
     */
    public function getViasAcesso($id_plano) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select mun_proximo, acesso from com_plano_vias_acesso where id_plano = :id_plano";

        $result = $con->prepare($sql);

        $result->bindValue(":id_plano", $id_plano);

        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     *  lista Planos (salvos) no sistema
     */
    public function listaPlano($id_municipio) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select file_plano, versao, dt_upload, id, tamanho
                    from com_plano_upload where id_municipio = :id_municipio";

        $result = $con->prepare($sql);
        $result->bindValue(":id_municipio", $id_municipio);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     *  Gravar vias de Acesso 
     */
    public function gravaUpload($dados) {
        $con = Conexao::getInstance();

        $sql = "INSERT INTO com_plano_upload (id_municipio, id_plano, file_plano, versao, dt_upload, tamanho)
										VALUES (:id_municipio,
												:id_plano,
												:filePlano,
												:versao,
												:dt_upload,
                                                                                                :tamanho)";
        try {

            $result = $con->prepare($sql);
            $result->bindValue(":id_municipio", $dados['id_municipio']);
            $result->bindValue(":id_plano", $dados['id_plano']);
            $result->bindValue(":filePlano", $dados['filePlano']);
            $result->bindValue(":versao", $dados['versao']);
            $result->bindValue(":dt_upload", $dados['dt_upload']);
            $result->bindValue(":tamanho", $dados['tamanho_size']);
            $result->execute();

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage());
        }
    }

    /**
     *  Remvover Plano
     */
    public function removerPlano($id_plano) {
        $con = Conexao::getInstance();

        $sql = "Delete from com_plano_upload WHERE id= :id_plano";

        try {

            $result = $con->prepare($sql);
            $result->bindValue(":id_plano", $id_plano);
            $result->execute();

            return true;
        } catch (Exception $e) {

            print FuncaoBase::getError($e->getMessage());
        }
    }

    /**
     *  Visualizar plano Doc
     */
    public function visualizarDoc($id) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "select file_plano from com_plano_upload where id = :id";

        $result = $con->prepare($sql);
        $result->bindValue(":id", $id);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha;
        }

        //var_dump($dados);
        return $dados['file_plano'];
    }

}

?>