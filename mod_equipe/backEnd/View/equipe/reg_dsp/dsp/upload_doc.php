<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_admin/Model/admModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<style>
    p {text-align: center};

</style>

<p>
    
    <?php
        $id_dsp = isset($_GET['id']) ? $_GET['id'] : die();;
        
    
    ?>
    <div class='row'>
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form method="POST" action="<?= FuncaoBase::geraLink("equipe", "equipe", "upload_dsp")?>" enctype="multipart/form-data">
                <label>Upload de DOcumentos</label>
                <br><br>
                
                <label title='Cole aqui o link para o documento no Google Drive'>Link Google Drive &nbsp;&nbsp;&nbsp;<img width='45' src='/core/imagem/googledrive.png'></label>
                <input type="text" name="notNormalizaLinkGoogle" id='notNormalizaLinkGoogle' class='form form-control'>
                <input type="hidden" name="data_hora" id='data_hora' value="<?=date('Y/m/d')?>">
                <input type="hidden" name="id_dsp" id='id_dsp' value="<?=$id_dsp;?>">
                
            <br>
            ou
            <br>
            <label>Upload de Arquivo</label>
            <input type="file" name="fl_doc_dsp" id='fl_doc_dsp'>
            <br>
            <input class="btn btn-primary" type="submit" name="btnUpload" id="btnUpload" value="Upload">
            <br>
            </form>
            <br>
          
        <p><button class='btn btn-success' type="button" onclick="window.location.href= '<?= FuncaoBase::geraLink("equipe", "index", "index")?>';" >Voltar</button>
    </div>
    <div class="col-md-1"></div>
</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php";?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php"?>
<?php include_once "template/page/barra_config_template.php";?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php";?>    
