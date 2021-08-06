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


<div class="col-md-4 text-center">
    <p><a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=municipio&action=index" title="Informações dos Município"><img width="80" src='/core/imagem/prefeitura.png' /></a></p>
    <p><label>Cadastro Prefeitura</label></p>
<br><br>
<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=municipio&action=demanda" class="btn btn-primary" title="Dados Gerais do Município">Gerenciar Demanda</a>
</div>
<div class="col-md-4 text-center">
<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=aguadoce&action=index" class="btn btn-primary" title="Manutenção Agua Doce Agora">Água Doce Agora</a>
<br><br>
</div>
<div class="col-md-4 text-center">
<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=cedec&controller=agora&action=index" class="btn btn-primary" title="Manutenção Defesa Civil Agora">Defesa Civil Agora</a>
</div>
<div class="col-md-12 text-center">
    <br>
    <br><br>
    <a class="btn btn-success" href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=index&controller=index&action=menu">Voltar</a>
    
</div>



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>