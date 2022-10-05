<?php

class Vistoria {

    /**
     * Liberar o link para publicação do termo de interdição
     */
    public static function pubTermo() {

        $dados = isset($_POST) ? $_POST : "";

        $con = Conexao::getInstance();

        $sql = "update com_interdicao set publicacao = :publicacao
                 where id = :id";

        $result = $con->prepare($sql);
        $result->bindValue(':id', $dados['id_interdicao']);
        $result->bindValue(':publicacao', $dados['publicar']);

        return $result->execute();
    }

}
