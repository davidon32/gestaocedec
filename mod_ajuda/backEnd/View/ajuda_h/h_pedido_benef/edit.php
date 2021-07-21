

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

<legend>Editar Cadastro H_pedido_benef</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "h_pedido_benef", "edit");?>" method="post" accept-charset="utf-8" name="frmH_pedido_benef" id="frmH_pedido_benef">
    
<div class='col-md-12'>
<div class='col-md-1'>
<label>Identificador Prestação de Contas</label>
<input type="text" class='form form-control' name='id' id='id' value='<?=$view[0]['id']?>'  readonly=readonly >
</div>
</div>
<div class='col-md-6'>
<label>Nome Beneficiário</label>
<input type="text" class='form form-control' name='nome_beneficiario' id='nome_beneficiario' value='<?=$view[0]['nome_beneficiario']?>'  maxlength='69' required>
</div>
<div class='col-md-2'>
<label>Identidade do Beneficiário</label>
<input type="text" class='form form-control' name='rg' id='rg' value='<?=$view[0]['rg']?>'  maxlength='14' required>
</div>
<div class='col-md-6'>
<label>Comunidade do Beneficiário</label>
<input type="text" class='form form-control' name='comunidade' id='comunidade' value='<?=$view[0]['comunidade']?>'  maxlength='44' required>
</div>
<div class='col-md-2'>
<label>Quantidade de Material</label>
<input type="text" class='form form-control' name='qtd' id='qtd' value='<?=$view[0]['qtd']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Data de Entrega do Material</label>
<input type="text" class='form form-control' name='data_entrega' id='data_entrega' value='<?=DataMysql::dataVisual($view[0]['data_entrega'])?>'  maxlength='-1' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "h_pedido_benef", "index")?>">Voltar</a>
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
        