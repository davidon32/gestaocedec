<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_doc/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<div class="panel panel-default">
    <div class="panel-heading"><img src='core/imagem/help.png' width="25"> &nbsp;&nbsp;&nbsp;&nbsp;NOVIDADES E RELEASES DE VERSÕES</div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="glyphicon glyphicon-asterisk"></span><a href="<?= FuncaoBase::geraLink("doc", "doc", "download", array('arquivo' => 'doc/NovasFuncionalidadesSDC.pdf')) ?>" class="alert" style="text-decoration:none">NOVAS FUNCIONALIDADES (03/10/2022)</a>
            </li> 
        </ul>
    </div>
</div>

<!-- AJUDA HUMANITARIA --> 
<div class="panel panel-default">
    <div class="panel-heading"><img src='core/imagem/help.png' width="25"> &nbsp;&nbsp;&nbsp;&nbsp;MÓDULO AJUDA HUMANITÁRIA</div>

    <div class="panel-body">

        <ul class="list-group">
            <li class="list-group-item">
                <span class="glyphicon glyphicon-asterisk"></span><a href="<?= FuncaoBase::geraLink("doc", "doc", "ajuda") ?>" class="alert" style="text-decoration:none">PMDA - PLANO MUNICIPAL DE DISTRIBUIÇÃO DE ÁGUA</a>
            </li>
            <li class="list-group-item">
                <span class="glyphicon glyphicon-asterisk"></span><a href="<?= FuncaoBase::geraLink("doc", "doc", "download", array('arquivo' => 'doc/AJUDA_HUMANITARIA_18.10.2022_v.2_parte1.pdf')) ?>" class="alert" style="text-decoration:none">PEDIDO DE AJUDA HUMANIÁRIA PARTE 1(18/10/2022)</a>
            </li>
            <li class="list-group-item">
                <span class="glyphicon glyphicon-asterisk"></span><a href="" class="alert" style="text-decoration:none">PEDIDO DE AJUDA HUMANIÁRIA - PARTE 2 - PRESTAÇÃO DE CONTAS </a><i class="alert">( EM BREVE )</i>    
            </li>

        </ul>
    </div>
</div>

<!--
<div class="panel panel-default">
    <div class="panel-heading"><img src='core/imagem/help.png' width="25"> &nbsp;&nbsp;&nbsp;&nbsp;MÓDULO AJUDA HUMANITÁRIA</div>
    
    <div class="panel-body">
        
        <ul class="list-group">
            <li class="list-group-item">
                <a href="<?= FuncaoBase::geraLink("doc", "doc", "ajuda") ?>" class="alert" style="text-decoration:none">PMDA - PLANO MUNICIPAL DE DISTRIBUIÇÃO DE ÁGUA</a>
            </li>
            <li class="list-group-item" >
                <a href="<?= FuncaoBase::geraLink("doc", "doc", "download", array('arquivo' => 'doc/AJUDA HUMANITARIA_30.09.2022_parte1.pdf')) ?>" class="alert" id='pedido_ajuda' style="text-decoration:none">PEDIDO DE AJUDA HUMANIÁRIA PARTE 1(03/10/2022)</a>
            </li>
            <li class="list-group-item">
                <a href="" class="alert" style="text-decoration:none">PEDIDO DE AJUDA HUMANIÁRIA - PARTE 2 - PRESTAÇÃO DE CONTAS </a><i class="alert">( EM BREVE )</i>    
            </li>
            
        </ul>
    </div>
</div>-->

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">COMPDEC</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="glyphicon glyphicon-asterisk"></span><a href="<?= FuncaoBase::geraLink("doc", "doc", "compdec") ?>" style="text-decoration:none">
                    &nbsp;&nbsp;&nbsp;&nbsp;MÓDULO COMPDEC ( INFORMAÇÕES COMPDEC )
                </a>
            </li>
             <li class="list-group-item">
                <span class="glyphicon glyphicon-asterisk"></span><a href="<?= FuncaoBase::geraLink("doc", "doc", "plano") ?>" style="text-decoration:none">
                     &nbsp;&nbsp;&nbsp;&nbsp;PLANO DE CONTIGÊNCIA
                </a>
            </li>
        </ul>
    </div>
</div>

<!--<a href="<?= FuncaoBase::geraLink("doc", "doc", "ajuda") ?>" class="alert" style="text-decoration:none">
    <img src='core/imagem/help.png' width="25"> &nbsp;&nbsp;&nbsp;&nbsp;Módulo Ajuda Humanitária ( PMDA )
</a>-->



                <!-- =================== RODAPE CORPO ==================== -->
                <?php include_once "template/page/corpoRodape.php"; ?>
                <!-- =================== RODAPE  ======================== -->
                <?php include_once "template/page/rodape.php" ?>
                <?php include_once "template/page/barra_config_template.php"; ?>
                <!-- =============== HEADER HTML PAGE ================= -->
                <?php include_once "template/page/rodapePage.php"; ?>
