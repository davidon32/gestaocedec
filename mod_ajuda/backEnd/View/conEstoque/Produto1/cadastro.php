<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>


<form action="<?=FuncaoBase::geraLink("ajuda", "fornecedor", "gravar");?>" method="post" accept-charset="utf-8" name="frmFornecedor" id="frmFornecedor">
    <div class="col-md-6">
        <label>Nome:</label>
        <input class="col-md-12 form-control" type="text" name="nome" id="nome" value="" required="" maxlength="70">
    </div>
    <div class="col-md-6">
        <label>Cnpj:</label>
        <input  class="col-md-12 form-control" type="text" name="cpfcnpj" id="cpfcnpj" value="" required="" maxlength="20">
    </div>

    <div class="col-md-6">
        <label>Endereço:</label>
        <input  class="col-md-12 form-control" type="text" name="endereco" id="endereco" value="" required="" maxlength="70">
    </div>
    <div class="col-md-6">
        <label>Telefone:</label>
        <input  class="col-md-12 form-control" type="text" name="tel" id="tel" value="" required="" maxlength="20">
    </div>
    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "conestoque", "cadgeral")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar">
    </div>
</form>

<br>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>
        
    $(document).ready(function () {
        $("#frmFornecedor").trigger("reset");   
        

    });
</script>


