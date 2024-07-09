<?php

require_once('AppController.php');

/**
 * 
 */
class AjudaRelatorioController extends AppController
{

    public function relResumoLiberacaoDados()
    {

        $con = Conexao::getInstance();

        try {

            $statement = $con->prepare("select Deposito,
                                            sum(if(Mes=01,Quantidade,0)) as Janeiro,
                                            sum(if(Mes=02,Quantidade,0)) as Fevereiro,
                                            sum(if(Mes=03,Quantidade,0)) as Marco,
                                            sum(if(Mes=04,Quantidade,0)) as Abril,
                                            sum(if(Mes=05,Quantidade,0)) as Maio,
                                            sum(if(Mes=06,Quantidade,0)) as Junho,
                                            sum(if(Mes=07,Quantidade,0)) as Julho,
                                            sum(if(Mes=08,Quantidade,0)) as Agosto,
                                            sum(if(Mes=09,Quantidade,0)) as Setembro,
                                            sum(if(Mes=10,Quantidade,0)) as Outubro,
                                            sum(if(Mes=11,Quantidade,0)) as Novembro,
                                            sum(if(Mes=12,Quantidade,0)) as Dezembro
                                            from resumoLiberacao
                                            group by Deposito");

            $statement->execute();

            $linha = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $linha;
            //return print_r($statement);
        } catch (PDOException $e) {

            print $e->getMessage() . "1";
            print "<br><a href='javascript:history.back();'>Voltar</a>";
        }
    }

    /**
     * criar tabela temporaria
     * @param id_material
     * @param dtInicial
     * @param dtFinal
     * 
     */
    public function tabelaAuxiliarResumo(AjudaRelatorioModel $ajudaRelatorioModel)
    {


        $con = Conexao::getInstance();

        try {

            $statement = $con->query("drop temporary table if exists resumoLiberacao;");
            $statement->execute();

            $statement = $con->query("create temporary table if not exists resumoLiberacao as (
                                            select aju_item.id_dep_origem,
                                                     aju_deposito.nome as 'Deposito',
                                                     aju_item.cod as 'id_material',
                                                     aju_unidade.nome as 'Material',
                                                     Case (date_format(dataLibera, '%m')) 
                                                                    WHEN 01 THEN '01'
                                                                    WHEN 02 THEN '02'
                                                                    WHEN 03 THEN '03'
                                                                    WHEN 04 THEN '04'
                                                                    WHEN 05 THEN '05'
                                                                    WHEN 06 THEN '06'
                                                                    WHEN 07 THEN '07'
                                                                    WHEN 08 THEN '08'
                                                                    WHEN 09 THEN '09'
                                                                    WHEN 10 THEN '10'
                                                                    WHEN 11 THEN '11'
                                                                    WHEN 12 THEN '12'   
                                                                    ELSE 'Sem registro'
                                                                    END as 'Mes', sum(quantidade) as 'Quantidade'
                                            from aju_item
                                            inner join aju_deposito
                                            on aju_item.id_dep_origem = aju_deposito.id_deposito
                                            inner join aju_unidade
                                            on aju_item.cod = aju_unidade.id_unidade 
                                            where aju_item.dataLibera >= '" . $ajudaRelatorioModel->getDt_inicial() . "' and aju_item.dataLibera <= '" . $ajudaRelatorioModel->getDt_final() . "'
                                            and aju_item.cod = " . $ajudaRelatorioModel->getMaterial() . "
                                            group by aju_item.cod, aju_item.dataLibera, aju_item.id_dep_origem
                                            order by aju_item.id_dep_origem, aju_item.dataLibera);");

            //$statement->bindValue(':dtInicial', $ajudaRelatorioModel->getDt_inicial(), PDO::PARAM_STR);
            //$statement->bindValue(':dtFinal', $ajudaRelatorioModel->getDt_final(), PDO::PARAM_STR);
            //$statement->bindValue(':id_material', $ajudaRelatorioModel->getMaterial(), PDO::PARAM_STR);

            $statement->execute();

            //$linha = $statement->fetchAll(PDO::FETCH_ASSOC);
            //print_r($statement);  
            return true;
        } catch (PDOException $e) {

            print $e->getMessage();

            print "<br><a href='javascript:history.back();'>Voltar</a>";
            return false;
        }
    }

    /**
     *  Relatorio de Materiais Transferidos 
     *
     * @param dtInicio
     * @param dtFinal
     * @param idDeposito
     * @param idMunicipio
     */
    static function materialTransferencia(AjudaRelatorioModel $ajudaRelatorioModel)
    {

        $con = Conexao::getInstance();

        try {

            $statement = "";

            if ((strlen($ajudaRelatorioModel->getDt_inicial())) <= 10 && (strlen($ajudaRelatorioModel->getDt_final()) <= 10)) {

                $statement = $con->prepare("select aju_transferencia.id_transferencia,
                                                aju_transferencia.dt_transferencia,
                                                aju_transferencia.motorista,
                                                aju_transferencia.veiculo,
                                                aju_transferencia.placa,
                                                aju_transferencia.dt_saida,
                                                aju_transferencia.dt_chegada,
                                                aju_transferencia.id_dep_destino,
                                                aju_transferencia.situacao,
                                                aju_transferencia.responsavel,
                                                aju_transferencia.doc_res,
                                                aju_transferencia.obs,
                                                aju_transferencia.baixa,
                                                aju_transferencia.motivo,
                                                aju_transferencia.id_dep_origem
                                                from aju_transferencia
                                                where aju_transferencia.dt_transferencia >= :dtInicio and aju_transferencia.dt_transferencia <= :dtFinal
                                                order by aju_transferencia.dt_transferencia");
            }

            $statement->bindValue(':dtInicio', $ajudaRelatorioModel->getDt_inicial(), PDO::PARAM_STR);
            $statement->bindValue(':dtFinal', $ajudaRelatorioModel->getDt_final(), PDO::PARAM_STR);

            $statement->execute();

            $linha = $statement->fetchAll(PDO::FETCH_ASSOC);

            // print_r($statement);
            //die();

            return $linha;
        } catch (PDOException $e) {

            print $e->getMessage() . "1";
            print "<br><a href='javascript:history.back();'>Voltar</a>";
        }
    }

    function itemTransferencia(AjudaRelatorioModel $ajudaItemTransferenciaModel)
    {

        $con = Conexao::getInstance();

        try {

            $statement = $con->prepare("select aju_item_transf.id_produto,
                                            aju_unidade.nome,
                                            aju_item_transf.descricao,
                                            aju_item_transf.quantidade
                                            from aju_item_transf
                                            inner join aju_unidade
                                            on aju_item_transf.id_produto = aju_unidade.id_unidade
                                            where id_transferencia = :id_transferencia
                                            order by aju_unidade.nome");

            $statement->bindValue(':id_transferencia', $ajudaItemTransferenciaModel->getId_transferencia(), PDO::PARAM_STR);

            $statement->execute();

            $linha = $statement->fetchAll(PDO::FETCH_ASSOC);

            //return print_r($statement);

            return $linha;
        } catch (PDOException $e) {

            print $e->getMessage() . "1";
            print "<br><a href='javascript:history.back();'>Voltar</a>";
        }
    }

    public static function SwOrder($ordem)
    {

        switch ($ordem) {
            case '0':
                return 'nome';
                break;
            case '1':
                return 'dtEntradaSaida';
                break;
            case '2':
                return 'origem';
                break;
            case '3':
                return 'depDestino';
                break;
            case '4':
                return 'validade';
                break;
            default:

                break;
        }
    }

    function relatorioCadastroMaterial(AjudaRelatorioModel $ajudaRelatorioModel)
    {

        $con = Conexao::getInstance();

        $dt_inicio = $ajudaRelatorioModel->getDt_inicial();
        $dt_final = $ajudaRelatorioModel->getDt_final();
        $material = $ajudaRelatorioModel->getMaterial();
        $deposito1 = $ajudaRelatorioModel->getDeposito();

        $tipo = $ajudaRelatorioModel->getQuantit();

        $filtro = "";
        $filtro .= !empty($dt_inicio)  ? " and aju_produto.dtEntradaSaida >= '" . $dt_inicio . "'" : "";
        $filtro .= !empty($dt_final)   ? " and aju_produto.dtEntradaSaida <= '" . $dt_final . "'"   : "";
        $filtro .= !empty($material)   ? " and aju_produto.nome like '%" . $material . "%'"   : "";
        $filtro .= !empty($deposito1)  ? " and aju_produto.id_dep_destino = '" . $deposito1 . "'" : "";


        if ($tipo == "qtd") {

            $sql = "SELECT aju_unidade.id_unidade,
                             aju_unidade.singular as nome, 
                             SUM(aju_produto.quantidade) as qtd 
                                FROM aju_produto
                                INNER JOIN aju_unidade
                                ON aju_produto.codProd = aju_unidade.id_unidade
                            WHERE aju_produto.cancelado = 0
                            AND aju_produto.origem NOT LIKE \"Transfer%\"" .
                            $filtro . " 
                            GROUP BY aju_unidade.singular
                            ORDER BY aju_unidade.id_unidade";
        } else if ($tipo == "dep") {

            $sql = "SELECT aju_produto.depDestino, 
                            aju_unidade.id_unidade, 
                            aju_unidade.singular as nome, 
                            SUM(aju_produto.quantidade) as qtd 
                            FROM aju_produto
                            INNER JOIN aju_unidade
                            ON aju_produto.codProd = aju_unidade.id_unidade
                            WHERE aju_produto.cancelado = 0 ".
                            $filtro . "
                            GROUP BY aju_unidade.singular, aju_produto.depDestino
                            ORDER BY aju_produto.depDestino, 
                            aju_unidade.NOME";

        }else {
            $sql = "select aju_produto.id_produto,
                                            aju_produto.codProd,
                                            aju_produto.nome,
                                            aju_produto.dtEntradaSaida,
                                            aju_produto.origem,
                                            aju_produto.obs,
                                            aju_produto.quantidade,
                                            aju_produto.depDestino,
                                            aju_produto.validade,
                                            aju_produto.id_entrada,
                                            aju_produto.id_usuario,
                                            aju_produto.cancelado,
                                            aju_produto.nota_fiscal,
                                            aju_unidade.singular as tipo
                                            from aju_produto
                                            inner JOIN aju_unidade
                                            ON aju_produto.codProd = aju_unidade.id_unidade
                                            where aju_produto.id_produto > 0 " .
                $filtro . " order by " . self::SwOrder($ajudaRelatorioModel->getOrdem());
        }

        //var_dump($sql);

        try {



            /* resumo*/
            $sql1 = "select codProd, nome, origem, SUM(quantidade) as qtd from aju_produto
                        where cancelado = 0 and id_produto > 0 {$filtro} GROUP BY codProd";

            /* resumo */
            $statement1 = $con->query($sql1);
            $statement1->execute();
            $linha1 = $statement1->fetchAll(PDO::FETCH_ASSOC);

            $statement = $con->query($sql);
            $statement->execute();

            $linha = $statement->fetchAll(PDO::FETCH_ASSOC);

            return array($linha, $linha1);
        } catch (PDOException $e) {

            print $e->getMessage() . "1";
            print "<br><a href='javascript:history.back();'>Voltar</a>";
        }
    }
}
