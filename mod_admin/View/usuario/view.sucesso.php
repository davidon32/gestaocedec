<?php
include_once "mod_equipe/Model/indexModel.php";
include_once $_SERVER['DOCUMENT_ROOT'] . '/core/include.php';
?>
<?php include_once "template/page/headerPageSimples.php"; ?>



<div class="col-md-12 text-center"><br><br>
<!--    <a href="<?= FuncaoBase::geraLink("index", "index", "index") ?>" class="btn btn-success" name="lkvoltar" id="lkvoltar">Voltar</a>-->
</div>

<div class="container">

    <?php
    $result = $_REQUEST['result'];

    #gravou 
    if ($result == 1) {


        print "<script>";
        print 'Swal.fire({
                width : 500,
                allowEscapeKey: false,
                keydownListenerCapture: true,
                title: "Usuário Cadastrado com Sucesso !",
                html: `<p>Aguarde a validação de seu Acesso ,</p><p>Após a validação, você receberá um e-mail com a confirmação !</p>`,
                icon: "success"
                }).then(function() {
                     window.location.href = "/index.php";
                    });';
        print "</script>";
    }else {
        
        print "<script>";
        print 'Swal.fire({
                width : 500,
                allowEscapeKey: false,
                keydownListenerCapture: true,
                title: "Usuário Já Registrado tente recuperar a senha !",
                icon: "error"
                }).then(function() {
                     window.location.href = "/index.php";
                    });';
        print "</script>";
        
    }
    ?>

</div>



<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->

<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>

<script>

    $('document').ready(function () {

        
    });

</script>
