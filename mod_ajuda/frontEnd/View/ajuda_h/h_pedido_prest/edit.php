

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

<?php



?>

<legend>Editar Cadastro H_pedido_prest</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "h_pedido_prest", "edit");?>" method="post" accept-charset="utf-8" name="frmH_pedido_prest" id="frmH_pedido_prest">
    
<div class='col-md-12'>
<div class='col-md-1'>
<label>Identificador Prestação de Contas</label>
<input type="text" class='form form-control' name='id' id='id' value='<?=$view[0]['id']?>'  readonly=readonly >
</div>
</div>
<div class='col-md-2'>
<label>Identificador do Pedido</label>
<input type="text" class='form form-control' name='id_pedido' id='id_pedido' value='<?=$view[0]['id_pedido']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Código Material</label>
<input type="text" class='form form-control' name='cod_material' id='cod_material' value='<?=$view[0]['cod_material']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Nome do Material</label>
<input type="text" class='form form-control' name='nome_material' id='nome_material' value='<?=$view[0]['nome_material']?>'  maxlength='44' required>
</div>
<div class='col-md-2'>
<label>Total de Familias Atendidas</label>
<input type="text" class='form form-control' name='total_familia_at' id='total_familia_at' value='<?=$view[0]['total_familia_at']?>'  maxlength='-1' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "h_pedido_prest", "index")?>">Voltar</a>
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
        