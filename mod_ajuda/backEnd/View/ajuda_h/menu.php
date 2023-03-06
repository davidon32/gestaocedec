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

<?php

    $ajuda = new H_pedido_pedidajuda_hModel();

    ?>


<div class="">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box" title="Quantidade de Processos em Edição">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Processos em Edição</span>
                    <span class="info-box-number"><h2><?=$ajuda::processosQtd(0)?></h2></span>
                </div>

            </div>

        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box" title="Quantidade de Processos em Fase de Análise">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Processos em Análise</span>
                    <span class="info-box-number"><h2><?=$ajuda::processosQtd(1)?></h2></span>
                </div>

            </div>

        </div>
        
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box" title="Quantidade de Processos Finalizados, com Prestação de contas aprovada">
                <span class="info-box-icon bg-fuchsia-active"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Processos Aguardando Disponibilidade</span>
                    <span class="info-box-number"><h2><?=$ajuda::processosQtd(4)?></h2></span>
                </div>

            </div>

        </div>


        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box" title="Quantidade de Processo em fase de Prestação de Contas">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Processos em Prestação de Contas</span>
                    <span class="info-box-number"><h2><?=$ajuda::processosQtd(6)?></h2></span>
                </div>

            </div>

        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box" title="Quantidade de Processos em Fase de Prestação de Contas">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Processos Esperando Aprov. Prest. de Contas</span>
                    <span class="info-box-number"><h2><?=$ajuda::processosQtd(0)?></h2></span>
                </div>

            </div>

        </div>
        
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box" title="Quantidade de Processos Finalizados, com Prestação de contas aprovada">
                <span class="info-box-icon bg-aqua-active"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Processos Finalizados</span>
                    <span class="info-box-number"><h2><?=$ajuda::processosQtd(9)?></h2></span>
                </div>

            </div>

        </div>
        
        

    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <a class="btn btn-success btn-lg" href='<?= FuncaoBase::geraLink('ajuda', 'h_pedido_index', 'index')?>'> Ir para Processos</a>
        </div>
    </div>


   
</div>


<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {

    });
</script>
