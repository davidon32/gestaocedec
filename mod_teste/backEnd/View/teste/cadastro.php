

<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_teste/Model/indexModel.php"; ?>
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

<legend>Cadastro de Teste</legend>
<form action="<?=FuncaoBase::geraLink("teste", "teste", "gravar");?>" method="post" accept-charset="utf-8" name="frmTeste" id="frmTeste">
    
    <div class='row'>
<div class='col-md-2'>
<label>Data Registro</label>
<input type="date" class='form form-control' name='data_reg' id='data_reg' maxlength='' required >
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label>Codigo UF</label>
<input type="text" class='form form-control' name='CodUf' id='CodUf' maxlength='49' required >
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label>Codigo Municpio DV</label>
<input type="text" class='form form-control' name='Codmundv' id='Codmundv' maxlength='49' required >
</div>
</div>
<div class='row'>
<div class='col-md-2'><br>
<input type="checkbox" class='checkbox-inline' name='ck_check' id='ck_check' >
<label>Checkebox 1</label>
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label>Cod Municipio</label>
<input type="text" class='form form-control' name='Codmun' id='Codmun' maxlength='49' required >
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<label>Nome Municipio</label>
<input type="text" class='form form-control' name='NomeMunic' id='NomeMunic' maxlength='69' required >
</div>
</div>
<div class='row'>
<div class='col-md-2'>
<label>Radio 2</label>
<div class='radio'>
<label>
<input type='radio' name='rb_radio' id='rb_radio_sim' value='1'>
Sim
</label>
</div>
<div class='radio'>
<label>
<input type='radio' name='rb_radio' id='rb_radio_nao' value='0'>
Não
</label>
</div>
</div>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("teste", "teste", "index")?>">Voltar</a>
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
    
    
        /* radio button padrao */
        
$("#rb_radio_nao").attr("checked",true);

    
        /* close focus pesquisa */
        
    
        $("#frmTeste").trigger("reset");
        
    
        
        
        
   
        

    });
</script>
        