<?php include_once PATH.'/core/include.php';?>
<?php include_once "core/Model/indexModel.php";?>
<?php include_once "mod_cedec/Model/Model.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php";?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php";?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php";?>

<div class="col-md-12 text-center">
    <br>
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=index&action=index" class="btn btn-success" title="Lançamento de novo Registro">Voltar</a>

</div>

<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=agora&action=cadadm" class="btn btn-primary" title="Lançamento de novo Registro">Lançamento</a>
<br>
<br>
<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=agora&action=busca" class="btn btn-primary">Buscar / Alterar</a>
<br>
<br>
<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=agora&action=lista" class="btn btn-primary" title="Lista">Visualizar Lista</a>
<br><br>
<br>
<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=agora&action=listasite" class="btn btn-primary" title="Lista Site ">Visualizar Lista Site</a>
<br><br>
<table class="table table-bordered">
    <th>#</th>
    <th>Autor/Data</th>
    <th>Texto</th>
    <th>Status</th>

    <?php 
       
    ?>

</table>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>