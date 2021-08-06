<?php
include_once "mod_equipe/Model/indexModel.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';
?>
<?php include_once "template/page/headerPageSimples.php"; ?>

<div class="container fix-altura">
    
    <div class="row"><br></div> 
    <div class="row">
        <h3><p class="text-center">:: Atenção ::</p></h3>
        <h4><p class="<?=$classMsg?>" style="padding:15px;"><br><?= $texto; ?><br><br></p></h4>
        <?php
            print FuncaoBase::voltar(false, FuncaoBase::geraLink("index", "index", "index"));
        ?>
    </div>
</div>

<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php
include_once "template/page/rodapePage.php";