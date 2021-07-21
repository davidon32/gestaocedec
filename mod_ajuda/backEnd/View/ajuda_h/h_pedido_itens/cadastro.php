

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

<legend>Cadastro de H_pedido_itens</legend>
<form action="<?=FuncaoBase::geraLink("ajuda", "h_pedido_itens", "gravar");?>" method="post" accept-charset="utf-8" name="frmH_pedido_itens" id="frmH_pedido_itens">
    
    <div class='row'>
<div class='col-md-2'>
<label>Código Material</label>
<input type="text" class='form form-control' name='codigo' id='codigo' maxlength='' required >
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label>Nome Descricao Material</label>
<input type="text" class='form form-control' name='descricao_item' id='descricao_item' maxlength='44' required >
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Quantidade</label>
<input type="text" class='form form-control' name='qtd' id='qtd' maxlength='' required >
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Quantidade de Familias Atendidas</label>
<input type="text" class='form form-control' name='qtd_familia_atendida' id='qtd_familia_atendida' maxlength='' required >
</div>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "h_pedido_itens", "index")?>">Voltar</a>
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
    
        /* close focus pesquisa */
        
    
        $("#frmH_pedido_itens").trigger("reset");
    
        
        
        
   
        

    });
</script>
        