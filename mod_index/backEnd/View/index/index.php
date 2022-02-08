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

<div id='continuar_sistema' class="col-md-6 text-left">
    <a class="btn btn-success btn-lg" href='index.php?token=<?= hash('sha256', md5(VERSAO) . "-" . time()) ?>&modulo=index&controller=index&action=menu'> Continuar a usar o Sistema !</a>  
</div>
<p id="espaco_menu"></p>
<div id='info_rapido' class="col-md-6 text-right">
    <a class="btn btn-success" title='Informações Rápidas' href='<?= FuncaoBase::geraLink("index", "index", "info")?>'> Informações Rápidas</a>  
</div> 
<div class="col-md-12">
    <br>
    <div class="col-md-4 text-center"> 
        <?php
        $login = new Login();
        $login->acessoLembrete($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito']);
        $login->acessoLembreteTransito($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito']);
        $dash = new Dashboard();
        ?>
    </div>
    <div class="col-md-12"> 
        <p style="text-align:center"><legend>RESUMO PROCESSOS PMDA</legend></p>
        <!-- quantidade por mes ano atual -->
        <div class='col-md-6'>
            <legend>PMDA <?=date('Y')?></legend>
            <?php
                $totalPmdaPorMes = dashboardModel::qtdPmdaMes(date('Y'));

                print "<table class='table table-bordered'>";
                print "<tr><th colspan='2' style='text-align:center'>PMDA ATENDIDO</th></tr>";
                print "<tr><td style='text-align:center'>Mês</td><td>QTD</td></tr>";
                foreach ($totalPmdaPorMes as $key => $value) {
                    print "<tr>";
                    print "<td>" . $value['mes'] . "</td>";
                    print "<td>" . $value['qtd'] . "</td>";
                    print "</tr>";
                }
                print "</table>";

            ?>
            
        </div>
        
        <!-- grafico por mes ano atual -->
        <div class='col-md-6'>
                <legend>PMDA <?=date('Y')?> Mês</legend>
            <?php
                $dash->qtdPmdaPorMes("2021");
            ?>
        </div>
    </div>
    <br>
    <div class='col-md-12'>
        <!-- linha 2 quantidade pmda todos anos -->
        <div class='col-md-6'>
            <legend>PMDA ANOS ANTERIORES</legend>
            <?php
            $totalPmda = dashboardModel::QtdPmdaAno();
            print "<table class='table table-bordered'>";
            print "<tr><th colspan='2' style='text-align:center'>PMDA ATENDIDO</th></tr>";
            print "<tr><td style='text-align:center'>ANO</td><td>QTD</td></tr>";
            foreach ($totalPmda as $key => $value) {
                print "<tr>";
                print "<td>" . $value['ano'] . "</td>";
                print "<td>" . $value['qtd'] . "</td>";
                print "</tr>";
            }
            print "</table>";
            ?>
        </div>
        
        <!-- grafico pmDA-->
        <div class='col-md-6'>
            <legend>PMDA Últimos Anos</legend>
            <?php
                $dash->qtdPmda();
            ?>
        </div>
    </div>

    <div class="col-md-12 text-center"> 
        <?php
        $dash->pmdaAno(date("Y"));
        //$dash->atualizado();
        //$dash->ajudaHumanitaria();
        //$dash->pmdaAnoMes("2017");
        //$dash->decreto();
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

        if(checkmobile()){
            $("#continuar_sistema").removeClass('text-left');
            $("#info_rapido").removeClass('text-right');
            
            $("#continuar_sistema").addClass('text-center');
            $("#info_rapido").addClass('text-center');
        }
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
                data: [1, 10, 7, 40, 25, 17, 2]
            },
        ]

    }



</script>