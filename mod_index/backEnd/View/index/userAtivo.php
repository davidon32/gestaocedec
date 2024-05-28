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
    <div class="col-md-6">
        <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "cadastroEmpr") ?>' class='btn btn-success' title="Cadastrar novo acesso de  Empreendedor">Novo Usuário Externo</a></p>
    </div>

    <div class="col-md-6">
        <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "paebmindex") ?>' class='btn btn-primary'>Voltar</a></p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="#" method="POST" name="frmPesquisa" id="frmPesquisa">
            <label>Pesquisa</label><br>
            <input type="text" class="form form-control" name="pesquisa" id="pesquisa"><br>
            <input type="submit" class="btn btn-primary" name="btn" value="Pesquisar">
        </form>
    </div>
</div>

<div class="row">

    
</div>


</div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

$('#pesquisa').mask("999.999.999-99");    

</script>