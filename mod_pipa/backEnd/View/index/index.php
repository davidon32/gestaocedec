<?php include_once "core/Model/indexModel.php" ?>
<?php include_once "mod_pipa/Model/IndexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php
$pmda = new Pmda();
// icone aviso pre cadastro comunidade
$alertaPreCadCom = $pmda->buscaPreCadComun();
$listCom = "";
foreach ($alertaPreCadCom as $value) {
    $listCom .= "* " . $value['nome'] . "\n";
}
?>

<div class="col-md-12 text-right">
    <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=index&controller=index&action=menu" class="btn btn-success">Voltar</a>
    <br>
    <br>
</div>

<div class="col-md-12">
    
    <div class="col-md-6 text-center">
        <a href="<?= FuncaoBase::geraLink("pipa", "pipa", "pmdaindex", array('a'=>'adm'))?>"><img width="80" src='/core/imagem/adm_pmda.png' title='Administração dos PMDA´s'></a><br>PMDA
        <br><br>
        </div>
    </div>


    <!-- =================== RODAPE CORPO ==================== -->
    <?php include_once "template/page/corpoRodape.php"; ?>
    <!-- =================== RODAPE  ======================== -->
    <?php include_once "template/page/rodape.php" ?>
    <?php include_once "template/page/barra_config_template.php"; ?>
    <!-- =============== HEADER HTML PAGE ================= -->
    <?php include_once "template/page/rodapePage.php"; ?>