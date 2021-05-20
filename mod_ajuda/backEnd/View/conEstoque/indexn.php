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

    <?php if ($_COOKIE['seguranca']['id_deposito'] == "1") {


        # Cadastro Principais
        
        if (Usuario::getPermissao('aju_cpermissao', 'cad_principal')) {
            ?>
            <div class="col-md-4 text-center">
                <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=cadgeral" title="Cadastros Principais">
                    <img src="/core/imagem/estoque/padrao_estoque.png" width="80px" height="80px"><br>
                    Cadastros Principais
                </a>
            </div>
            <?php
        } else {
            print '<div class="col-md-4 text-center">';
            print "<img class=\"imgCinza\" src=\"core/imagem/estoque/padrao_estoque.png\" width=\"80px\" title=\"Sem Acesso\">";
            print "<br> Cadastros Principais";
            print "</div>";
        }
        ?>

        <!-- Movimentações-->
        <?php
        if (Usuario::getPermissao('aju_cpermissao', 'movimentacao')) {
            ?>
            <div class="col-md-4 text-center">
                <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=movimentacao" title="Movimentações">
                    <img src="/core/imagem/estoque/padrao_estoque.png" width="80"><br>
                    Movimentações
                </a>
            </div>
            <?php
        } else {
            print '<div class="col-md-4 text-center">';
            print "<img class=\"imgCinza\" src=\"core/imagem/estoque/padrao_estoque.png\" width=\"80px\" title=\"Sem Acesso\">";
            print "<br> Movimentações";
            print "</div>";
        }
        ?>


        <!-- Relatorios -->
        <?php
        if (Usuario::getPermissao('aju_cpermissao', 'relatorios')) {
            ?>
            <div class="col-md-4 text-center">
                <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=relgeral" title="Relatorios">
                    <img src="/core/imagem/estoque/padrao_estoque.png" width="80px"><br>
                    Relatorios
                </a>
            </div>

            <?php
        } else {
            print '<div class="col-md-4 text-center">';
            print "<img class=\"imgCinza\" src=\"core/imagem/estoque/padrao_estoque.png\" width=\"80px\" title=\"Sem Acesso\">";
            print "<br> Relatorios";
            print "</div>";
        }
        ?>
      
        
        <div class="col-md-12 text-center"> <br>
            <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=ajuda&controller=index&action=index"" title="Voltar">
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
