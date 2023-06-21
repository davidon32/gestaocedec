


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>


    $.ajax({
        type: "POST",
        url: 'http://localhost/api/autentica',
        data: {
            cpf: '03260414606',
            pass: '12345678'
        },
        success: function (e) {
            console.log(e);
            //window.location.href = 'http://localhost/drrd';
            
        }
    });




</script>

