<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_admin/Model/indexModel.php"; ?>
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

<legend>Editar Cadastro Release</legend>


<form action="<?=FuncaoBase::geraLink("admin", "release", "edit");?>" method="post" accept-charset="utf-8" name="frmRelease" id="frmRelease">
    
<div class='col-md-6'>
<label>Código</label>
<input type="text" class='form form-control' name='id_release' id='id_release' value='<?=$view[0]['id_release']?>'  readonly=readonly >
</div>
<div class='col-md-6'>
<label>Texto</label>
<input type="text" class='form form-control' name='texto' id='texto' value='<?=$view[0]['texto']?>'  maxlength='254' required>
</div>
<div class='col-md-6'>
<label>Data</label>
<input type="text" class='form form-control' name='data_release' id='data_release' value='<?= DataMysql::dataVisual($view[0]['data_release'])?>'  maxlength='-1' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("admin", "release", "index")?>">Voltar</a>
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
        