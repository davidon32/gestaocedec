<?php
include_once PATH . '/core/include.php';
require_once(MODEL_AJUDA_BACKEND . '/AjudaRelatorioModel.php');
require_once(CONTROLLER_AJUDA_BACKEND . '/AjudaRelatorioController.php');
?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php
include_once "template/page/corpoHeader.php";
$_relatorioAjuda = new RelatorioAju();
?>
<style>
    @media print
    {
        a:link {
            display: none;
        }
        * {font-size: 10px;}
        .imprimir {
            display: none;
        }
    }
    table td {
        font-size: 10px;  
    }
</style>
<?php
$dtInicio = isset($_POST['txtDtInicio']) ? DataMysql::dataForm($_POST['txtDtInicio']) : false;
$dtFinal = isset($_POST['txtDtFinal']) ? DataMysql::dataForm($_POST['txtDtFinal']) : false;
$ordem = isset($_POST['rbOrdem']) ? $_POST['rbOrdem'] : false;

$ajudaRelatorioModel = new AjudaRelatorioModel();

$ajudaRelatorioController = new AjudaRelatorioController();

$ajudaRelatorioModel->setDt_inicial($dtInicio);
$ajudaRelatorioModel->setDt_final($dtFinal);
$ajudaRelatorioModel->setOrdem($ordem);

$dados = $ajudaRelatorioController->relatorioCadastroMaterial($ajudaRelatorioModel);
?>
<br>
<div class='text-center'><a class="btn btn-success" href='index.php?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_cad_mat' class="btn">Voltar</a></div>
</br>

<p class="text-center"><legend> Relatório Entrada de Materiais</legend></p>
<h3>Período : <?= DataMysql::dataVisual($dtInicio); ?> à <?= DataMysql::dataVisual($dtFinal); ?><br> Ordenado : <?= ucfirst($ajudaRelatorioController->SwOrder($ordem));?></h3>
<table class="table table-bordered table-condensed">
    <th style='font-size:10px; text-align:center;'>Código</th>
    <th style='font-size:10px; text-align:center;'>Nome</th>
    <th style='font-size:10px; text-align:center;'>Quantidade</th>
    <th style='font-size:10px; text-align:center;'>Origem </th>
    <th style='font-size:10px; text-align:center;'>Depósito Destino</th>
    <th style='font-size:10px; text-align:center;'>Validade</th>
    <th style='font-size:10px; text-align:center;'>Obs</th>
    <th style='font-size:10px; text-align:center;'>Dt.Entrada</th>

    <?php
    $totalRegistro = 0;

    for ($i = 0; $i < count($dados); $i++) {

        $totalRegistro++;
        print "<tr>";
        print "<td style='font-size:10px;'>" . $dados[$i]['id_produto'] . "</td>";
        print "<td style='font-size:10px;'>" . $dados[$i]['nome'] . "</td>";
        print "<td style='font-size:10px;'>" . $dados[$i]['quantidade'] . "</td>";
        print "<td style='font-size:10px;'>" . utf8_encode($dados[$i]['origem']) . "</td>";
        print "<td style='font-size:10px;'>" . $dados[$i]['depDestino'] . "</td>";
        print "<td style='font-size:10px;'>" . DataMysql::dataVisual($dados[$i]['validade']) . "</td>";
        print "<td style='text-align:justify; font-size:10px;'>" . $dados[$i]['obs'] . "</td>";
        print "<td style='font-size:10px;'>" . DataMysql::dataVisual($dados[$i]['dtEntradaSaida']) . "</td>";
        print "</tr>";
    }
    print "<tr><td colspan='6'>&nbsp;</td><td style='text-align:right'>Total Registro</td><td>" . $totalRegistro . "</td></tr>";
    print "</table>";
    ?>



    <!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
    <!-- =================== RODAPE  ======================== -->
    <?php include_once "template/page/rodape.php" ?>
    <?php include_once "template/page/barra_config_template.php"; ?>
    <!-- =============== HEADER HTML PAGE ================= -->
    <?php include_once "template/page/rodapePage.php"; ?>
