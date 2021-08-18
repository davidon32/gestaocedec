<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>  
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>

<div class="col-md-12">
    <a class="btn btn-success btn-lg" href='index.php?token=<?= hash('sha256', md5(VERSAO) . "-" . time()) ?>&modulo=index&controller=index&action=menu'> Continuar a usar o Sistema !</a>  
</div> 
<div class="col-md-12">
    <br>
    <p class="text-center"><legend>Notificações do Sistema</legend></p>
<div class="col-md-4 text-center"> 
    <?php
    $login = new Login();
    $login->acessoLembrete($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito']);
    $login->acessoLembreteTransito($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito'])
    ?>
</div>
<div class="col-md-12 text-center"> 
    <?php
    $dash = new Dashboard();
    $dash->atualizado();
    $dash->ajudaHumanitaria();
    $dash->pmda();
    $dash->decreto();
    ?>        
</div>

</div>

<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {
        var email = '<?= $_COOKIE['seguranca']['email_rec'] ?>';
        if ((email.length > 0) && (email.match(/.com/))) {
            Swal.fire({
                icon: 'error',
                title: 'Atualização de Email necessária...',
                width: 500,
                height: 400,
                text: 'Favor atualiar seu email para um email institucional',
                footer: '<a href=\'<?= FuncaoBase::geraLink("admin", "adm", "caduser", array("id" => $_COOKIE['seguranca']['idUser'])) ?>\'>Clique aqui acessar os dados cadatrais</a>'
            });
        }
    });

    
    var lineChartData = {
        labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Agos", "Set", "Out", "Nov", "Dez"],
        datasets: [
            {
                label: "Cesta",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [1,
                    5,
                    7,
                    10,
                    0,
                    15,
                    7]
            },
            {
                label: "Kit Higiene",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [1,10,7,40,25,17,2]
            },

        ]

    }

    window.onload = function () {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx, {type: 'line',
            data: lineChartData,
            responsive: true});
    }


</script>