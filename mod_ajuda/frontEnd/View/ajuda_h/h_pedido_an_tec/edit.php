

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

<legend>Edição Analise Técnica Parecer</legend>


<form action="<?=FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "edit");?>" method="post" accept-charset="utf-8" name="frmH_pedido_an_tec" id="frmH_pedido_an_tec">
    
<div class='col-md-12'>
<div class='col-md-1'>
<label>Identificador Analise</label>
<input type="text" class='form form-control' name='id_analise' id='id_analise' value='<?=$view[0]['id_analise']?>'  readonly=readonly >
</div>
</div>
<div class='col-md-2'>
<label>identificador do Usuário</label>
<input type="text" class='form form-control' name='id_usuario' id='id_usuario' value='<?=$view[0]['id_usuario']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Identificador do Pedido</label>
<input type="text" class='form form-control' name='id_pedido' id='id_pedido' value='<?=$view[0]['id_pedido']?>'  maxlength='-1' required>
</div>
<div class='col-md-2'>
<label>Data envio</label>
<input type="date" class='form form-control' name='data_parecer' id='data_parecer' value='<?=DataMysql::dataVisual($view[0]['data_parecer'])?>'  maxlength='-1' required>
</div>
<div class='col-md-12'>
<label>Parecer Técnico</label>
<input type="" class='form form-control' name='parecer' id='parecer' value='<?=$view[0]['parecer']?>'  maxlength='65534' required>
</div>
<div class='col-md-2'>
<label>Seção do Parecer</label>
<input type="text" class='form form-control' name='tramit_parecer' id='tramit_parecer' value='<?=$view[0]['tramit_parecer']?>'  maxlength='14' required>
</div>

    <div class="col-md-12 text-center">
        <br>
        <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "index")?>">Voltar</a>
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
        