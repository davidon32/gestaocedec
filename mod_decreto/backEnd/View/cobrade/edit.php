

<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_decreto/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php include_once "template/page/menu.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<?php



?>

<legend>Editar Cadastro Cobrade</legend>


<form action="<?=FuncaoBase::geraLink("decreto", "cobrade", "edit");?>" method="post" accept-charset="utf-8" name="frmCobrade" id="frmCobrade">
    
<div class='col-md-12'>
<div class='col-md-1'>
<label>Identificador do Cobrade</label>
<input type="text" class='form form-control' name='id_cobrade' id='id_cobrade' value='<?=$view[0]['id_cobrade']?>'  readonly=readonly >
</div>
</div>
<div class='col-md-6'>
<label>codigo do cobrade</label>
<input type="text" class='form form-control' name='codigo' id='codigo' value='<?=$view[0]['codigo']?>'  maxlength='44' required>
</div>
<div class='col-md-6'>
<label>Descrição do cobrade</label>
<input type="text" class='form form-control' name='descricao' id='descricao' value='<?=$view[0]['descricao']?>'  maxlength='44' required>
</div>
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='nome' id='nome' value='<?=$view[0]['nome']?>'  maxlength='44' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("decreto", "cobrade", "index")?>">Voltar</a>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Atualizar">
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
    
     /* close focus pesquisa */
        

        
        
        

    });
</script>
        