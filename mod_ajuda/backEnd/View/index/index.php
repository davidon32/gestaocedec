<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>

<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>

<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<br>
<!-- <?php
    if($_COOKIE['seguranca']['id_deposito'] == 1){
        Banco::getCampos('aju_permissao');
    }
?> -->

<!-- Pedido Cesta -->
<div class="col-md-2 text-center">
<!--####################### PEDIDO DE AJUDA HUMANITARIO ###########################-->
    <?php   
        $permissao = Usuario::getPermissao('aju_permissao', 'pedido_ajuda');
        if($permissao == "1"){
    ?>
    <a href="#">
        <img src="core/imagem/pedido_cesta.png" width="80px">
        <br>
        Pedido Cesta
        </a>
    <?php }else {
        print  "<img class=\"imgCinza\" src=\"core/imagem/pedido_cesta.png\" width=\"80px\" title=\"Usuario sem Acesso !\">";
        print " <br>Pedido Cesta";
    } ?>
    </div>

    <!-- TDAP -->
    <div class="col-md-2 text-center">
    <!--######################## TDAP ###############################-->
    <?php   
        $permissao = Usuario::getPermissao('aju_permissao', 'tdap');

        if($permissao == "1"){
            print "<a href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=tdap&action=index\" title=\"TDAP QRCode\">";
            print "<img src=\"core/imagem/tdap.png\" width=\"80px\"><br>TDAP</a>";
        }else {
            print "<img class=\"imgCinza\" src=\"core/imagem/tdap.png\" width=\"80px\"  height=\"80px\" title=\"Usuario sem Acesso\">";
            print "<br> TDAP";
        }
    ?>
    </div>

    <!--###################### CONTROLE DE ESTOQUE ##########################-->
    <?php   
        $permissao = Usuario::getPermissao('aju_permissao', 'controle_estoque');
        if($permissao == "1"){
    ?>
    <!-- CONTROLE DE ESTOQUE -->
    <div class="col-md-2 text-center">
        <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=index">
            <img src="core/imagem/controle_estoque.png" width="80px" height="80px">
        <br>
        Controle de Estoque
        </a>
    </div>
    <?php }else {
        //print $permissao;
    } ?>
    
    <!--###################### CONTROLE DE ESTOQUE Novo ##########################-->
    <?php   
        $permissao = Usuario::getPermissao('aju_cpermissao', 'modulo');
        if($permissao == "1"){
    ?>
    <!-- CONTROLE DE ESTOQUE -->
    <div class="col-md-2 text-center">
        <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=indexn">
        <img src="core/imagem/controle_estoque_novo.png" width="80px" height="80px">
        <br>
        Controle de Estoque
        </a>
    </div>
    <?php }else {
        //print $permissao;
    } ?>

    <!--##########################################################################-->
    <br>
    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=index&controller=index&action=menu"" title="Relatorios">
            Voltar
            </a>
    </div>



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>