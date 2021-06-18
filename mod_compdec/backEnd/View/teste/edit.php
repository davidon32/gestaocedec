

<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_compdec/Model/indexModel.php"; ?>
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

<legend>Editar Cadastro Teste</legend>


<form action="<?=FuncaoBase::geraLink("compdec", "teste", "edit");?>" method="post" accept-charset="utf-8" name="frmTeste" id="frmTeste">
    
<div class='col-md-12'>
<div class='col-md-1'>
<label>Id</label>
<input type="text" class='form form-control' name='id_teste' id='id_teste' value='<?=$view[0]['id_teste']?>'  readonly=readonly >
</div>
</div>
<div class='col-md-2'>
<label>Data</label>
<input type="text" class='form form-control' name='data_reg' id='data_reg' value='<?=DataMysql::dataVisual($view[0]['data_reg'])?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Uf</label>
<input type="text" class='form form-control' name='CodUf' id='CodUf' value='<?=$view[0]['CodUf']?>'  maxlength='9' required>
</div>
<div class='col-md-2'>
<label>Cod Mun DV</label>
<input type="text" class='form form-control' name='Codmundv' id='Codmundv' value='<?=$view[0]['Codmundv']?>'  maxlength='9' required>
</div>
<div class='col-md-2'>
<label>Cod Mun</label>
<input type="text" class='form form-control' name='Codmun' id='Codmun' value='<?=$view[0]['Codmun']?>'  maxlength='-1' required>
</div>
<div class='col-md-6'>
<label>Nome Mun</label>
<input type="text" class='form form-control' name='NomeMunic' id='NomeMunic' value='<?=$view[0]['NomeMunic']?>'  maxlength='69' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("compdec", "teste", "index")?>">Voltar</a>
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
        