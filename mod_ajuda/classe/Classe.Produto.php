<?php

/* * *********************************************************************************
 * 	CEDEC-MG - Coordenadoria Estadual de Defesa Civil de Minas Gerais			  	*
 * 																					*
 * 	Classe manipular produtos do estoque										*
 * 																					*
 * 	Autor: Demetrio da Silva Passos													*
 * 																					*
 * 	Criacao : 01/02/2012															*
 * ********************************************************************************** */

class Produto {

    //private $idProd;
    private $nomeProd;

    static function pegaProduto($attr = null) {

        $con = Conexao::getInstance();

        /* faz um select na base e monta um <select> html com a tabela produto */

        $sql = "SELECT u.id_Unidade, u.nome, u.descricao FROM aju_unidade u ORDER BY u.nome";


        $result = $con->query($sql);

        echo "<select class=\"form-control\" name=\"id_produto\" id=\"id_produto\" " . $attr . ">";

        echo "<option value=''>Escolha o Material</option>";

        while ($row = $result->fetch(PDO::FETCH_BOTH)) {
            echo "<option value='" . $row[0] . "'>" . $row[1] . " " . $row[2] . " - " . $row[0] . "</option>";
        }
        echo "</select>";
    }

    static function pegaProdutoCsaldo($id_deposito, $attr = null) {

        $con = Conexao::getInstance();

        $sql = "SELECT u.id_Unidade, u.nome, u.descricao FROM aju_unidade u ORDER BY u.nome";


        $result = $con->query($sql);

        echo "<select class=\"form-control\" name=\"id_produto\" id=\"id_produto\" " . $attr . ">";

        echo "<option value=''>Escolha o Material</option>";

        while ($row = $result->fetch(PDO::FETCH_BOTH)) {
            echo "<option value='" . $row[0] . "'>" . $row[1] . " " . $row[2] . " - " . $row[0] . "</option>";
        }
        echo "</select>";
    }

    static function pegaProdutoEntradaMat($value = false) {

        $con = Conexao::getInstance();

        $sql = "SELECT aju_unidade.id_unidade, aju_unidade.nome, aju_unidade.descricao
                                FROM aju_unidade 
                                WHERE aju_unidade.id_unidade NOT IN (SELECT codProd FROM aju_produto)
                                or aju_unidade.complnota = 1
                                ORDER BY aju_unidade.nome";

        $result = $con->query($sql);

        echo "<select class=\"form-control\" name=\"id_produto\" id=\"id_produto\" >";
        if (!$value) {
            echo "<option value=''>Escolha o Material</option>";
        } else {
            echo "<option value'" . $value . "'>" . $value . " - " . Unidade::PegaNomeId($value) . "</option>";
        }

        while ($row = $result->fetch(PDO::FETCH_BOTH)) {

            echo "<option value='" . $row[0] . "'>" . $row[0] . " - " . $row[1] . " " . $row[2] . "</option>";
        }
        echo "</select>";
    }

    # obtem-se o id do produto baseado no nome 

    static function PegaIdProduto($a) {

        $con = Conexao::getInstance();

        $sql = "SELECT u.id_Unidade, u.nome FROM aju_unidade u WHERE u.nome = '{$a}'";

        $result = $con->query($sql);

        while ($row = $result->fetch(PDO::FETCH_BOTH)) {
            $dados = $row[0];
        }

        return $dados;
    }

    #@ resgata o nome do produto baseado no id

    static function PegaNomeProduto($idProd) {

        $con = Conexao::getInstance();


        $sql = 'SELECT u.nome FROM aju_unidade u WHERE u.id_Unidade = ' . $idProd . '';

        $result = $con->query($sql);

        while ($row = $result->fetch(PDO::FETCH_BOTH)) {
            $dados = $row[0];
        }

        return $dados;
    }

    /* lista autocomplete produto */

    public static function listProdutoAutocomplete() {

        $con = Conexao::getInstance();

        $dados = array();

        $sql = 'SELECT aju_unidade.id_unidade, aju_unidade.nome FROM aju_unidade';

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }
        return $dados;
    }

    /**
     * @example description adicionar entrada no item de liberacao para controle
     * 
     *  */
    public static function ListEntradaSaldo($filtro) {
        
        //var_dump($filtro);
        
        $con = Conexao::getInstance();
        
        $dados = array();
        $sql = "SELECT aju_produto.id_produto,
                aju_produto.codProd,
                aju_produto.quantidade
                FROM aju_produto
                WHERE codProd = {$filtro[0]}
                and aju_produto.cancelado = 0
                AND aju_produto.id_dep_destino = {$filtro[1]}";
        
        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $campos = $linha;
            
            
            $transferencia = Produto::ListEntradaTransf($filtro, $linha['id_produto']);
            $liberacao = Produto::ListItemLiberacao($filtro, $linha['id_produto']);
            $campos['transferencia'] = $transferencia;
            $campos['liberacao'] = $liberacao;
            $campos['saldo'] = $linha['quantidade'] - $transferencia - $liberacao;
            $dados[] = $campos;
        }
        
        return json_encode($dados);
 
    }
    /**
     * @example Pega as transferencias de materiais
     * 
     *  */
    public static function ListEntradaTransf($filtro, $id_entrada) {
        
        $con = Conexao::getInstance();

        $dados = array();
        $sql = "SELECT 
                case when sum(aju_produto.quantidade) is NULL 
                then 0
                else sum(aju_produto.quantidade)
                end AS totTransf
                FROM aju_produto
                WHERE codProd = {$filtro[0]}
                AND aju_produto.id_dep_origem = {$filtro[1]}
                AND aju_produto.id_entrada = {$id_entrada}
                AND aju_produto.origem LIKE 'Transferencia entre Depositos%'";
        
        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha['totTransf'];
        }
        return $dados;
    }
    /**
     * @example item liberacao 
     * 
     *  */
    public static function ListItemLiberacao($filtro, $id_entrada) {
        
        $con = Conexao::getInstance();

        $dados = array();
        $sql = "SELECT case when SUM(aju_item.quantidade) IS null
                then 0
                ELSE sum(aju_item.quantidade)
                END AS totLiberacao
                FROM aju_item
                WHERE aju_item.situacao < 2
                AND aju_item.cod = {$filtro[0]}
                AND aju_item.id_entrada = {$id_entrada}";
                
        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha['totLiberacao'];
        }
        return $dados;
    }

}


/**
 
 *  */

?>