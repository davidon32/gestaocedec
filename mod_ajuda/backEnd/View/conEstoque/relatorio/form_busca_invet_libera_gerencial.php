<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php
include_once "template/page/corpoHeader.php";


$_deposito = new Deposito();

$_municipio = new Municipio();

//$unidade = RelatorioAju::itensUnidade();

$unidade = Unidade::ListUnidade();

$eventoModel = new EventoConEstoqueModel;
$eventos = $eventoModel->listaEvento();

$voltar = isset($_GET['voltar']) ? array('voltar' => 'menu') : "";
if ($voltar != "") {
    $url_form = FuncaoBase::geraLink("ajuda", "relatorio", "inventario_gerencial", $voltar);
} else {
    $url_form = FuncaoBase::geraLink("ajuda", "relatorio", "inventario");
}



$id_deposito = $_COOKIE['seguranca']['id_deposito'];
?>

<p class="text-center"><legend>Relat&oacute;rio de Inventário de materiais</legend></p>

<form method="POST" action="<?= $url_form ?>" name="frm_rel_inventario" >
    <div class='row'>
        <div class="col-md-6">
            <label>Dep&oacute;sito Destino:</label>

            <!-- CEDEC -->
            <?php
            if ($_COOKIE['seguranca']['rpm'] != 1) {

                $_deposito->pegaDepositoSelected($id_deposito, false);
            } else {
                $_deposito->pegaDepositoSelected($id_deposito, true);
            }
            ?>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class='row'>
        <div class="col-md-6">
            <br>
            <label>Salto Anterior do dia: </label><span>Posição do saldo <b><i>Anterior</i></b> no dia escolhido</span>
            <input class="form-control" type="text" name="txtDtInicial" id="txtDtInicial" data-mask="99/99/9999" title="Consulta a saldo anterior !" />
        </div>
    </div>


    <!--<div class="col-md-12">
        <br>
        <label>Data Final:</label>
        <input class="form-control" type="text" name="txtDtFinal" id="txtDtFinal" data-mask="99/99/9999" title="Periodo Final de Liberações" required/>
    </div>
    
    <!--<div class="col-md-12">
        <br>
        <label>Munic&iacute;pio:</label>
    <?php $_municipio->PegaMunicipio(); ?>
    </div>-->


    <div class="col-md-12">
        <br>
        <div class="form-group">
            <label for="ckSaldoZerado">Saldo Zerado</label>
            <input type="checkbox" name="ckSaldoZerado" id="ckSaldoZerado">
        </div>

    </div>
    <div class="col-md-12">
        <input class="btn btn-primary" type="submit" name="pesquisar" value="Pesquisar" />

        <?php
        if (isset($_GET['voltar'])) {
            print "<a class=\"btn btn-success imprimir\" href=\"" . FuncaoBase::geraLink('index', 'index', 'index1') . "\">Voltar</a>";
        } else {
            print "<a class=\"btn btn-success imprimir\" href=\"?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex\">Voltar</a>";
        }
        ?>

    </div>

</form>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">

    $("#txtDtInicial").datepicker(
            {dateFormat: 'dd/mm/yy',
                maxDate: "today",
                minDate: "25/01/2022"},
            );
    /*$("#txtDtFinal").datepicker({ dateFormat: 'dd/mm/yy' });*/


    $("#ckListMat").attr("checked", false);
    $("#lista").hide();

    $("#ckListMat").click(function () {

        if ($("#ckListMat").is(":checked")) {

            if ($("#lista").is(":visible")) {

            } else {
                $("#lista").show(700);
            }
            $("#ckListMat").attr("checked", true);
        } else {
            $("#lista").hide(700);
            $("#ckListMat").attr("checked", false);
        }
    })

</script>