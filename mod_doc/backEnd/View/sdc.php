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

<p>Troca de Senha</p>
<p>Clique no nome do Usuario conforme figura abaixo, após clique em perfil :</p>
    <p class=""><img src="anexo/doc/interno/ajuda/senha_perfil/perfil.png"></p>

</li>

    


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>