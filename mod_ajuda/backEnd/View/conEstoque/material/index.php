<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_ajuda/Model/indexModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>


<div class="col-md-6">
    
        <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=cad_prod" class="btn btn-primary">Cadastro Produto</a>
<br>
<br>
<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=origem" class="btn btn-primary">Fonte de Entrada</a>

<br>
<br>
<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=cadastro" class="btn btn-primary">Entrada Material</a>

<br>
<br>
<?php

    $loginAcesso = ['m1296844',
                    's149704'
                    ];
    
    
  
    if( ($_COOKIE['seguranca']['tipo'] == "i") && (in_array(strtolower($_COOKIE['seguranca']['login']), $loginAcesso)) ) 
     {
        print "<a href=\"?token=".hash('sha256', md5(VERSAO).date('dmY'))."&ac=itn&modulo=ajuda&controller=conestoque&action=ajuste\" class=\"btn btn-primary\">Ajuste Saldo</a>";
    }
    
?>
<br>
<br>
</div>
    <div class="col-md-6">
        <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=evento" class="btn btn-primary">Evento</a>
    </div>
<br>
<div class="col-md-12 text-center">
    <br>
    <br>
        <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=index"/>Voltar</a>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>