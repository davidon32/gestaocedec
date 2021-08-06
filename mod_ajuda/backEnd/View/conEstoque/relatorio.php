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







<div class="col-md-12 text-center">

    <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "conestoque", "indexn") ?>">Voltar</a>
</div>
<div class="col-md-4">
    <br>
    <div><a href='<?= FuncaoBase::geraLink("ajuda", "relatoriocon", "inventario") ?>' title="Saldo Geral"><img width="25" src="/core/imagem/relatorio.png"> - Inventário</a></div>
</div>
<div class="col-md-4">
    <br>
    <div>
        <a href="<?= FuncaoBase::geraLink("ajuda", "relatoriocon", "pedidos") ?>"><img width="25" src="/core/imagem/relatorio.png"> - Relatórios de Pedidos</a></div>
</div>
<div class="col-md-4">
    <br>
    <div><img width="25" src="/core/imagem/relatorio.png">-</div>
</div>

<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>


