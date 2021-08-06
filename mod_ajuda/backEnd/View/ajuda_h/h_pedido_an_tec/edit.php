

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
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$secao = isset($_GET['an']) ? $_GET['an'] : "";

$id_pedido = isset($_GET['id']) ? $_GET['id'] : "";

$sigla = 'DRD';
if ($secao == 'analise_drd') {
    $label_secao = 'DRD - Diretoria de Redução de Desastre';
    $sigla_despacho = "DLOG";
} else if ($secao == 'analise_dlog') {
    $label_secao = 'Diretoria de Logistica';
    $sigla_despacho = "CORRD. ADJUNTO";
} else if ($secao == 'analise_cood') {
    $label_secao = 'Coordenadoria Adjunda';
    $sigla_despacho = "Aprovação";
}

?>

<legend>Edição Analise Técnica Parecer : <span style='color:red'><?= $label_secao ?></span></legend>


<form action="<?= FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "edit"); ?>" method="post" accept-charset="utf-8" name="frmH_pedido_an_tec" id="frmH_pedido_an_tec">

    <div class="row">
    <input type="hidden" name='id_analise' id='id_analise' value='<?= $view[0]['id_analise'] ?>'  readonly=readonly >
    
    <input type="hidden" name='id_pedido' id='id_pedido' value='<?= $view[0]['id_pedido'] ?>'  maxlength='-1' required>

    <input type="hidden" name='tramit_parecer' id='tramit_parecer' value='<?= $view[0]['tramit_parecer'] ?>'  maxlength='14' required>

    <input type="hidden" name='id_usuario' id='id_usuario' value='<?= $view[0]['id_usuario'] ?>'  maxlength='-1' required>
    </div>
  
    <div class='col-md-2'>
        <label>Data envio</label>
        <input type="text" class='form form-control' name='data_parecer' id='data_parecer' value='<?= DataMysql::dataVisual($view[0]['data_parecer']) ?>'  maxlength='-1' required>
    </div>
    <div class='col-md-12'>
        <label>Parecer Técnico</label> <span style="color: silver" id='caracteres'></span>
        <textarea class='form form-control' name='parecer' id='parecer' maxlength='65534' required rows="10"><?= $view[0]['parecer'] ?></textarea>
    </div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "index") ?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Atualizar">
    </div>
</form>



<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {

        /* conta os caracteres */
        $("#caracteres").text($("#parecer").val().length+" / 65534 ( Caracteres restantes )");
        $("#parecer").keyup(function(){
            $("#caracteres").text($("#parecer").val().length+" / 65534 ( Caracteres restantes )");
        });






    });
</script>
