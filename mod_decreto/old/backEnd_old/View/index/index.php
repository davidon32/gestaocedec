<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";
$_funcaoBase = new FuncaoBase();

$decreto = new Decretacao();

?>

<div class="col-md-6">
<a href="??token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=decreto&controller=decreto&action=busca" class="btn btn-primary">Gerenciamento Processos</a>
</div>
<div class="col-md-6">
	<p style="text-align:center;">
		<h4>Resumo de Processos</h4>
	</p>
	<table class="table table-bordered table-striped">
		<tr>
			<th>Resumo</th>
		</tr>
		<tr>
			<td>#</td>
			<td>Nº</td>
			<td>Ano</td>
			<td>Municipio</td>
			<td>Vencimento</td>
			<td>Rec. União</td>
		</tr>
		<?php
		$dados = $decreto->BuscaProcessoDados();
		$num = 1;

		foreach ($dados as $value) {

			$situacao = ($value['stat_rec_uniao'] == 1) ? "Rec. União" : "Não Rec.";

			print "<tr>";
			print "<td>" . $num . "</td>";
			print "<td>" . $value['id_processo'] . "</td>";
			print "<td>" . $value['ano_processo'] . "</td>";
			print "<td>" . $value['id_municipio'] . "</td>";
			print "<td>" . DataMysql::dataVisual($value['data_venc_process']) . "</td>";
			print "<td>" . $situacao . "</td>";
			print "</tr>";
			$num++;
		}
		?>
	</table>
	<table class="table table-bordered table-striped">
		<tr>
			<th>Desastre</th>
			<th>Qtd</th>
		</tr>
		<?php

		$dadosResumo = $decreto->resumoDecreto("2018");

		foreach ($dadosResumo as $value) {
			print "<tr>
										<td>" . substr($decreto->getCobradeId($value['cod_desastre_cobr']), 10) . "</td>
										<td>" . $value['totDesastre'] . "</td>
									</tr>";
		}
		?>

	</table>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>