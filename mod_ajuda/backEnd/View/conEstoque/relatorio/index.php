<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<h4><p class="text-center">Relatorios Gerais</p></h4>
<div class='row'>
    <div class="col-md-3 text-center">
        <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_cad_mat"><img width="100" src='/core/imagem/impressao_icon.png'><br><br><b>ENTRADA DE MATERIAIS</b></a>
        <br>
    </div>
    <div class="col-md-3 text-center">
        <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_liberacao"><img width="100" src='/core/imagem/impressao_icon.png'><br><br><b>LIBERAÇÕES</b></a>
        <br>
    </div>
    <div class="col-md-3 text-center">
        <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=fbusca_pag_mat"><img width="100" src='/core/imagem/impressao_icon.png'><br><br><b>PAGAMENTOS</b></a>
        <br>
    </div>
    <div class="col-md-3 text-center">
        <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=form_busca_invet_libera"><img width="100" src='/core/imagem/impressao_icon.png'><br><br><b>INVENTARIO</b></a>
        <br>
    </div>
</div>
<br>
<br>
<div class='row'>
    <div class="col-md-3 text-center">
        <!-- Prestação de contas -->
        <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=form_prest_contas"><img width="100" src='/core/imagem/impressao_icon.png'><br><br><b>PRESTAÇÃO DE CONTAS</a><br>
    </div>
    <div class="col-md-3 text-center">
        <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=rel_material_tranf"><img width="100" src='/core/imagem/impressao_icon.png'><br><br><b>TRANSFERÊNCIA ENTRE DEPÓSITOS</a><br>
        <br>
    </div>
    <div class="col-md-3 text-center">
        <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action="><img width="100" src='/core/imagem/impressao_icon.png'><br><br><b>RECEB. DE MATERIAIS TRANSFERIDOS</a><br>
        <br>
    </div>
    <div class="col-md-3 text-center">
        <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=busca_resumog" ><img width="100" src='/core/imagem/impressao_icon.png'><br><br><b>RESUMO DE LIBERAÇÕES</a><br>
        <br>
    </div>
</div>
<BR>
<div class='row'>
    <div class="col-md-3 text-center">
        <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=buscamapa"><img width="100" src='/core/imagem/impressao_icon.png'><br><br><b>MAPA ENTREGA MAH</a><br>
        <br>
    </div>

</div>

<div class="col-md-12 text-center">
    <br>
    <a href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=conestoque&action=index" class="btn btn-success">Voltar</a><br>
</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>