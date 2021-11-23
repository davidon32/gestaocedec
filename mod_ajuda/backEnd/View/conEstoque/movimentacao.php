<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<style>
    .icon {
        text-align: center;
        width: 100px;
        padding: 5px;
        display: table-cell;
    }
    .cp{
        margin: auto;
    }
</style>
<div class='text-center'>
<?php
    if (Usuario::getPermissao('aju_cpermissao', 'entrada_nota')) {
?>
    <div class="col-md-2">
        <a class="btn btn-primary btn-lg  col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "entrada_nota", "index")?>">Entrada de Notas</a>
    </div>
<?php
    }
    if (Usuario::getPermissao('aju_cpermissao', 'transferencia')) {
?>
<div class="col-md-2">
    <a class="btn btn-primary btn-lg  col-md-12" title='Transferencia de Materiais entre Armazém' href="<?=FuncaoBase::geraLink("ajuda", "transferencian", "index")?>">Transf. Mat Armazém</a>
</div>
<?php
    }
    if (Usuario::getPermissao('aju_cpermissao', 'pedido')) {
?>
    <div class="col-md-2">
    <a class="btn btn-primary btn-lg col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "pedido", "index")?>">Pedido</a>
    </div>
<?php
    }
    if (Usuario::getPermissao('aju_cpermissao', 'separar')) {
?>
    <div class="col-md-2">
    <a class="btn btn-primary btn-lg  col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "pedido", "separacao")?>">Separação Mercadoria</a>
    </div>
<?php
    }
    if (Usuario::getPermissao('aju_cpermissao', 'montagem_carga')) {
?>
    <div class="col-md-2">
    <a class="btn btn-primary btn-lg  col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "montagem", "index")?>">Montagem de Carga</a>
    </div>
<?php
    }
?>
    
</div>
<div class="col-md-12 text-center">
<br>
    <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "conestoque", "indexn")?>">Voltar</a>
</div>
    
 <br>
    <!-- =================== RODAPE CORPO ==================== -->
    <?php include_once "template/page/corpoRodape.php"; ?>
    <!-- =================== RODAPE  ======================== -->
    <?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
    <!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>

