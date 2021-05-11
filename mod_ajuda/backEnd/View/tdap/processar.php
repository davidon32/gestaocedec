<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<form action="<?=FuncaoBase::geraLink("ajuda", "tdap", "processarsms")?>" method="POST" name="frmProcessar" id="frmProcessar" enctype="multipart/form-data" >
<br>
<br>
<legend>Processar o arquivo SMS</legend>
<br>
<input type="file" name="file" id="file" value=Processar Arquivo QrCode" />
       <br>   
       <input type="submit" name="btnProcessa" id="btnProcessa" value="Processar" class="btn btn-info">
</form>


<br>
<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="<?=FuncaoBase::geraLink("ajuda", "tdap", "index")?>" title="Relatorios">
        Voltar
    </a>
</div>

