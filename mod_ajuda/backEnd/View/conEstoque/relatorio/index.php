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

<h4><p class="text-center">Relatorios Gerais</p></h4>
<div class="col-md-6">
    <br>
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_cad_mat" class="btn btn-info">Entrada de Material</a><br>
    <br>
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_liberacao" class="btn btn-info">Liberações</a><br>
    <br>
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_pag_mat" class="btn btn-info">Pagamentos</a><br>
    <br>
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=form_busca_invet_libera" class="btn btn-info">Inventário</a><br>
    <br>
    <!-- Prestação de contas -->
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=form_prest_contas" class="btn btn-info">Prestaçao de Contas</a><br>
    
    
    <br>
</div>
<div class="col-md-6">
    <br>
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=rel_material_tranf" class="btn btn-info">Transferencias entre Depositos</a><br>
    <br>
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=" class="btn btn-info">Recebimento de Materiais Transferidos</a><br>
    <br>
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=busca_resumog" class="btn btn-info">Resumo Liberação por Municipio</a><br>
    <br>
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=relatorio&action=buscamapa" class="btn btn-info">Mapas</a><br>
    <br>
    
</div>
<div class="col-md-12 text-center">
    <br>
    <a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'));?>&ac=itn&modulo=ajuda&controller=conestoque&action=index" class="btn btn-success">Voltar</a><br>
</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>