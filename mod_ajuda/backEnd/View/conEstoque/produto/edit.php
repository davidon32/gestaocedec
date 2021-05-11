

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


<legend>Editar Cadastro Marca</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "produto", "edit");?>" method="post" accept-charset="utf-8" name="frmProduto" id="frmProduto">
    
<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='id_produto' id='id_produto' value='<?=$view[0]['id_produto']?>'  readonly=readonly >
</div>

<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='codProd' id='codProd' value='<?=$view[0]['codProd']?>'  maxlength='-1' required>
</div>

<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='nome' id='nome' value='<?=$view[0]['nome']?>'  maxlength='69' required>
</div>

<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='dtEntradaSaida' id='dtEntradaSaida' value='<?=$view[0]['dtEntradaSaida']?>'  maxlength='-1' required>
</div>

<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='origem' id='origem' value='<?=$view[0]['origem']?>'  maxlength='69' required>
</div>

<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='obs' id='obs' value='<?=$view[0]['obs']?>'  maxlength='254' required>
</div>

<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='quantidade' id='quantidade' value='<?=$view[0]['quantidade']?>'  maxlength='-1' required>
</div>

<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='depDestino' id='depDestino' value='<?=$view[0]['depDestino']?>'  maxlength='44' required>
</div>

<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='validade' id='validade' value='<?=$view[0]['validade']?>'  maxlength='-1' required>
</div>

<div class='col-md-6'>
<label></label>
<input type="text" class='form form-control' name='nota_fiscal' id='nota_fiscal' value='<?=$view[0]['nota_fiscal']?>'  maxlength='69' required>
</div>


    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "produto", "index")?>">Voltar</a>
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

        

    });
</script>
        