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
    
    .total {
        font-weight: bolder;
        font-style: italic;
        font-size: 11pt;
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

$saldoLiberacoes = 0;

//var_dump($_POST);

$entrada = $_relatorioAjuda->EntradaMaterial($_POST);
//$transferencia = $_relatorioAjuda->EntradaMaterialTransf($id_material, );
//$correcao = $_relatorioAjuda->EntradaMaterialCorrecaoSaldo($_POST);

print "<p align='center'><a href='" . FuncaoBase::geraLink("ajuda", "relatorio", "form_busca_pos_prest_contas") . "' class='btn btn-primary'>Voltar</a></p>";
print "<br>";
print "<legend>Posição Prestação de Contas Doador/Aquisição de Materais</legend>";
print !empty($_POST['txtDtInicial']) ? "<legend>Pedíodo : " . $_POST['txtDtInicial'] . " a " . $_POST['txtDtFinal'] . "</legend>" : "";

print "<table class='table table-bordered table-striped'>";
print "<tr>";
//print "<th>#</th>";
print "<th>Cod. Entrada</th>";
print "<th>Deposito</th>";
print "<th>Material</th>";
print "<th>Total Entrada (+)</th>";
print "<th>Transferência/Correcao Saldo (-)</th>";
print "<th>Total Liberacao (-)</th>";
print "<th title='Saldo da Entrada Individual'>Saldo Ent.Ind(=)</th>";
#print "<th title='Somatorio Saldo da Entrada Individual'>Somat Saldo(=)</th>";
print "<th title='Este saldo é o saldo apurado com as respctivas entradas e saidas'>Saldo Inventário</th>";

print "</tr>";

$row = "";

$ultimoKey = count($entrada);

$totEntrada = 0; # somatorio de entradas por materia e deposito
$totEntradaTransfCorre = 0; # somatorio de transferencia e correcao de saldo por material e deposito
$totLiberacoes = 0; # somatorio de liberacoes por material e deposito
$totSaldoEntrada = 0; #somatorio saldo das (entradas - transf/correcoes - saidas)

foreach ($entrada as $key => $value) {  
       
    #$rowspan = $_relatorioAjuda->num_entradas($value['codProd'], $value['id_dep_destino']);
    $saldoInventario = $_relatorioAjuda::saldoIndividual($value['codProd'], $value['id_dep_destino']);
    $items = Liberacao::getItensLiberacao($value['id_produto']);
    //$totalEntrada += $value['quantidade'];
    $entrada1 = $value['quantidade'];
    
    $row = $value['depDestino'];
    
    
    /* tranferencia */
    $totalTransferencia = $_relatorioAjuda->TransfereciaTotal($value['id_produto']);
    
    /* correcao saldo */
    $totalCorrecao = (int)$_relatorioAjuda->CorrecaoSaldoTotal($value['id_produto']);

    /* itens saida */
    $totalItensSaida = (int)$_relatorioAjuda->SaidaItemTotal($value['id_produto']);
        
    $quantidade = $value['quantidade'];
    $saldo = $quantidade -$totalItensSaida -$totalTransferencia +$totalCorrecao;
    
    #var_dump("quantidade". $value['quantidade']."<br><hr>");
    #var_dump("total liberado ".$totalItensSaida."<br><hr>");
    #var_dump("transferencia" .$totalTransferencia."<br><hr>");
    #var_dump("correcao" .$totalCorrecao."<br><hr>");
    #var_dump("correcao" .$saldo."<br><hr>");

    $cor = " style='color:green' title='Parabéns material está em conformidade com entradas e saidas !'";

    if ($saldo > 0) {
        $cor = " class='sinal' style='color:red; font-style: italic' title='Material faltando baixa !, verifique o saldo ou os registros de lancamentos !' ";

    } elseif ($saldo < 0) {
        $cor = " class='sinal' style='color:orange; font-style: italic; background-color:#610B0B' title='Material Com erro na quantidade de liberacao !, verifique os registros' ";

    }
    print "<tr>";
    print "<td" . $cor. ">" . $value['id_produto'] . "</td>";
    print "<td" . $cor. ">" . $value['depDestino'] . "</td>";
    print "<td" . $cor. ">" . $value['codProd'] . " - " . Unidade::PegaNomeId($value['codProd']) . " - " . $value['origem'] . " </td>";
    print "<td" . $cor. ">" . $entrada1 . "</td>";
    print "<td" . $cor. ">" . ($totalTransferencia - $totalCorrecao) . "</td>";
    print "<td" . $cor. ">" . $totalItensSaida . "</td>";
    print "<td" . $cor. ">" . $saldo . "</td>";
    print "<td" . $cor. ">" . 0 . "</td>";
    
    $totEntrada += $entrada1;
    $totEntradaTransfCorre += ($totalTransferencia - $totalCorrecao);
    $totLiberacoes += $totalItensSaida;
    $totSaldoEntrada += $saldo;
        
    if($key < ($ultimoKey-1)){
        #<!-- total -->
        if( $row != $entrada[$key+1]['depDestino'] ){
            print "<tr>";
            print "<td colspan='3' class='text-right total'>TOTAL</td>";
            print "<td class='total'>".$totEntrada."</td>";
            print "<td class='total'>".$totEntradaTransfCorre."</td>";
            print "<td class='total'>". $totLiberacoes . "</td>";
            print "<td class='total'>". $totSaldoEntrada . "</td>";
            print "<td class='total'>". $saldoInventario . "</td>";
            print "</tr>";
            $totEntrada = 0;
            $totEntradaTransfCorre = 0;
            $totLiberacoes = 0;
            $totSaldoEntrada = 0;
        }
        
    }

    print "</tr>";
    $totalItem = 0;
    $totalTransferencia = 0;
    
    $row = $value['depDestino'];
    
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

