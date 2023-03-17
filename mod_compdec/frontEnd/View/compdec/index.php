<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_compdec/Model/Model.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menuExterno.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<div class="col-md-12 text-center">
    <a class="btn btn-success" href="<?= FuncaoBase::geraLink("index", "index", "menue")?>">Voltar</a>
    </br></br>
</div>


<div class="col-md-12">
    <div class="col-md-4 text-center">
        <a href='<?=FuncaoBase::geraLink('compdec', 'compdec', 'compdec')?>'><img class='card' src='core/imagem/compdec1.png' width="100"><br><br>Cadastro Compdec</a>
    </div>
    
    <div class="col-md-4 text-center">
        <a href='<?=FuncaoBase::geraLink('compdec', 'vistoria', 'index')?>' title='Laudo de Vistoria'><img src='core/imagem/vistoria1.png' width="105"><br><br>Termo de Vistoria</a>
    </div>
    <div class="col-md-4 text-center">
        <a href='<?=FuncaoBase::geraLink('compdec', 'interdicao', 'index')?>'><img src='core/imagem/interdicao.png' width="100"><br><br>Termo de Interdição</a>
    </div>
    
    
</div>








<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>