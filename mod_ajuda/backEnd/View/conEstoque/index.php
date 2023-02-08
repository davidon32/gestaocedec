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
  
<div class="col-md-12">

    <?php //if ($_COOKIE['seguranca']['id_deposito'] == "1") { ?>
    <?php if (true) { ?>

   
        <!-- entrada de material -->
        <?php
        Usuario::Acesso('aju_permissao', 'cad_material', 'estoque/entrada.png', '&modulo=ajuda&controller=conestoque&action=material', 'Entrada de Materiais', 'class="col-md-4 text-center"');
        ?>
  
        <!-- Saldo Estoque -->
        <?php
        if (Usuario::getPermissao('aju_permissao', 'rel_saldo_geral')) {
            ?>
            <div class="col-md-4 text-center">
                <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=salindex" title="Saldo Estoque">
                    <img src="/core/imagem/estoque/estoque.png" width="80"><br>
                    Estoque
                </a>
            </div>
            <?php
        } else {
            print '<div class="col-md-4 text-center">';
            print "<img class=\"imgCinza\" src=\"core/imagem/estoque/estoque.png\" width=\"80px\" title=\"Saldo Estoque\">";
            print "<br> Estoque";
            print "</div>";
        }
        ?>

        <!--Liberacao de Materiais -->
        <?php

        if (Usuario::getPermissao('aju_permissao', 'cad_liberacao')) {
            ?>
            <div class="col-md-4 text-center">
                <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxliberacao" title="Liberacao de Materiais">
                    -<img src="/core/imagem/estoque/liberacao.png" width="80px"><br>
                    Liberação
                </a>
            </div>

            <?php
        } else {
            print '<div class="col-md-4 text-center">';
            print "<img class=\"imgCinza\" src=\"core/imagem/estoque/liberacao.png\" width=\"80px\" title=\"Liberacao de Materiais\">";
            print "<br> Liberacao de Materiais";
            print "</div>";
        }
        ?>

        <!--Pagamento -->
        <?php
        if (Usuario::getPermissao('aju_permissao', 'cad_pagamento')) {
            ?> 
            <div class="col-md-4 text-center">
                <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxpagamento" title="Fazer o pagamento de materiais liberados">
                    <img src="/core/imagem/estoque/pagamento.png" width="80px"><br>
                    Pagamento de Materiais
                </a>
            </div>
            <?php
        } else {
            print '<div class="col-md-4 text-center">';
            print "<img class=\"imgCinza\" src=\"core/imagem/estoque/pagamento.png\" width=\"80px\" title=\"Pagamento de Materiais\">";
            print "<br> Pagamento de Materiais";
            print "</div>";
        }
        ?>


        <!--Transferencia de Materiais -->
        <?php
        if (Usuario::getPermissao('aju_permissao', 'cad_transferencia')) {
            ?> 
            <div class="col-md-4 text-center">
                <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxtransf" title="Transferencia de Materiais entre Depositos">
                    <img src="/core/imagem/estoque/transferencia.png" width="80x"><br>
                    Transferencia de Materiais
                </a>
            </div>

            <?php
        } else {
            print '<div class="col-md-4 text-center">';
            print "<img class=\"imgCinza\" src=\"core/imagem/estoque/transferencia.png\" width=\"80px\" title=\"Transferencia de Materiais entre Depositos\">";
            print "<br> Transferencia de Materiais";
            print "</div>";
        }
        ?>

        <!--Transferencia de Materiais -->
        <?php
        if (Usuario::getPermissao('aju_permissao', 'relatorio')) {
            ?> 
            <div class="col-md-4 text-center">
                <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex"" title="Relatorios">
                    <img src="/core/imagem/estoque/relatorios.png" width="80x"><br>
                    Relatorios
                </a>
            </div>
            <?php
        } else {
            print '<div class="col-md-4 text-center">';
            print "<img class=\"imgCinza\" src=\"core/imagem/estoque/relatorios.png\" width=\"80px\" title=\"Relatorios \">";
            print "<br> Relatorios";
            print "</div>";
        }
        ?>


        <div class="col-md-12 text-center">
            <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=index&action=index"" title="Voltar">
                Voltar
            </a>
        </div>
    <?php
    } else {
        print "estoque";
        ?> <br>

        <div class="col-md-4 text-center">
            <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxpagamento" title="Fazer o pagamento de materiais liberador">
                <img src="/core/imagem/estoque/pagamento.png" width="80px"><br>
                Pagamento de Materiais
            </a>
        </div>
        <div class="col-md-4 text-center">
            <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=idxtransf" title="Transferencia de Materiais entre Depositos">
                <img src="/core/imagem/estoque/transferencia.png" width="80x"><br>
                Transferencia de Materiais
            </a>
        </div>
        <div class="col-md-4 text-center">
            <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=relIndex"" title="Relatorios">
                <img src="/core/imagem/estoque/relatorios.png" width="80x"><br>
                Relatorios
            </a>
        </div>
        <div class="col-md-12 text-center">
            <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=index&action=index"" title="Relatorios">
                Voltar
            </a>
        </div>
</div>
<?php } ?>

    <br>
    <!-- =================== RODAPE CORPO ==================== -->
    <?php include_once "template/page/corpoRodape.php"; ?>
    <!-- =================== RODAPE  ======================== -->
    <?php include_once "template/page/rodape.php" ?>
    <?php include_once "template/page/barra_config_template.php"; ?>
    <!-- =============== HEADER HTML PAGE ================= -->
    <?php include_once "template/page/rodapePage.php"; ?>
