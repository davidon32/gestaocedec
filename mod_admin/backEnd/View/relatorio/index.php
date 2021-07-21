<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_admin/Model/admModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

 
    <div class="col-md-2">
        <a href='<?=FuncaoBase::geraLink("admin","adm", "rel_user")?>' class="btn btn-primary">Relatório Acesso</a>
        <br><br>
        <a href='<?=FuncaoBase::geraLink("admin","adm", "rel_agente")?>' class="btn btn-primary">Lista Agentes Regionais</a>
    </div>
    <div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="<?=FuncaoBase::geraLink("admin","index", "index");?>">Voltar</a>
</div>
       
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>