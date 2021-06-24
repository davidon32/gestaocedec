<?php

include_once 'Classe.Funcao.Base.php';
include_once 'Classe.PDO.php';
/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 																					*
 * 	Classe para manipulacao de municipios											*
 * 																					*
 * 	Autor: Demetrio da Silva Passos													*
 * 																					*
 * 	Criacao : 01/02/2012															*
 * ********************************************************************************** */

class Decreto  {

    static function getNomeCobrade($id) {

        $dados = array();

        $con = Conexao::getInstance();

        $sql = "SELECT descricao
					FROM dec_cobrade
					WHERE id_cobrade = :id";

        $result = $con->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dados = $linha;
        }

        return $dados['descricao'];
    }

}?>