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
<br>
<?php
$fornecedor = new Fornecedor();

if ($_COOKIE['seguranca']['id_deposito'] == 1) {
    ?>

    <!-- links acesso-->
    <a href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')) ?>&ac=itn&modulo=ajuda&controller=tdap&action=cadfornec" class="btn btn-info">Cadastro Fornecedor</a>
    <br>
    <br>
    <a href="#" class="btn btn-info">Recebimento QRCode</a>
    <br>
    <br>
    
    <a href="<?=FuncaoBase::geraLink("ajuda", "tdap", "processar")?>" class="btn btn-info">Processar Arquivo SMS</a>


<<<<<<< HEAD
<a href="?token=<?=hash('sha256', md5(VERSAO).date('dmY'))?>&ac=itn&modulo=ajuda&controller=tdap&action=cadfornec" class="btn btn-info">Cadastro Fornecedor</a>
<a href="<?= FuncaoBase::geraLink("ajuda", "tdap", "listreceb")?>" class="btn btn-info">Recebimento QRCode</a>
=======
       <?php } ?>
>>>>>>> bill_click


       <br>
<div class="col-md-12 text-center">
    <br>
    <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO).date('dmY')); ?>&ac=itn&modulo=index&controller=index&action=menu"" title="Relatorios">
        Voltar
    </a>
</div>



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script type="text/javascript">

    $(document).ready(function () {

        


        $('#btnProcessa').click(function () {
            var form = new FormData();
            file = $("#flsms").prop('files')[0];
            form.append('file', file);
            //console.log(file);

            $.ajax({
                type: 'POST',
                url: '/mod_ajuda/backEnd/View/tdap/processar.php',
                data: form,
                processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
                //dataType: 'json',
                success: function (response) {
                    console.log(response);
                    //alert("Arquivo Processado com Sucesso!");
                    //location.reload();
                },
                error: function (e) {
                    //console.log(JSON.stringify(e));
                }

            });

        });



    });



</script>

<?php
?>
