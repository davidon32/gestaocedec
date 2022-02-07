<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>  
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<div class="col-md-12 text-center">
    <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "index1")?>' class='btn btn-primary'>Voltar</a></p>
</div>
<div class="col-md-12">

    <div class="col-md-4 text-center">
       
        <p><a href='<?=FuncaoBase::geraLink("ajuda", "relatorio", "form_busca_invet_libera", array('voltar'=>'menu'))?>' title='Saldo de MAH'><img width="45px" src='core/imagem/estoque/estoque.png'>&nbsp Estoque MAH</a></p>
        
    </div>
    <div class="col-md-4 text-center">
        <p><a href='<?=FuncaoBase::geraLink("index", "index", "usuarioCedec")?>' title='Lista de Usuarios do SDC'><img width="45px" src='core/imagem/usuario_cedec.png'>Informações de Usuarios Cedec / Contatos</a></p>
    </div>
    <div class="col-md-4 text-center">
        <p><a href='<?=FuncaoBase::geraLink("index", "index", "usuarioCedec", array("tipo"=>'regional'))?>' title='Lista de Usuario Regionais'><img width="45px" src='core/imagem/usuario_redec.png'>Inf. Usuários Regionais de Defesa Civil / Contatos</a></p>
    </div>
    <div class="col-md-4">-</div>


</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {

    });

</script>