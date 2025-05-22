<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";
?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<style>
    .dashboard-button {
        background-color: white;
        border: 0;
        border-radius: 12px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        text-align: left;
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
        padding: 10%;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dashboard-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 0px 16px rgba(0, 0, 0, 0.2);
    }

    .dashboard-button i {
        padding-bottom: 10px;
    }
</style>

<div class="col-md-12 text-center">
    <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "index1") ?>' class='btn btn-primary'>Voltar</a></p>
</div>
<!-- modulos de acesso -->
<div class="col-md-12">
    <?php

    if ($_COOKIE['seguranca']['tipo'] == "e") {
        print "<script>";
        print "window.location.href='" . FuncaoBase::geraLink("index", "index", "menue") . "'";
        print "</script>";
    }

    # MOSTRA MODULOS
    Login::mostraModulos(Login::acessoModulo($pageSession['session']['seguranca']['login']));

    //var_dump(Login::acessoModulo($pageSession['session']['seguranca']['login']));
    ?>


        <div class="col-md-3 text-center" style="height: 200px;">
            <a class="thumbnail dashboard-button" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=rat" ?>" title="Módulo RAT">
                <i class="fa fa-file fa-5x"></i>RAT
            </a>
        </div>
        <div class="col-md-3 text-center" style="height: 200px;">
            <a class="thumbnail dashboard-button" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=vistoria" ?>" title="Relatório de Vistoria/Interdição">
                <i class="fa fa-clipboard fa-5x"></i>Vistoria/Interdição
            </a>
        </div>
        <div class="col-md-3 text-center" style="height: 200px;">
            <a class="thumbnail dashboard-button" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=paebm" ?>" title="Protocolo PaeBM">
                <i class="fa fa-list-alt fa-5x"></i>PAE
            </a>
        </div>
            <div class="col-md-3 text-center" style="height: 200px;">
                <a class="thumbnail dashboard-button" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=compdec" ?>" title="Informações do Compdec">
                    <i class="fa fa-users fa-5x"></i>Informações COMPDEC (CADASTRO)
                </a>
            </div>
        <?php
        # autorização entrada sistema cisterna
        $autorizacao = [
            "M1296844",
            "S126068",
            "X3611403",
            "S106904",
            "M350254",
            "S104069",
            "S100460",
            "M1489596",
            "S165427",
            "S125569",
        ];
        if ((in_array($_COOKIE['seguranca']['login'], $autorizacao)) || ($_COOKIE['seguranca']['idUser'] == 855)) {
            //<!--CISTERNA -->
        ?>
            <div class="col-md-3 text-center" style="height: 200px;">
                <a class="thumbnail dashboard-button" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=cisterna" ?>" title="Projeto Convivência com a Seca">
                    <i class="fa fa-tint fa-5x"></i>Projeto Convivência com a Seca
                </a>
            </div>
        <?php
        } else {
            print "<div class=\"col-md-3 text-center\" style=\"height: 200px;\">";
            print "<img class=\"imgCinza\" src=\"core/imagem/poco.png\" width=\"105\" title=\"Usuario sem Acesso !\">";
            print " <br>Projeto Convivência com a Seca";
            print "</div>";
        }
        ?>
</div>

<!--RAT DESABILITAR -->
<!--<div class="text-center col-md-3" style="height: 190px; ">
            <a class="thumbnail" title="Relatório de Atividades"><img width="155" src="core/imagem/rat_conversao.png"><br />RAT</a>
        </div>-->

<!--RAT-->
<!-- <div class="col-md-3 text-center" style="height:200px<?php ?>">
    <i class="fa fa-exclamation-triangle fa-5x"></i>
    <a class="thumbnail dashboard-button" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=rat" ?>" title="Relatório de Atividades Técnicas">
        <img width="155" src="core/imagem/rat_teste.png">RAT</a>
</div> -->



<!--VISTORIA DESABILITAR -->
<!--    <div class="text-center col-md-3" style="height: 190px;">
        <a class="thumbnail" title="Relatório de Vistoria/Interdição"><img width="135" src="core/imagem/vistoria_conversao.png"><br />Vistoria/Interdição</a>
    </div>-->

</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>