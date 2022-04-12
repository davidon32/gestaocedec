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
<?php
$_funcaoBase = new FuncaoBase();

?>
<div class="col-md-12 text-center"><a href='<?= FuncaoBase::geraLink("doc", "doc", "index")?>' class='btn btn-success'>Voltar</a></div>
    
<br><br>

<h2><a href='<?= FuncaoBase::geraLink("doc", "doc", "sdc_tr_senha")?>' class="alert" style="text-decoration:none"><img src='core/imagem/help.png' width="25">&nbsp;&nbsp;&nbsp;&nbsp; Troca de Senha Usuário / Dados do Usuários</a></h2>

<h2>
    <?php
        $_funcaoBase->listaArquivoLink('/anexo/doc/interno/usuario', true);
    ?>
    </h2>

<h2><a href='<?= FuncaoBase::geraLink("index", "index", "info")?>' class="alert" style="text-decoration:none"><img src='core/imagem/help.png' width="25">&nbsp;&nbsp;&nbsp;&nbsp; Informaçoes Rápidas</a></h2>
<span></span>

    


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>