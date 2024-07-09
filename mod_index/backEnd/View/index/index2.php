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
    ?>


    <?php
    if ($_COOKIE['seguranca']['idUser'] == 1) { ?>
        <!--RAT-->
        <!--        <div class="col-md-3 text-center" style="height: 190px; ">
            <a class="thumbnail" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=rat" ?>" title="Relatório de Atividades"><img width="155" src="core/imagem/rat_teste.png"><br />RAT</a>
        </div>-->
        <!--VISTORIA-->
        <!--        <div class="col-md-3 text-center" style="height: 190px;">
        <a class="thumbnail" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=vistoria" ?>" title="Relatório de Vistoria/Interdição"><img width="135" src="core/imagem/vistoria_interdicao_teste.png"><br />Vistoria/Interdição</a>-->
</div>
<?php } ?>
<!--RAT DESABILITAR -->
<!--<div class="col-md-3 text-center" style="height: 190px; ">
            <a class="thumbnail" title="Relatório de Atividades"><img width="155" src="core/imagem/rat_conversao.png"><br />RAT</a>
        </div>-->

<!--RAT-->
<div class="col-md-3 text-center" style="height:190px">
    <a class="thumbnail" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=rat" ?>" title="Relatório de Atividades Técnicas"><img width="155" src="core/imagem/rat_teste.png"><br />RAT</a>
</div>

<!--VISTORIA-->
<div class="col-md-3 text-center" style="height: 190px;">
    <a class="thumbnail" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=vistoria" ?>" title="Relatório de Vistoria/Interdição"><img width="135" src="core/imagem/vistoria_interdicao_teste.png"><br />Vistoria/Interdição</a>
</div>
<!--VISTORIA DESABILITAR -->
<!--    <div class="col-md-3 text-center" style="height: 190px;">
        <a class="thumbnail" title="Relatório de Vistoria/Interdição"><img width="135" src="core/imagem/vistoria_conversao.png"><br />Vistoria/Interdição</a>
    </div>-->

<?php

if ($_COOKIE['seguranca']['idUser'] == 1) { ?>
    <!--CADASTRO COMPDEC-->
    <div class="col-md-3 text-center" style="height: 190px;">
        <a class="thumbnail" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=compdec" ?>" title="Informações do Compdec"><img width="90" src="core/imagem/comdec.png"><br />Informações COMPDEC</a>
    </div>

<?php } ?>

<div class="col-md-3 text-center">
    <a class="thumbnail" href="?token=<?= hash("sha256", md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=index&controller=index&action=paebmindex" ?>" title="Protocolo PaeBM"><img width="120" src="core/imagem/pae.png"><br />Pae</a>
</div>





</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>