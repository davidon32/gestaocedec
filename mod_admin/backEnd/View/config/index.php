<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_admin/Model/admModel.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<?php

// $corpo = "Corpo \n outra linha";
// $assunto = "assunto Teste";
//     var_dump(Email::emailIndividual('demetrio.passos@defesacivil.mg.gov.br', $assunto, $corpo));
//     die();

    ?>
 

    <!-- configuracoes do sistema -->
    <div class="col">
        <a href='<?=FuncaoBase::geraLink("admin","release", "index")?>' class="btn btn-primary">Release</a>
    </div>
    
    <div class="col">
        <a href='#' class="btn btn-primary">Backup Sistema</a>
    </div>

    <div class="col">
        <a href='<?=FuncaoBase::geraLink("admin","adm", "emailteste")?>' class="btn btn-primary">Email</a>
    </div>
    <div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=&modulo=index&controller=index&action=menu">Voltar</a>
</div>


       
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>