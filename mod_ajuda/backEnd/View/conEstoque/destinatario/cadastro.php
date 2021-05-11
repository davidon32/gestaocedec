

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


<legend>Cadastro de Destinatario</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "destinatario", "gravar");?>" method="post" accept-charset="utf-8" name="frmDestinatario" id="frmDestinatario">
    
    <div class='col-md-6'>
<label>Nome do Destinatario</label>
<input type="text" class='form form-control' name='nome' id='nome' maxlength='69' required >
</div>
<div class='col-md-6'>
<label>CNPJ</label>
<input type="text" class='form form-control' name='cnpj' id='cnpj' maxlength='44' required data-mask="99.999.999/9999-99">
</div>
<div class='col-md-6'>
<label>Endereço</label>
<input type="text" class='form form-control' name='endereco' id='endereco' maxlength='169' required >
</div>
<div class='col-md-6'>
<label>Municipio</label>
<input type="text" class='form form-control' name='municipio' id='municipio' maxlength='44' required >
</div>
<div class='col-md-6'>
<label>Estado</label>
<input type="text" class='form form-control' name='estado' id='estado' maxlength='2' required value="MG">
</div>
<div class='col-md-6'>
<label>Cep</label>
<input type="text" class='form form-control' name='cep' id='cep' maxlength='10' required >
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "destinatario", "index")?>">Voltar</a>
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
        $("#frmDestinatario").trigger("reset");
    
        
        
        
   
        

    });
</script>
        