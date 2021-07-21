

<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_decreto/Model/indexModel.php"; ?>
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

<legend>Cadastro de Cobrade</legend>
<form action="<?=FuncaoBase::geraLink("decreto", "cobrade", "gravar");?>" method="post" accept-charset="utf-8" name="frmCobrade" id="frmCobrade">
    
    <div class='row'>
<div class='col-md-6'>
<label>codigo do cobrade</label>
<input type="text" class='form form-control' name='codigo' id='codigo' maxlength='44' required >
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label>Descrição do cobrade</label>
<input type="text" class='form form-control' name='descricao' id='descricao' maxlength='44' required >
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='nome' id='nome' maxlength='44' required >
</div>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("decreto", "cobrade", "index")?>">Voltar</a>
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
    
        /* ckeck box padrao */
        
    
        /* radio button padrao */
        
    
        /* close focus pesquisa */
        
    
        $("#frmCobrade").trigger("reset");
        
    
        
        
        
   
        

    });
</script>
        