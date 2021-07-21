

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

<legend>Editar Cadastro H_pedido_itens</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "h_pedido_itens", "edit");?>" method="post" accept-charset="utf-8" name="frmH_pedido_itens" id="frmH_pedido_itens">
    
<div class='col-md-12'>
<div class='col-md-1'>
<label>Identificador Item Pedido</label>
<input type="text" class='form form-control' name='id' id='id' value='<?=$view[0]['id']?>'  readonly=readonly >
</div>
</div>
<div class='col-md-2'>
<label>Código Material</label>
<input type="text" class='form form-control' name='codigo' id='codigo' value='<?=$view[0]['codigo']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Nome Descricao Material</label>
<input type="text" class='form form-control' name='descricao_item' id='descricao_item' value='<?=$view[0]['descricao_item']?>'  maxlength='44' required>
</div>
<div class='col-md-2'>
<label>Quantidade</label>
<input type="text" class='form form-control' name='qtd' id='qtd' value='<?=$view[0]['qtd']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Quantidade de Familias Atendidas</label>
<input type="text" class='form form-control' name='qtd_familia_atendida' id='qtd_familia_atendida' value='<?=$view[0]['qtd_familia_atendida']?>'  maxlength='-1' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "h_pedido_itens", "index")?>">Voltar</a>
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
        