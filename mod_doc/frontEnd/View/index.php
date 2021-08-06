<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_doc/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>
<a href="<?=FuncaoBase::geraLink("doc", "doc", "ajuda")?>" class="alert" style="text-decoration:none">
    <img src='core/imagem/help.png' width="25"> &nbsp;&nbsp;&nbsp;&nbsp;Módulo Ajuda Humanitária ( PMDA )
</a>
<br><br>
<a href="<?=FuncaoBase::geraLink("doc", "doc", "compdec")?>" class="alert" style="text-decoration:none">
    <img src='core/imagem/help.png' width="25"> &nbsp;&nbsp;&nbsp;&nbsp;Módulo Compdec ( Cadastro Compdec )
</a>
<br><br>
<a href="<?=FuncaoBase::geraLink("doc", "doc", "plano")?>" class="alert" style="text-decoration:none">
    <img src='core/imagem/help.png' width="25"> &nbsp;&nbsp;&nbsp;&nbsp;Plano de Contingencia
</a>
<br><br>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
