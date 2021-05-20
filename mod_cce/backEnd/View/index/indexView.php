<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cce/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<?php
//var_dump($_SESSION);
//Login::logado();
?>
<div class="container">

<div class="col-md-12 text-center">
			<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&modulo=index&controller=index&action=menu"class="btn btn-success">Voltar</a>
		</div>
    <!-- PAGINA -->
    <div class="container">
            <!-- CORPO -->
        <div class="row-fluid">
            <div class="span10">
            <a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=diario">Diário</a><br> <br>  
            <a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=filtroRelDiario">Relatorio Diário</a><br> <br>  
            <a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=boletim">Boletim</a><br> <br>
            <a class="btn btn-primary" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=cce&controller=cce&action=boletimSite">Visualizar Publicação Site</a><br> <br>
            
            
            
                                               
                    

                  
            </div>       
        </div> 
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>