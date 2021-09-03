<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>  
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<div class="col-md-12">

    <div class="col-md-3">
        <li><a href='<?=FuncaoBase::geraLink("index", "index", "usuarioCedec")?>' title='Lista de Usuarios do SDC'>Usuarios Cedec / Contatos</a></li>
        <li><a href='<?=FuncaoBase::geraLink("index", "index", "usuarioCedec", array("tipo"=>'regional'))?>' title='Lista de Usuario Regionais'>Regionais de Defesa Civil / Contatos</a></li>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>


</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {

    });

</script>