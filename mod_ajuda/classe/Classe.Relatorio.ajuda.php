<?php

include_once PATH . '/core/include.php';

class RelatorioAju extends DataMysql
{

    private static $sql;
    private $dados = array();

    /**
     * 
     * #@ saldo geral dos depsitos
     * 
     */
    function SaldoGeral()
    {

        $con = Conexao::getInstance();

        $sql = "SELECT e.id_deposito as 'id_deposito',
						d.nome as 'nomeDeposito',
						e.id_produto as 'id_produto',
						u.nome as 'nomeProduto',
						e.saldo as 'saldo'
						FROM aju_estoque e
						INNER JOIN aju_unidade u
						ON u.id_Unidade = e.id_produto
						INNER JOIN aju_deposito d
						ON d.id_deposito = e.id_deposito
						ORDER BY d.nome";

        $result = $con->query($sql);

        echo "<table border='0'><tr>
				<td bgcolor=\"#CCCCCC\" width=\"100\" align=\"center\">CODIGO</td>
				<td bgcolor=\"#CCCCCC\" width=\"200\" align=\"center\">DEPOSITO</td>
				<td bgcolor=\"#CCCCCC\" width=\"200\" align=\"center\">DESCRICAO</td>
				<td bgcolor=\"#CCCCCC\" width=\"100\" align=\"center\">QUANTIDADE</td>
				<td bgcolor=\"#CCCCCC\" width=\"100\" align=\"center\"></td>";

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            echo "<tr>
					<td width=\"100\" align=\"center\"><label>{$linha['id_deposito']}</label></td>
					<td width=\"200\" align=\"left\"><label>{$linha['nomeDeposito']}</label></td>
					<td width=\"200\" align=\"center\"><label>{$linha['nomeProduto']}</label></td>
					<td width=\"100\" align=\"center\"><label>{$linha['saldo']}</label></td><td><a href=\"?secao=tmat&dep={$linha[1]}&desc={$linha[3]}&id={$linha[0]}\">Transferir</td>
				</tr>";
        }

        echo "</table>";
    }

    /**
     * 
     * 
     * # @ fornece o saldo filtrado por deposito baseado no nome do deposito com opcao de transferencia fitrada por nivel de usuario
     */
    function SaldoDeposito($_id_deposito, $_nivel, $_id_usuario)
    {

        $con = Conexao::getInstance();

        $sql = "SELECT e.id_deposito as 'id_deposito',
							d.nome as 'nomeDeposito',
							e.id_produto as 'id_produto',
							u.nome as 'nomeProduto',
							e.saldo as 'saldo'
							FROM aju_estoque e
							INNER JOIN aju_unidade u
							ON u.id_Unidade = e.id_produto
							INNER JOIN aju_deposito d
							ON d.id_deposito = e.id_deposito
							WHERE e.id_deposito = '{$_id_deposito}'";

        $result = $con->query($sql);

        echo "<table align=\"center\" border='0' class=\"table\">
				<tr>
					<td align=\"center\">DEPOSITO</td>
					<td align=\"center\">DESCRICAO</td>
					<td align=\"center\">QUANTIDADE</td>
				</tr>";

        #@ para nivel 2 administrator ser� disponibilizado a opcao de transferencia de materais
        if (($_nivel == 2) || ($_nivel == 33)) {

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                echo "<tr>
						<td width=\"200\" align=\"left\">{$linha['nomeDeposito']}</td>
						<td width=\"200\" align=\"center\">{$linha['nomeProduto']}</td>
						<td width=\"100\" align=\"center\"><a href=\"?secao=tmat&desc={$linha['nomeProduto']}&dep={$linha['id_produto']}\" title=\"Clique para Transferir Materiais entre Dep&oacute;sitos\">{$linha['saldo']}</a><a href=\"#\">" . TransferenciaMaterial::MarcaTransitoTransferencia($linha['id_produto'], $linha['id_deposito']) . "</a></td>
					</tr>";
            }
            echo "<tr>
						<td style=\"text-align:center\"colspan=\"3\"><a class=\"btn imprimir\"href=\"#\" onclick=\"window.print();\">Imprimir</a>&nbsp;&nbsp;&nbsp;
						</td>
					</tr>";
        } else {
            #@ para nivel usuario sem a opca de transferencia de materiais
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                echo "<tr>
				<td width=\"200\" align=\"left\">{$linha['nomeDeposito']}</td>
				<td width=\"200\" align=\"center\">{$linha['nomeProduto']}</td>
				<td width=\"100\" align=\"center\">{$linha['saldo']}</td>
					</tr>";
            }
            echo "</table>";
        }
    }

    /* relacao de materiais preferencia */

    public function listMateriaisInvent()
    {

        $con = Conexao::getInstance();

        try {
            $dados = "";
            $sql = "SELECT id_unidade FROM aju_unidade 
                    ORDER BY nome REGEXP '^cesta|^agua|^kit higiene|^kit limpeza|^colchao|^telha|^roupa'";


            $con = Conexao::getInstance();

            $result = $con->query($sql);
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

                $dados .= "'" . $linha['id_unidade'] . "', ";
            }

            $dados = substr($dados, 0, -2);


            return $dados;
        } catch (Exception $e) {
        }
    }

    /* INVENTARIO DE MATERIAIS */

    public function inventarioGeral($id_deposito = null)
    {

        try {
            $dados = array();
            $id_unidades = self::listMateriaisInvent();
            //print (self::listMateriaisInvent());


            if (!empty($id_deposito)) {
                $filtro = " where aju_deposito.id_deposito = '{$id_deposito}'";
            } else {
                $filtro = "";
            }

            $sql = "select aju_unidade.id_unidade,
                aju_unidade.nome as produto,
                aju_unidade.descricao,
                aju_unidade.peso,
                aju_unidade.valor,
                aju_unidade.uni_medida,
                aju_deposito.nome as deposito,
                aju_deposito.abreviacao,
                aju_estoque.saldo,
                aju_deposito.id_deposito
                from aju_estoque
                inner join aju_unidade
                on aju_unidade.id_unidade = aju_estoque.id_produto
                inner join aju_deposito
                on aju_deposito.id_deposito = aju_estoque.id_deposito
                " . $filtro . "
                order by field (aju_unidade.id_unidade, " . $id_unidades . ") desc";

            $con = Conexao::getInstance();

            $result = $con->query($sql);
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
        }
    }

    /**
     * INVENTARIO GERENCIAL
     */
    public function inventarioGerencial($id_deposito = "")
    {
        $filtro = "";
        if (!empty($id_deposito)) {
            $sql = "SELECT sum(aju_estoque.saldo) as saldo,
                aju_estoque.id_deposito, 
                aju_unidade.categoria
                FROM aju_estoque
                INNER JOIN aju_unidade
                ON aju_estoque.id_produto = aju_unidade.id_unidade
                INNER JOIN aju_deposito
                ON aju_estoque.id_deposito = aju_deposito.id_deposito
                WHERE aju_estoque.id_deposito = {$id_deposito} 
                AND aju_estoque.saldo <> 0
                GROUP BY aju_unidade.categoria";
        } else {

            $sql = "SELECT sum(aju_estoque.saldo) as saldo,
                aju_unidade.categoria
                FROM aju_estoque
                INNER JOIN aju_unidade
                ON aju_estoque.id_produto = aju_unidade.id_unidade
                AND aju_estoque.saldo <> 0
                GROUP BY aju_unidade.categoria";
        }

        $con = Conexao::getInstance();

        $result = $con->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * INVENTARIO MATERIAIS GERENCIAL
     */
    public function inventarioMateriaisGerencial($id_deposito, $categoria)
    {

        if (empty($id_deposito)) {
            $sql = "SELECT aju_unidade.id_unidade,
                aju_unidade.nome as material,
                aju_estoque.id_deposito,
                aju_unidade.descricao,
                aju_estoque.saldo,
                aju_unidade.categoria,
                aju_unidade.valor,
                aju_unidade.peso
                FROM aju_estoque
                INNER JOIN aju_unidade
                ON aju_estoque.id_produto = aju_unidade.id_unidade
                AND aju_unidade.categoria = '{$categoria}'
                AND aju_estoque.saldo <> 0";
        } else {

            $sql = "SELECT aju_unidade.id_unidade,
                aju_unidade.nome as material,
                aju_unidade.descricao,
                aju_estoque.id_deposito,
                aju_estoque.saldo,
                aju_unidade.categoria,
                aju_unidade.valor,
                aju_unidade.peso,
                aju_deposito.nome
                FROM aju_estoque
                INNER JOIN aju_unidade
                ON aju_estoque.id_produto = aju_unidade.id_unidade
                INNER JOIN aju_deposito
                ON aju_estoque.id_deposito = aju_deposito.id_deposito
                WHERE aju_estoque.id_deposito = '{$id_deposito}'
                AND aju_unidade.categoria = '{$categoria}'
                AND aju_estoque.saldo <> 0";
        }

        $con = Conexao::getInstance();

        $result = $con->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /* INVENTARIO DE MATERIAIS */

    public function inventarioGeralSaldoAnterior($data_saldo, $id_deposito = null)
    {

        try {
            $dados = array();
            $id_unidades = self::listMateriaisInvent();


            if (!empty($id_deposito)) {
                $deposito = " and aju_deposito.id_deposito = '{$id_deposito}'";
            } else {
                $deposito = "";
            }

            $sql = "SELECT aju_estoque_anterior.id_produto as id_unidade,
                aju_unidade.nome as produto,
                aju_unidade.descricao,
                aju_unidade.uni_medida,
                aju_unidade.peso,
                aju_unidade.valor,
                aju_deposito.nome as deposito,
                aju_deposito.abreviacao,
                aju_estoque_anterior.saldo,
                aju_deposito.id_deposito
                FROM aju_estoque_anterior
                INNER JOIN aju_unidade
                ON aju_estoque_anterior.id_produto = aju_unidade.id_unidade
                INNER JOIN aju_deposito
                ON aju_estoque_anterior.id_deposito = aju_deposito.id_deposito
                WHERE aju_estoque_anterior.data_saldo = '" . $data_saldo . "'
                 $deposito
                ORDER BY aju_deposito.id_deposito,
                aju_unidade.nome";

            $con = Conexao::getInstance();

            $result = $con->query($sql);
            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
        }
    }

    /* INVENTARIO DE MATERIAIS COM SALDO ZERADO */

    public function inventarioGeralZerado()
    {
    }

    /**
     * 
     * 
     * conferir o uso para remover
     * 
     */
    /* static function relatorioMaterialTransf1($_id_produto = false, $_id_dep_destino = false, $dt_inicial = false, $dt_final = false){

      if(($_id_dep_destino == false) && ($_id_produto == false) && ($dt_inicial == false) && ($dt_final == false)) {

      FuncaoBase::alert("Pequisa Inválida !");
      FuncaoBase::voltar();


      }elseif(($_id_dep_destino == false) && ($_id_produto == false) && ($dt_inicial != false) && ($dt_final != false)) {

      $filtro = "AND dtTranf > ".$dt_inicial;

      }elseif(($_id_dep_destino != false) && ($_id_produto != false) && ($dt_inicial == false) && ($dt_final == false)) {

      $filtro = "";
      }

      $sql = "SELECT t.id_transferencia as id_transferencia,
      t.dt_transferencia as dt_transferencia,
      t.motorista as motorista,
      t.veiculo as veiculo,
      t.placa as placa,
      t.dt_saida as dt_saida,
      t.dt_chegada as dt_chegada,
      t.id_dep_destino as id_dep_destino,
      t.situacao as situacao,
      i.id_produto as id_produto,
      i.quantidade as quantidade,
      i.descricao as descricao
      FROM aju_transferencia t
      inner join aju_item_transf i
      on t.id_transferencia = i.id_transferencia
      WHERE t.id_dep_destino = ".$_id_dep_destino." AND i.id_produto = ".$_id_produto." ".$filtro;

      $result = mysql_query($sql) or die (mysql_error());

      while ($linha = mysql_fetch_assoc($result)){

      $dados[] = $linha;

      }

      return $dados;
      }
     */

    /**
     * 
     * 
     * conferir o uso para remover
     * 
     */
    static function relatorioMaterialTransfResumoDiario($dt_inicial = false, $dt_final = false, $_id_municipio = null, $_id_deposito = null)
    {

        $filtro = "";

        /* data inicial e final */
        if (($_id_deposito == "") && ($_id_municipio == "") && ($dt_inicial != false) && ($dt_final != false)) {

            $filtro = " WHERE dt_transferencia <= '" . DataMysql::dataForm($dt_inicial) . "' and dt_transferencia >='" . DataMysql::dataForm($dt_final) . "'";
        }

        try {

            $dados = array();

            $con = Conexao::getInstance();

            $sql = "SELECT t.id_transferencia as id_transferencia,
							t.dt_transferencia as dt_transferencia,
							t.motorista as motorista,
							t.veiculo as veiculo,
							t.placa as placa,
							t.dt_saida as dt_saida,
							t.dt_chegada as dt_chegada,
							t.id_dep_origem as id_dep_origem,
							t.id_dep_destino as id_dep_destino,
							t.situacao as situacao,
							i.id_produto as id_produto,
							i.quantidade as quantidade,
							i.descricao as descricao
							FROM aju_transferencia t
							inner join aju_item_transf i
							on t.id_transferencia = i.id_transferencia"
                . $filtro;

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
        }
    }

    /* /**
     * 
     * 
     * #@ relatorio de material em transito  
     */

    /* function RelatorioMaterialTransito($_id_deposito_destino, $_nivel, $_id_usuario){

      if($_nivel != 3) {

      $_id_deposito_destino = Usuario::PegaDeposito();

      }

      } */

    /**
     * 
     * 
     * #@ relatorio de pagamento de materiais 
     */
    static function MaterialPago(
        $_nivel,
        $_dt_inicial = false,
        $_dt_final = false,
        $_municipio = false,
        $_deposito = false,
        $_material = false,
        $getMaterial = false
    ) {

        $data = "";
        $id_municipio = "";
        $id_deposito = "";

        /* adicionar material lista */
        $sql_material_part1 = "";
        $sql_material_part2 = "";

        if ($getMaterial) {
            $sql_material_part1 = ",
                                    aju_item.id_item as codigo_item,
                                    aju_item.cod as codigo_material,
                                    aju_unidade.nome as nome_material,
                                    aju_item.descricao, 
                                    aju_item.quantidade, 
                                    aju_item.evento ";
            $sql_material_part2 = " inner join aju_item
                                    on aju_liberacao.id_liberacao = aju_item.id_liberacao
                                    inner join aju_unidade
                                    on aju_item.cod = aju_unidade.id_unidade ";
        }

        if (!is_null($_dt_inicial) && !is_null($_dt_final)) {
            $data = ' AND aju_pagamento.dtPagto BETWEEN "' . $_dt_inicial . '" AND "' . $_dt_final . '" ';
        }

        if (!is_null($_municipio) > 0) {
            $id_municipio = " AND aju_liberacao.id_municipio =  '" . $_municipio . "' ";
        }

        if (strlen($_deposito) > 0) {
            $id_deposito = " AND aju_liberacao.depDestino = '" . $_deposito . "' ";
        }

        $con = Conexao::getInstance();

        $dados = array();

        $sql = "SELECT aju_pagamento.id_liberacao as id_liberacao,
						aju_pagamento.dataLibera as dataLibera,
						aju_pagamento.dtPagto as dtPagto,
						aju_pagamento.beneficiario as beneficiario,
						aju_pagamento.responsavel as responsavel,
						aju_pagamento.nDocumento as nDocumento,
						aju_pagamento.veiculo as veiculo,
						aju_pagamento.cpf_resp as cpf_resp,
						aju_pagamento.placa as placa,
						aju_pagamento.situacao as situacao,
						aju_pagamento.motivo as motivo,
						aju_liberacao.depDestino as depDestino,
						aju_liberacao.id_municipio as id_municipio,
						aju_pagamento.id_pagamento as id_pagamento
                                                " . $sql_material_part1 . "
							FROM aju_pagamento 
							INNER JOIN aju_liberacao
							ON aju_pagamento.id_liberacao = aju_liberacao.id_liberacao
                                                        " . $sql_material_part2 . "
							WHERE aju_pagamento.id_pagamento > '0' " . $data . $id_municipio . $id_deposito;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * 
     * 
     * #@ relatorio de pagamento de materiais  resimo diario
     */
    static function MaterialPagoResumoDiario($_dt_inicial = false, $_dt_final = false, $_municipio = false, $_deposito = false)
    {

        $data = "";
        $id_municipio = "";
        $id_deposito = "";

        $con = Conexao::getInstance();

        $dados = array();

        /* data inicial e final */
        if ((strlen($_dt_inicial) > 0) && (strlen($_dt_final) > 0)) {
            $data = ' AND aju_pagamento.dtPagto BETWEEN "' . DataMysql::dataForm($_dt_inicial) . '" AND "' . DataMysql::dataForm($_dt_final) . '" ';
        }

        /* deposito */
        if (strlen($_deposito) > 0) {
            $id_deposito = ' AND aju_liberacao.depDestino = "' . $_deposito . '" ';
        }
        /* municipio */
        if (strlen($_municipio) > 0) {
            $municipio = ' AND aju_pagamento.municipio ="' . $_municipio . '" ';
        }

        $sql = "SELECT aju_pagamento.id_liberacao as id_liberacao,
						aju_pagamento.dataLibera as dataLibera,
						aju_pagamento.dtPagto as dtPagto,
						aju_pagamento.beneficiario as beneficiario,
						aju_pagamento.responsavel as responsavel,
						aju_pagamento.nDocumento as nDocumento,
						aju_pagamento.veiculo as veiculo,
						aju_pagamento.cpf_resp as cpf_resp,
						aju_pagamento.placa as placa,
						aju_liberacao.depDestino as depDestino,
						aju_liberacao.id_municipio as id_municipio,
						aju_pagamento.id_pagamento as id_pagamento
							FROM aju_pagamento 
							INNER JOIN aju_liberacao
							ON aju_pagamento.id_liberacao = aju_liberacao.id_liberacao
							WHERE aju_pagamento.id_pagamento > '0' " . $data . $id_municipio . $id_deposito;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * 
     * 
     * #@ relatorio material liberado 
     */
    function MaterialLiberado(
        $_dt_inicial,
        $_dt_final,
        $_id_municipio = false,
        $_dep_destino = false,
        $_evento = false
    ) {

        $con = Conexao::getInstance();

        $filtro = ' WHERE dataLibera between "' . $_dt_inicial . '" and "' . $_dt_final . '"';

        if ($_id_municipio == '') {
            $_id_municipio = false;
        }

        if ($_dep_destino == '') {
            $_dep_destino = false;
        }

        if ($_evento == '') {
            $_evento = false;
        }


        # filtro deposito Origem
        if ($_dep_destino) {
            $filtro .= ' and depDestino =' . $_dep_destino;
        }

        # municipio
        if ($_id_municipio) {
            $filtro .= ' and id_municipio =' . $_id_municipio;
        }

        # evento
        if ($_evento) {
            $filtro .= ' and evento ="' . $_evento . '"';
        }


        // sql somente material liberado sem pagto
        /* $sql1 = 'SELECT id_liberacao, datalibera, id_municipio, id_usuario, depDestino, beneficiario, evento, observacao, dtlimite, situacao, id_user_pgto
          FROM aju_liberacao
          WHERE situacao = 0 '.$filtro. ' limit 100'; */

        $sql1 = 'SELECT id_liberacao,
                datalibera,
                id_municipio,
                id_usuario,
                depDestino,
                beneficiario,
                evento,
                observacao,
                dtlimite,
                situacao,
                id_user_pgto,
                dt_recibo
                FROM aju_liberacao ' . $filtro;


        #@ concatenacao de sql com resultado da escolha 
        $result = $con->query($sql1);

        $total = $result->rowCount();
        $totalPago = 0;
        $totalAberto = 0;
        $totalCancelado = 0;


        print "<div class=\"row text-center\">
            <br><a class=\"btn btn-success\" href=\"?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_liberacao\" title=\"Voltar Página\">Voltar</a>
            <a href=\"#\" class=\"btn btn-info\" onclick=\"window.print();\" title=\"Voltar Página\">Imprimir</a>
            <br><h4>Relatorio de Materiais Liberados</h4>
            </div><br>";
        print "<br>";
        print "<legend>Pedíodo : " . $_POST['txtDtInicial'] . " a " . $_POST['txtDtFinal'] . "</legend>";

        echo "<table border=\"0\" class=\"table table-bordered text-center table-condensed\">";
        echo '<tr>
			<th><x-small><b>NºLib</b></small></th>
			<th><x-small><b>Dt Lib       </b></small></th>
			<th><x-small><b>Dt Recibo       </b></small></th>
			<th><x-small><b>Municipio            </b></small></th>
			<th><x-small><b>Usuario Liberacao </b></small></th>
			<th><x-small><b>Deposito Origem      </b></small></th>
			<th><x-small><b>Beneficiário         </b></small></th>
			<th><x-small><b>Evento               </b></small></th>
			<th><x-small><b>Observacoes          </b></small></th>
			<th><x-small><b>Dt Limite Pgto</b></small></th>
			<th><x-small><b>Sit.             </b></small></th>
			<th><x-small><b>Usuario Pgto </b></small></th>
			<th><x-small><b>Materiais</b></small></th>
			<th><x-small><b>2º Via</b></small></th>
						
			</tr>';

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {

            $totalPago += ($linha['situacao'] == 1) ? 1 : 0;
            $totalAberto += ($linha['situacao'] == 0) ? 1 : 0;
            $totalCancelado += ($linha['situacao'] == 2) ? 1 : 0;

            #@ situacao ser� somente em aberto, 'relatorio de materiais esperando pagamento'
            $situacao = "em Aberto";

            $sql_prod = "SELECT i.id_item, 
                     i.dataLibera,
                     i.id_liberacao,
                     i.descricao,
                     i.quantidade,
                     i.cod,
                     i.id_entrada
                        FROM aju_item i
                            WHERE id_liberacao = {$linha['id_liberacao']}";

            $r_prod = $con->query($sql_prod);

            $background = "";

            switch ($linha['situacao']) {
                case '0':
                    $background = "alert alert-info";
                    break;
                case '1':
                    $background = "alert alert-success";
                    break;
                case '2':
                    $background = "alert alert-warning";
                    break;

                default:
                    $background = "";
                    break;
            }

            print "<tr>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'>" . $linha['id_liberacao'] . "</td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . DataMysql::dataVisual($linha['datalibera']) . "</td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . DataMysql::dataVisual($linha['dt_recibo']) . "</td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . Municipio::PegaNomeMunicipio($linha['id_municipio']) . "</td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . Usuario::getNomeId($linha['id_usuario']) . "</td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . Deposito::PegaNomeDeposito($linha['depDestino']) . "</td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . utf8_encode($linha['beneficiario']) . "</td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . $linha['evento'] . "</td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . utf8_encode($linha['observacao']) . "</td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . DataMysql::dataVisual($linha['dtlimite']) . "</td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . Liberacao::situacaoLib($linha['situacao']) . "<label></td>
						<td style='font-size:11px; border-bottom:0.1em solid;' class='" . $background . "'> " . Usuario::getNomeId($linha['id_user_pgto']) . "</td>
						<td style='font-size:10px; border-bottom:0.1em solid;' class='" . $background . "'>";

            print "<table style='text-align:left' width='100%'>
                            <tr>
                            <td width='150'><small>Nome</small></td>
                            <td><small>Cod.Ent</small>       </td>
                            <td><small>Descr.</small>       </td>
                            <td><small>Qtde</small>       </td>
                            </tr>";

            while ($_prod = $r_prod->fetch(PDO::FETCH_ASSOC)) {


                if(Material::getMaterial1($_prod['id_entrada'])) {
                    $origem_null = Material::getMaterial1($_prod['id_entrada'])['origem'];
                }else {
                    $origem_null = "";
                }

                print "<tr>
								<td style='font-size:10px;text-align:left'><i>" . Produto::PegaNomeProduto($_prod['cod']) . "-" . $origem_null . "</i></td>
								<td style='font-size:10px;text-align:left'>" . $_prod['id_entrada'] . "</td>
								<td style='font-size:10px;text-align:left'>" . $_prod['descricao'] . "</td>
								<td style='font-size:10px;text-align:left'>" . $_prod['quantidade'] . "</td>
							</tr>";
            }

            print "</table>";

            print "</td>";
            print "<td style='font-size:11px; border-bottom:0.1em solid; vertical-align:middle' class=\"imprimir " . $background . "\">
								<a href=\"index.php?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=ajuda&controller=relatorio&action=rel_liberacao_recibo&id=" . $linha['id_liberacao'] . "\" title=\"Segunda Via da Liberação\"><img width='25' src='core/imagem/print.png'></a>
						</td>
						</tr>";
        }
        print "</table>";
        print "<table>";
        print "<tr>";
        print "<td colspan='13'><h4>Total Registros : " . $total . "<h4></td>";
        print "</tr>";
        print "<tr>";
        print "<td colspan='13'><h4>Total Liberações Pagas : " . $totalPago . "<h4></td>";
        print "</tr>";
        print "<tr>";
        print "<td colspan='13'><h4>Total Liberações em Aberto : " . $totalAberto . "<h4></td>";
        print "</tr>";
        print "<tr>";
        print "<td colspan='13'><h4>Total Liberações Canceladas : " . $totalCancelado . "<h4></td>";
        print "</tr>";

        print "</table>";
    }

    /**
     * 
     * 
     * #@ relatorio material liberado 
     */
    function MaterialLiberadoResumoDiario(
        $_dt_inicial = false,
        $_dt_final = false,
        $_id_municipio = false,
        $_dep_destino = false,
        $_evento = false,
        $_todos_liberados = false
    ) {

        if($_todos_liberados == 0){
            $todos_lib = "= 1";
        } else {
            $todos_lib = "< 2";
        }

        $liberacoes = array();

        $con = Conexao::getInstance();

        $filtro = null;

        if ($_dt_inicial == '//') {
            $_dt_inicial = false;
        }

        if ($_dt_final == '//') {
            $_dt_final = false;
        }

        if ($_id_municipio == '') {
            $_id_municipio = false;
        }

        if ($_dep_destino == '') {
            $_dep_destino = false;
        }

        #@ sem filtro 
        if ((!$_dt_inicial) and (!$_dt_final) and (!$_id_municipio) and (!$_dep_destino)) {
            $filtro = '';
        }

        #@ data inicial
        elseif (($_dt_inicial) && (!$_dt_final) && (!$_id_municipio) && (!$_dep_destino)) {
            $filtro = 'and dataLibera > "' . $_dt_inicial . '"';
        }

        #@ data final
        elseif ((!$_dt_inicial) && ($_dt_final) && (!$_id_municipio) && (!$_dep_destino)) {
            $filtro = 'and dataLibera < "' . $_dt_final . '"';
        }

        #@ data inicial e final 
        elseif (($_dt_inicial) && ($_dt_final) && (!$_id_municipio) && (!$_dep_destino)) {
            $filtro = 'and dataLibera between "' . DataMysql::dataForm($_dt_inicial) . '" and "' . DataMysql::dataForm($_dt_final) . '"';
        }

        #@ deposito origem
        elseif ((!$_dt_inicial) && (!$_dt_final) && (!$_id_municipio) && ($_dep_destino)) {
            $filtro = 'and depDestino = ' . $_dep_destino;
        }

        #@ municipio
        elseif ((!$_dt_inicial) && (!$_dt_final) && ($_id_municipio) && (!$_dep_destino)) {
            $filtro = 'and  id_municipio = ' . $_id_municipio;
        }

        if($_evento !='todos') {
            $filtro .= " and aju_liberacao.evento = '".$_evento."' ";
        }

            $filtro .= " and aju_liberacao.situacao ".$todos_lib." ";


        $sql1 = 'SELECT id_liberacao, datalibera,
						 id_municipio, id_usuario,
						 depDestino, beneficiario, 
						 evento, observacao, 
						 dtlimite, situacao, 
						 id_user_pgto
							FROM aju_liberacao 
							where situacao <=1 '
            . $filtro .
            'order by id_municipio';

        #@ concatenacao de sql com resultado da escolha 
        $result = $con->query($sql1);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $sql_prod = "SELECT i.id_item, i.dataLibera, i.id_liberacao, i.descricao, i.quantidade, i.cod FROM aju_item i WHERE id_liberacao = {$linha['id_liberacao']}";
            $r_prod = $con->query($sql_prod);
            $materiais = array();
            while ($_prod = $r_prod->fetch(PDO::FETCH_ASSOC)) {
                $materiais[] = $_prod;
            }
            $liberacoes[] = array($linha, $materiais);
        }


        return $liberacoes;
    }

    /**
     * 
     * 
     * #@  visualizacao de visualizacao de lembrete de liberação 
     */
    function RelatorioVisualizaLiberacao($idLiberacao = false, $depDestino = false)
    {

        $filtro = "";

        if (($idLiberacao != false) && ($depDestino != false)) {

            $filtro = "WHERE situacao = 0 and id_liberacao = " . $idLiberacao;
        } else if (($idLiberacao == false) && ($depDestino != false)) {

            $filtro = "WHERE situacao = 0 AND depDestino = " . $depDestino;
        }

        $sql = "SELECT id_liberacao, datalibera, id_municipio, id_usuario, depDestino, beneficiario, evento, observacao, dtlimite, situacao, id_user_pgto, dt_recibo, hora_libera
			FROM aju_liberacao " . $filtro;
        //print $sql;

        $result = mysql_query($sql) or die(mysql_error() . "Código : 2");

        echo "<div class=\"tab\"><br />";

        echo "<table class=\"table table-bordered\" size=\"5\">
					<tr>
						<td align=\"center\" colspan=\"15\" class=\"titulo\">Relatorio de Material Liberados</td>
					</tr>";

        echo '
					<tr>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Nr Liberacao</td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Dt Liberacao </td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Dt Recibo </td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Municipio</td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Usuario Realizou Lib</td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Deposito Origem</td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Beneficiário</td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Evento</td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Observacoes</td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Data Limite Pagamento</td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Situacao</td>
						<td style="text-align:center; background:#cccccc; font-size:10px;">Usuario Relizou Pgto</td>
					</tr>';

        while ($linha = mysql_fetch_array($result)) {

            #@ situacao ser� somente em aberto, 'relatorio de materiais esperando pagamento'
            $situacao = "em Aberto";

            //var_dump($linha);
            //FuncaoBase::vd($_m);
            print "<tr>
									<td align=\"center\"> $linha[0] </td>
									<td align=\"center\"> " . DataMysql::dataVisual($linha[1]) . "</td>
									<td align=\"center\"> " . DataMysql::dataVisual($linha[12]) . "</td>
									<td align=\"center\"> " . Municipio::PegaNomeMunicipio($linha[2]) . "</td>
									<td align=\"center\"> " . Usuario::getNomeId($linha[3]) . "</td>
									<td align=\"center\"> " . Deposito::PegaNomeDeposito($linha[4]) . " </td>
									<td align=\"center\"> $linha[5] </td>
									<td align=\"center\"> $linha[6] </td>
									<td align=\"center\"> $linha[7] </td>
									<td align=\"center\"> " . DataMysql::dataVisual($linha[8]) . "</td>
									<td align=\"center\"> $situacao </td>
									<td align=\"center\"> " . Usuario::getNomeId($linha['id_user_pgto']) . "</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>";

            $sql_prod = "SELECT i.id_item, i.dataLibera, i.id_liberacao, i.descricao, i.quantidade, i.cod FROM aju_item i WHERE id_liberacao = {$linha[0]}";

            //echo $sql;

            $r_prod = mysql_query($sql_prod) or die(mysql_error() . '<br > Erro ao Listar os Produtos');

            echo "<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
											<td width=\"150\">Nome Produto</td>
											<td>Descricao</td>
											<td>Quantidade</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>";

            while ($_prod = mysql_fetch_array($r_prod)) {


                print "<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>" . Produto::PegaNomeProduto($_prod[5]) . "</td>
												<td>" . $_prod[3] . "</td>
												<td>" . $_prod[4] . "</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												</tr>";
            }



            print "<tr>
									<td colspan=\"11\"></td>
								</tr>
								<tr>
									<td align=\"center\" colspan=\"11\">
										<br />
										<a class=\"btn\" title=\"Segunda Via Liberacao\" href=\"rel.php?secao=compLibera?&id=" . $linha[0] . "\">Segunda Via Liberacao</a>
										<br /><br />
										<button class=\"btn\" title=\"Fechar Janela\" onclick=\"window.close();\">Fechar</a>
									</td>
								</tr>
								<td colspan=\"11\"><hr></td>";
        }
        print "</table></div>";
    }

    /**
     * 
     * 
     * 
     */
    function relCadastroMaterial($filtro, $ordem)
    {

        $dados = array();

        $filtro = ($filtro != "") ? " WHERE dtEntradaSaida ='" . $filtro . "'" : "";

        switch ($ordem) {
            case '0':
                $ordem = "nome";
                break;
            case '1':
                $ordem = "dtEntradaSaida";
                break;
            case '2':
                $ordem = "origem";
                break;
            case '3':
                $ordem = "depDestino";
                break;
            case '4':
                $ordem = "validade";
                break;

            default:
                exit();
                break;
        }

        $sql = "SELECT id_produto,
                        nome,
                        dtEntradaSaida,
                        origem,
                        obs, 
                        quantidade, 
                        depDestino, 
                        validade
                        FROM aju_produto 
                        " . $filtro . "
                        ORDER BY " . $ordem;

        //print $sql;

        $result = mysql_query($sql) or die(mysql_error());

        while ($linha = mysql_fetch_array($result)) {

            $dados[] = $linha;
        }

        return $dados;
    }

    public function resumoLiberacao($post = null)
    {



        $sql = "SELECT *FROM aju_liberacao
					WHERE situacao = 1 
					AND dataLibera BETWEEN dtInicial AND dtFinal";
    }

    /* lista de entrada por Material */

    public static function EntradaMaterial($post)
    {
        $con = Conexao::getInstance();

        $dados = array();

        //$campoData = " AND aju_produto.dtEntradaSaida BETWEEN '" . DataMysql::dataForm($post['txtDtInicial']) . "' AND '" . DataMysql::dataForm($_POST['txtDtFinal']) . "' ";

        $id_material = (!empty($post['id_material'])) ? " AND aju_produto.codProd = '{$post['id_material']}' " : "";

        if (!empty($post['id_deposito'])) {

            if (is_numeric($post['id_deposito'])) {
                $deposito = " AND aju_produto.id_dep_destino = " . $post['id_deposito'] . " ";
            } else {
                $deposito = " AND aju_produto.depDestino = '" . Deposito::PegaNomeDeposito($post['id_deposito']) . "' ";
            }
        } else {
            $deposito = "";
        }

        $sql = "SELECT aju_produto.id_produto,
                        aju_produto.codProd,
			aju_produto.nome,
			aju_produto.dtEntradaSaida,
			aju_produto.origem,
			aju_produto.quantidade,
                        aju_produto.obs,
                        aju_produto.depDestino,
                        aju_produto.id_dep_destino,
                        aju_produto.cancelado
			FROM aju_produto
                            WHERE aju_produto.id_produto > 0
                            AND aju_produto.origem not like 'Correção Manual de Saldo%'
                            AND aju_produto.cancelado = 0
                            {$id_material}{$deposito} 
                                order by aju_produto.codProd, aju_produto.depDestino";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    public static function num_entradas($id_unidade, $id_dep_destino)
    {
        $con = Conexao::getInstance();
        $dados = "";

        $sql = "SELECT COUNT(aju_produto.id_produto) as num_entradas
                FROM aju_produto
                WHERE aju_produto.codProd = '" . $id_unidade . "' 
                and aju_produto.origem not like 'Correção Manual de Saldo%'
                AND aju_produto.id_dep_destino = '" . $id_dep_destino . "'";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha['num_entradas'];
        }

        return $dados;
    }

    /*
     * total de itens liberacao
     *
     */

    public static function SaidaItemTotal($id_entrada)
    {

        $dados = 0;

        $con = Conexao::getInstance();
        $sql = "SELECT case when SUM(QUANTIDADE) IS NULL then 0 ELSE SUM(QUANTIDADE)
                end as quantidade FROM aju_item 
                    WHERE aju_item.situacao <2
                    AND aju_item.id_entrada = " . $id_entrada;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha['quantidade'];
        }

        return $dados;
    }

    /*
     * total de transferencia de materiais
     *
     */

    public static function TransfereciaTotal($id_entrada)
    {

        $dados = "";

        $con = Conexao::getInstance();
        $sql = "SELECT case when SUM(QUANTIDADE) is null then 0 else SUM(QUANTIDADE) 
                END 
                as quantidade FROM aju_produto 
                    WHERE aju_produto.origem LIKE 'Transferência entre Depósitos%'
                    AND id_entrada = " . $id_entrada;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha['quantidade'];
        }

        return $dados;
    }

    /*
     * relatorio no inventario liberações por entrada
     *
     */

    public static function Liberacao($id_entrada)
    {

        $dados = array();

        $con = Conexao::getInstance();
        $sql = "SELECT aju_liberacao.id_liberacao,
                    aju_liberacao.dataLibera,
                    aju_liberacao.id_municipio,
                    aju_liberacao.id_usuario,
                    aju_liberacao.beneficiario,
                    aju_liberacao.evento
                    FROM aju_liberacao
                    WHERE id_liberacao IN (
                    SELECT aju_item.id_liberacao 
                    FROM aju_item
                    WHERE aju_item.id_entrada = " . $id_entrada . ")";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /*
     * relatorio no inventario liberações por entrada
     *
     */

    public static function MaterialLibera($id_liberacao, $id_unidade)
    {

        $dados = "";

        $con = Conexao::getInstance();
        $sql = "SELECT aju_item.quantidade
                FROM aju_item 
                WHERE aju_item.id_liberacao = {$id_liberacao}
                AND aju_item.cod = {$id_unidade}";

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha['quantidade'];
        }

        return $dados;
    }

    /*
     * total de correcao do saldo
     *
     */

    public static function CorrecaoSaldoTotal($id_entrada)
    {

        $dados = "";

        $con = Conexao::getInstance();
        $sql = "SELECT SUM(quantidade) as quantidade FROM aju_produto 
                    WHERE aju_produto.origem LIKE 'Correcao Manual de Saldo%'
                    AND id_entrada = " . $id_entrada;

        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados = $linha['quantidade'];
        }

        return $dados;
    }

    /* lista de entrada por Material */

    public static function EntradaMaterialTransf($codProd, $id_entrada = null)
    {
        $con = Conexao::getInstance();

        $dados = array();

        //$campoData = " AND aju_produto.dtEntradaSaida BETWEEN '" . DataMysql::dataForm($post['txtDtInicial']) . "' AND '" . DataMysql::dataForm($_POST['txtDtFinal']) . "' ";

        $id_material = (!empty($codProd)) ? " AND aju_produto.codProd = '{$codProd}' " : "";

        //$transferencia = (!empty($post['id_deposito'])) ? " AND aju_produto.id_dep_origem = '{$post['id_deposito']}'" : "";
        $id_entrada = (!empty($id_entrada)) ? " AND aju_produto.id_entrada = '{$id_entrada}'" : "";

        $sql = "SELECT aju_produto.id_produto,
                        aju_produto.codProd,
			aju_produto.nome,
			aju_produto.dtEntradaSaida,
			aju_produto.origem,
			aju_produto.quantidade,
                        aju_produto.obs,
                        aju_produto.id_dep_origem,
                        aju_produto.depDestino
			FROM aju_produto
                            WHERE aju_produto.id_produto > 0 {$id_material}{$id_entrada} 
                                and aju_produto.origem like 'Transferencia entre Depositos%'
                                order by aju_produto.dtEntradaSaida";


        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /* lista de entrada por Material */

    public static function EntradaMaterialCorrecaoSaldo($codProd, $id_entrada)
    {
        $con = Conexao::getInstance();

        $dados = array();

        //$campoData = " AND aju_produto.dtEntradaSaida BETWEEN '" . DataMysql::dataForm($post['txtDtInicial']) . "' AND '" . DataMysql::dataForm($_POST['txtDtFinal']) . "' ";

        $id_material = (!empty($codProd)) ? " AND aju_produto.codProd = '{$codProd}' " : "";

        //$transferencia = (!empty($post['id_deposito'])) ? " AND aju_produto.id_dep_origem = '{$post['id_deposito']}'" : "";
        $id_entrada = (!empty($id_entrada)) ? " AND aju_produto.id_entrada = '{$id_entrada}'" : "";

        $sql = "SELECT aju_produto.id_produto,
                        aju_produto.codProd,
			aju_produto.nome,
			aju_produto.dtEntradaSaida,
			aju_produto.origem,
			aju_produto.quantidade,
                        aju_produto.obs,
                        aju_produto.id_dep_origem,
                        aju_produto.depDestino
			FROM aju_produto
                            WHERE aju_produto.id_produto > 0 {$id_material}{$id_entrada} 
                                and aju_produto.origem like 'Correcao Manual de Saldo%'
                                order by aju_produto.dtEntradaSaida";

        //print $sql;
        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     *  lista para conferencia de liberacoes por materiais
     */
    public function RelatorioListaMat($post)
    {

        $con = Conexao::getInstance();

        $dados = array();

        $campoData = "";
        if (!empty($post['txtDtFinal'])) {
            $campoData = " AND aju_item.dataLibera BETWEEN '" . DataMysql::dataForm($_POST['txtDtInicial']) . "' AND '" . DataMysql::dataForm($_POST['txtDtFinal']) . "' ";
        }

        $id_material = (!empty($_POST['id_material'])) ? " AND aju_item.cod = '{$_POST['id_material']}' " : "";

        $deposito = (!empty($_POST['id_deposito'])) ? " AND aju_item.id_dep_origem = '{$_POST['id_deposito']}' " : "";

        $sql = "SELECT aju_item.id_liberacao,
			aju_liberacao.id_municipio,
			aju_liberacao.beneficiario,
			aju_item.cod,
			aju_unidade.nome,
			aju_item.quantidade,
			aju_item.dataLibera,
                        aju_item.id_dep_origem
			FROM aju_item
			INNER JOIN aju_unidade
			ON aju_item.cod = aju_unidade.id_unidade
			INNER JOIN aju_liberacao
			ON aju_item.id_liberacao = aju_liberacao.id_liberacao
			  WHERE aju_item.situacao = '1' {$id_material}{$campoData} {$deposito} 
			  order by aju_item.id_dep_origem, aju_item.dataLibera";

        //var_dump($sql);
        $result = $con->query($sql);

        while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = $linha;
        }

        return $dados;
    }

    /**
     * Itens select unidade
     */
    public static function itensUnidade()
    {

        $dados = array();

        $con = Conexao::getInstance();

        try {
            $sql = "select 	distinct aju_produto.nome,
								aju_produto.origem,
								aju_produto.codProd
								from aju_produto
								order by aju_produto.nome";

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage());
        }
    }

    /* salvar diario controle estoque */

    public static function Diario()
    {
        print "ok";
        include_once('/mod_ajuda/backEnd/View/conEstoque/relatorio/diario.php');
    }

    /**/

    public static function saldoAnterior(array $filtro)
    {
        $dados = array();

        $con = Conexao::getInstance();

        try {
            $sql = "SELECT distinct aju_estoque_anterior.id_produto,
                            aju_estoque_anterior.id_deposito,
                            aju_estoque_anterior.saldo,
                            aju_deposito.nome,
                            aju_unidade.nome
                            FROM aju_estoque_anterior
                            INNER JOIN aju_unidade
                            ON aju_estoque_anterior.id_produto = aju_unidade.id_unidade
                            INNER JOIN aju_deposito
                            on aju_estoque_anterior.id_deposito = aju_deposito.id_deposito
                            WHERE data_saldo = '" . $filtro['data'] . "'
                            AND aju_estoque_anterior.id_deposito = 1
                            AND aju_estoque_anterior.saldo > 0
                            AND aju_unidade.nome REGEXP 'CESTA|"
                . "KIT HIGIENE|"
                . "KIT LIMPEZA|"
                . "LEITE|"
                . "AGUA|"
                . "COLCHAO|"
                . "LONA|"
                . "COBERTOR|"
                . "KIT DORMITORIO {$filtro['material']}'
                                                        order by aju_unidade.nome";

            $result = $con->query($sql);
            //print $sql;

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            return $dados;
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage());
        }
    }

    /* saldo individual de material */

    public static function saldoIndividual($id_produto, $id_deposito)
    {
        $dados = "";

        $con = Conexao::getInstance();

        try {
            $sql = "SELECT saldo 
                    FROM aju_estoque
                    WHERE id_produto = " . $id_produto . " 
                    AND id_deposito = " . $id_deposito . " ";

            $result = $con->query($sql);

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados = $linha['saldo'];
            }

            return $dados;
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage());
        }
    }


    public function MaterialLiberadoListagem($post)
    {
        try {

        $dados = array();

        $con = Conexao::getInstance();

        $data_inicio    = !empty($post["txtDtInicial"]) ? DataMysql::dataForm($post["txtDtInicial"])   : "";
        $data_final     = !empty($post["txtDtFinal"])   ? DataMysql::dataForm($post["txtDtFinal"])     : "";

        $filtro_deposito  = !empty($post["id_deposito"])  ? " AND aju_deposito.id_deposito = '{$post["id_deposito"]}' " : "";
        $filtro_data      = (!empty($data_inicio) && !empty($data_final)) ? " AND aju_item.dataLibera BETWEEN '{$data_inicio}' AND '{$data_final}' " : "";
        $filtro_municipio = !empty($post["id_municipio"]) ? " AND aju_liberacao.id_municipio = '{$post["id_municipio"]}' " : "";
        $filtro_evento    = !empty($post["selEvento"])    ? " AND aju_liberacao.evento = '{$post["selEvento"]}' " : "";
        $filtro_regiao    = !empty($post["selRegiao"])    ? " AND cedec_rpm_mun.id_rpm = '{$post["selRegiao"]}' " : "";
        $filtro_material  = !empty($post["id_material"])  ? " AND aju_item.cod = '{$post["id_material"]}' " : "";

        
        switch ($post['rbOrdem']) {
            case '1': # id_liberacao
                $ordem = " ORDER BY aju_liberacao.id_liberacao";
                break;
            case '2': # origem
                $ordem = " ORDER BY aju_liberacao.origem";
                break;
            case '3': #4 dep origem
                $ordem = " ORDER BY aju_deposito.nome";
                break;
            case '4': # regiao DC 
                $ordem = " ORDER BY cedec_rpm_mun.nome_rdc";
                break;
            
            default: # id_liberacao
                $ordem = " ORDER BY aju_liberacao.id_liberacao";
                break;
        }

        $ordem = " ORDER BY aju_liberacao.id_liberacao";

            $sql = "SELECT aju_liberacao.id_liberacao, aju_liberacao.id_municipio,
                        aju_item.dataLibera, aju_item.id_liberacao, aju_item.descricao, aju_item.quantidade, aju_item.id_entrada, aju_item.cod, aju_item.evento,
                        aju_unidade.singular,
                        aju_deposito.nome AS deposito_origem,
                        cedec_municipio.nome AS municipio,
                        cedec_rpm_mun.nome_rdc,
                        cedec_rpm_mun.id_rpm
                        FROM aju_liberacao
                        inner join aju_item
                        ON aju_liberacao.id_liberacao = aju_item.id_liberacao
                        INNER JOIN aju_unidade
                        ON aju_item.cod = aju_unidade.id_unidade
                        INNER JOIN aju_deposito
                        ON aju_item.id_dep_origem = aju_deposito.id_deposito
                        INNER JOIN cedec_rpm_mun
                        ON aju_deposito.id_rpm = cedec_rpm_mun.id_rpm
                        INNER JOIN cedec_municipio
                        ON aju_liberacao.id_municipio = cedec_municipio.id_municipio
                        WHERE aju_item.situacao < 2 " .
                $filtro_deposito .
                $filtro_data .
                $filtro_municipio .
                $filtro_evento .
                $filtro_regiao .
                $filtro_material .
                $ordem . "";


            $result = $con->query($sql);

            //print $sql;

            while ($linha = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $linha;
            }

            

            return $dados;
        } catch (Exception $e) {
            print FuncaoBase::getError($e->getMessage());
        }
    }
}
