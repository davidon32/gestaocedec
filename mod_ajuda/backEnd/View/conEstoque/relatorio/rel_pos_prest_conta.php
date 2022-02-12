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
<?php
include_once "template/page/corpoHeader.php";

$_relatorioAjuda = new RelatorioAju();
?>
<style>

    @page {
        size: 21cm 29.7cm;
        margin: 5mm 5mm 5mm 5mm;
    }

    @media print
    {
        * {font-size: 7pt;}
        .imprimir {
            display: none;
        }
        a:link {
            display: none;
        }
    }

    table td {

        font-size: 12px;

    }

    table th {

        white-space: nowrap;
        color: #000000;
        text-align:center;
        background-color: #A4A4A4;
        /*font-weight: bold;*/

    }
    

</style>
<?php
$_dt_inicial = isset($_POST['txtDtInicial']) ? DataMysql::dataForm($_POST['txtDtInicial']) : false;

$_dt_final = isset($_POST['txtDtFinal']) ? DataMysql::dataForm($_POST['txtDtFinal']) : false;

$_id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : false;

$_id_deposito = isset($_POST['id_deposito']) ? $_POST['id_deposito'] : false;

$id_liberacao = isset($_GET['id']) ? $_GET['id'] : false;

$_nivel = $_COOKIE['seguranca']['nivel'];

$id_material = isset($_POST['id_material']) ? $_POST['id_material'] : "";

$totalItem = 0;
$totalEntrada = 0;
$totalLiberacao = 0;
$totalTransferencia = 0;

$entrada = $_relatorioAjuda->EntradaMaterial($_POST);
$transferencia = $_relatorioAjuda->EntradaMaterialTransf($_POST);

print "<p align='center'><a href='" . FuncaoBase::geraLink("ajuda", "relatorio", "form_busca_pos_prest_contas") . "' class='btn btn-primary'>Voltar</a></p>";
print "<br>";
print "<legend>Posição Prestação de Contas Doador/Aquisição de Materais</legend>";
print !empty($_POST['txtDtInicial']) ? "<legend>Pedíodo : " . $_POST['txtDtInicial'] . " a " . $_POST['txtDtFinal'] . "</legend>" : "";

print "<table class='table table-bordered'>";
print "<tr>";
//print "<th>#</th>";
print "<th>Cod. Entrada</th>";
print "<th>Deposito</th>";
print "<th>Material</th>";
print "<th>Total Entrada (+)</th>";
print "<th>Transferência (-)</th>";
print "<th>Total Liberacao (-)</th>";
print "<th>Saldo(=)</th>";

print "</tr>";


foreach ($entrada as $key => $value) {
    $items = Liberacao::getItensLiberacao($value['id_produto']);
    //$totalEntrada += $value['quantidade'];
    $entrada = $value['quantidade'];

    /* tranferencia */
    if (count($transferencia) > 0) {
        foreach ($transferencia as $key => $transf) {
            if ($transf['depDestino'] != $value['depDestino']) {
                $totalTransferencia += $transf['quantidade'];
            }
        }
    }
    /* fim transferencia */

    if (count($items) > 0) {
        foreach ($items as $key => $item) {
            $totalItem += $item['quantidade'];
        }
    }

    $saldo = $value['quantidade'] - $totalTransferencia - $totalItem;

    $cor = " style='color:green' title='Parabéns material está em conformidade com entradas e saidas !'";

    if ($saldo > 0) {
        $cor = " class='sinal' style='color:red; font-style: italic' title='Material faltando baixa !, verifique o saldo ou os registros de lancamentos !' ";

    } elseif ($saldo < 0) {
        $cor = " class='sinal' style='color:orange; font-style: italic; background-color:#610B0B' title='Material Com erro na quantidade de liberacao !, verifique os registros' ";

    }
    print "<tr>";
    //print "<td></td>";
    print "<td" . $cor . ">" . $value['id_produto'] . "</td>";
    print "<td" . $cor. ">" . $value['depDestino'] . "</td>";
    print "<td" . $cor. ">" . $value['codProd'] . " - " . Unidade::PegaNomeId($value['codProd']) . " - " . $value['origem'] . " </td>";
    print "<td" . $cor. "> " . $entrada . "</td>";
    print "<td" . $cor. "> " . $totalTransferencia . "</td>";
    print "<td" . $cor. "> " . $totalItem . "</td>";
    print "<td" . $cor . "> ". $saldo . "</td>";
    print "</tr>";
    $totalItem = 0;
    $totalTransferencia = 0;
}
$totalEntrada = 0;

print "</table>";
?>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function(){
   
    });

</script>

