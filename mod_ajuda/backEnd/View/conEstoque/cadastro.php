<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
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

<div class="col-md-3 text-center">
<a class="btn btn-primary btn-lg  col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "fornecedor", "index")?>">Fornecedor</a>
</div>
<div class="col-md-3 text-center">
<a class="btn btn-primary btn-lg  col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "cunidade", "index")?>">Produto</a>
<p class="col-md-12"></p>
<a class="btn btn-primary col-md-12 " href="<?=FuncaoBase::geraLink("ajuda", "marca", "index")?>">Marca</a>
<p class="col-md-12"></p>
<a class="btn btn-primary col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "categoria", "index")?>">Categoria</a>
<p class="col-md-12"></p>
<a class="btn btn-primary col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "unidade_med", "index")?>">Unidade Medida</a>
<p class="col-md-12"></p>
<a class="btn btn-primary col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "almoxarifado", "index")?>">Armazém</a>
<p class="col-md-12"></p>
<a class="btn btn-primary col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "tp_pedido", "index")?>">Almoxarifado</a>



</div>
<div class="col-md-3 text-center">
<a class="btn btn-primary btn-lg  col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "destinatario", "index")?>">Destinatario</a>
<p class="col-md-12"></p>
<a class="btn btn-primary col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "destinatario_final", "index")?>">Destinatario Final</a>
</div>
<div class="col-md-3 text-center">
<a class="btn btn-primary btn-lg  col-md-12" href="<?=FuncaoBase::geraLink("ajuda", "transportadora", "index")?>">Transportadora</a>
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


