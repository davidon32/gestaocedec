


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
        url: 'http://localhost:8081/sdclaravel/public/compdec/edit/854',
        data: {
            user: 'demetrio',
            pass: '123'
        },
        success: function () {
            
        }
    });




</script>

