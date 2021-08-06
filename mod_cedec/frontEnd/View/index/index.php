<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<a href="?modulo=cedec&controller=municipio&action=buscar" class="btn btn-primary" title="Dados Gerais do Município">Dados Municipio</a>
<br><br>
<a href="?modulo=cedec&controller=aguadoce&action=index" class="btn btn-primary" title="Manutenção Agua Doce Agora">Água Doce Agora</a>
<br><br>
<a href="?modulo=cedec&controller=agora&action=index" class="btn btn-primary" title="Manutenção Defesa Civil Agora">Defesa Civil Agora</a>



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>