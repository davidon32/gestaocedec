<?php

class Associacao {
    #@ combobox associacao

    function ComboAssociacao($_id_associacao = false, $opcoes = null) {

        $dados = array();

        try {

            $con = Conexao::getInstance();

            $sql = "SELECT
    				id_associacao,
    				sigla,
    				nome
    				FROM com_associacao";

            $result = $con->query($sql);

            $result->execute();


            print "<select class=\"form-control\" name=\"sel_associacao\" id=\"sel_associacao\" " . $opcoes . ">";

            if ($_id_associacao == false) {

                print "<option value=\"\">Selecione a Associacao </option>";

                /* */
            } else {


                $sql1 = "SELECT id_associacao,
    								 nome,
    								 sigla
    								 FROM com_associacao
    								 WHERE id_associacao =:id_associacao";

                $result1 = $con->prepare($sql1);

                $result1->bindValue(":id_associacao", $_id_associacao);

                $result1->execute();

                while ($linha1 = $result1->fetch(PDO::FETCH_ASSOC)) {

                    $_option = "<option value=" . utf8_encode($linha1['id_associacao'] . ">" . $linha1['sigla'] . " - " . $linha1['nome']) . "</option>";

                    print $_option;
                }
            }

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                print "<option value=" . $linha['id_associacao'] . ">" . $linha['sigla'] . "-" . utf8_encode($linha['nome']) . "</option>";
            }

            print "</select>";
        } catch (Exception $e) {
            
        }
    }

    

    #@ get sigla/nome Associacao

    function PegaNomeAssociacao($_id_associacao) {

        $dado = '';

        $con = Conexao::getInstance();

        $sql = "SELECT
				sigla,
				nome
				FROM com_associacao
				WHERE id_associacao = :id_associacao";

        $result = $con->prepare($sql);

        $result->bindValue(':id_associacao', $_id_associacao);

        $result->execute();

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $dado = utf8_encode($linha['sigla'] . "-" . $linha['nome']);
        }

        return $dado;
    }

    /**
     * Resumo compdec por associao
     * @return lista quantidade compdec por associacoes
     */
    function qtdCompdecAssociacao() {

        $con = Conexao::getInstance();

        $_dados = array();

        $sql = "SELECT a.id_associacao as id_associacao,
                 a.nome as nome,
                 count(c.id_comdec) as num_compdec
                 FROM com_comdec c
                 INNER JOIN com_associacao a
                 ON c.associacao = a.id_associacao
         		 where c.id_comdec <> '854' 
                 GROUP BY associacao
                 ORDER BY a.nome";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $_dados[] = $linha;
        }
        return $_dados;
    }

}

?>