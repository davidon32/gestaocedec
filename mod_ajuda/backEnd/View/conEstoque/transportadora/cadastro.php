

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

<?php



?>

<legend>Cadastro de Transportadora</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "transportadora", "gravar");?>" method="post" accept-charset="utf-8" name="frmTransportadora" id="frmTransportadora">
    
    <div class='col-md-6'>
<label>Nome Transportadora</label>
<input type="text" class='form form-control' name='nome' id='nome' maxlength='99' required >
</div>
<div class='col-md-6'>
<label>Cnpj Transportadora</label>
<input type="text" class='form form-control' name='cnpj' id='cnpj' maxlength='44' required data-mask="99.999.999/9999-99">
</div>
<div class='col-md-6'>
<label>Telefone</label>
<input type="text" class='form form-control' name='tel' id='tel' maxlength='19' required >
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "transportadora", "index")?>">Voltar</a>
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
        $("#frmTransportadora").trigger("reset");
    
        
        
        
   
        

    });
</script>
        