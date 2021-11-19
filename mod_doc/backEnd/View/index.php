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

<form action="#" method="POST" name="frmBusca" id="">
</form>

<h2><a href="<?=FuncaoBase::geraLink("doc", "doc", "glossario")?>" class="alert" style="text-decoration:none"> 
    <img src='core/imagem/help.png' width="25">&nbsp;&nbsp;&nbsp;&nbsp; Glossário</a></h2>
<br><br>

<h2><a href="<?=FuncaoBase::geraLink("doc", "doc", "sdc")?>" class="alert" style="text-decoration:none"> 
    <img src='core/imagem/help.png' width="25">&nbsp;&nbsp;&nbsp;&nbsp; SDC - Sistema de Defesa Civil</a></h2>
<br><br>
    
<h2><a href="<?=FuncaoBase::geraLink("doc", "doc", "ajudahtml")?>" class="alert" style="text-decoration:none"   >
        <img src='core/imagem/help.png' width="25">&nbsp;&nbsp;&nbsp;&nbsp; Link de Ajuda Geral  <small> ( Email institucional )</small>
    </a></h2>
<br><br>


<h2><a href="<?=FuncaoBase::geraLink("doc", "doc", "ajuda")?>" class="alert" style="text-decoration:none">
        <img src='core/imagem/help.png' width="25">&nbsp;&nbsp;&nbsp;&nbsp;Ajuda Humanitária <small>( PMDA - Plano Municipal de Distribuição de Água Potável )</small>
    </a></h2>
<br><br>
<h2><a href="<?=FuncaoBase::geraLink("doc", "doc", "compdec")?>" class="alert" style="text-decoration:none">
        <img src='core/imagem/help.png' width="25">&nbsp;&nbsp;&nbsp;&nbsp;Cadastro Compdec <small>( Coordenadoria Municipal de Proteção e Defesa Civil )</small>
    </a></h2>
<br><br>
<h2> <a href="<?=FuncaoBase::geraLink("doc", "doc", "drd")?>" class="alert" style="text-decoration:none">
    <img src='core/imagem/help.png' width="25">&nbsp;&nbsp;&nbsp;&nbsp;DRD - Diretoria de Reduçao de Desastres <small>( Uso Plantão CEDEC   )</small>
    </a></h2>
<br><br>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>
