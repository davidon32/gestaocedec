<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_doc/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
//$_funcaoBase = new FuncaoBase();
?>

<section class="content-header">
    <section class="invoice">

        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">
                    Instrução Infraestrutura Cidade Administrativa
                    <small class="pull-right"><?=date('d/m/Y')?></small>
                </h2>
            </div>
        </div>

        <h4>Impressão de Documentos</h4>

        <br>
        <ul class="list-group">
            
            <li class="list-group-item">
                Requisito :
                <ul>
                    <li class="list-group-item"><a href="#" title="Como obter o cracha funcional">Cracha de Identidade Funcional</a></li>
                    <li class="list-group-item">Estar logado no computador.</li>
                </ul>
            </li>
            <li class="list-group-item">
                Nome Impressora : CaPrinter02<br><span>Obs: O usuario somente podera retirar na impressora o documento que foi enviado do computador que está logado<br>
                    enfim o usuario logado na maquina deverá ser o mesmo do cracha</span>
            </li>
            <li class="list-group-item"><a href='#' title="Slide passo a passo">Instrução Impressão</a></li>
            <li class="list-group-item">
                <span>Obs: O usuario somente podera retirar na impressora o documento que foi enviado do computador que está logado<br>
                    enfim o usuario logado na maquina deverá ser o mesmo do cracha</span>
            </li>
        </ul>

    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- /.content-wrapper -->
</section>


<?php
//$_funcaoBase->listaArquivoLink('/anexo/doc/interno/infra');
?>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>

<script>

    $(document).ready(function () {

        //$("div").removeClass("box-body");


    });

</script>