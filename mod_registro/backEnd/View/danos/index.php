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
<?php
include_once "template/page/corpoHeader.php";

$registro = new Registro();

$dadosgrafGeral = $registro->grafGeral();
?>

<br>
<div class="row">
    <div class="col-md-6">
        <a href="<?= FuncaoBase::geraLink('registro', 'index', 'lanca') ?>" class='btn btn-success'>Lancamento</a><br>
    </div>
    <div class="col-md-6">
        <p><label>Período</label>
            <input type="radio" name="ck_periodo" id="ck_periodo"></p>

        <div id='filtro_data'>
            <label for="dt_inicio">Data Inicial</label>
            <input type="text" id="dt_inicio" name="dt_inicio" class="form form-control">
            <label for="dt_fim">Data Final</label>
            <input type="text" id="dt_fim" name="dt_fim" class="form form-control">
            <p>
        </div>
        <label>Listagem Municípios</label>
            <input type="radio" name="ck_periodo" id="ck_periodo"></p>
            <div id='filtro_municipio'>
                <a href="<?= FuncaoBase::geraLink('registro', 'index', 'lanca') ?>" class='btn btn-success'>Filtro</a>
            </div>
    </div>
</div>
<br>
<div class='row'>
    <div class="col-md-6 text-center">
        <div class=" p-2">
            <legend class='alert alert-warning'>Acumulado Desabrigados e Desalojados em 2022</legend>
            <div class='chart'>
                <canvas id="barChart" style="height: 300px"></canvas> 
            </div>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="">
            <legend class='alert alert-warning'>Acumulado Desabrigados e Desalojados em 2022</legend>
            <div class='chart'>
                <canvas id="barChart" style="height: 300px"></canvas> 
            </div>
        </div>
    </div>


</div>

<div class="col-md-6 text-center">
    <div class="table-responsive">
        <legend>Últimos Registros</legend>
        <?php
        $registro = new Registro;

        $registros = $registro->listaPorMunicipio();

        print "<table class='table table-responsive table-striped'>";
        print "<tr>";
        print "<th>Município</th>";
        print "<th>Data Registro</th>";
        print "<th>Desabrigados</th>";
        print "<th>Desalojados</th>";
        print "</tr>";

        foreach ($registros as $key => $registro) {

            print "<tr>";
            print "<td>" . Municipio::PegaNomeMunicipio($registro['municipio_id']) . "</td>";
            print "<td>" . date("d/m/Y", strtotime($registro['dt'])) . "</td>";
            print "<td><span class='label label-warning'>{$registro['desalojado']}</span></td>";
            print "<td><span class='label label-warning'>{$registro['desabrigado']}</label></td>";
            print "</tr>";
        }
        print "</table>";
        ?>
    </div>
</div>

</div>
<div class="row">
    <div class="col-md-12 text-center">


    </div>
</div>
<div class="col-md-12 text-center">
    <a class='btn btn-success' href='<?= FuncaoBase::geraLink('index', 'index', 'menu') ?>'>Voltar</a>
</div>



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
    
    $('#filtro_data').hide();
    $('#filtro_municipio').hide();
    

    var dateFormat = "dd/mm/yy",
            dt_inicio = $("#dt_inicio")
            .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: 'dd/mm/yy'
            })
            .on("change", function () {
                dt_fim.datepicker("option", "minDate", getDate(this));
            }),
            dt_fim = $("#dt_fim").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy'
    })
            .on("change", function () {
                dt_inicio.datepicker("option", "maxDate", getDate(this));
            });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }

    $("#ck_filtro_data").click(function () {
        $("#filtro_data").show();
    });
    
    $("#ck_filtro_municipio").click(function () {
        $("#filtro_municipio").show();
    });
    
    


    var chartSituacao = $("#barChart")[0].getContext("2d");
    var areaChartData = {
        labels: ['Ano: <?= $dadosgrafGeral[0]['ano'] ?>'],
        datasets: [
            {
                label: 'Desabrigados',
                data: [<?= $dadosgrafGeral[0]['desabrigado'] ?>],
                backgroundColor: ['rgba(61, 146, 125, 1)', 'rgba(61, 146, 125, 1)', 'rgba(61, 146, 125, 1)', 'rgba(61, 146, 125, 1)', 'rgba(61, 146, 125, 1)', 'rgba(61, 146, 125, 1)', 'rgba(61, 146, 125, 1)', 'rgba(61, 146, 125, 1)'],
            },
            {
                label: 'Desalojados',
                fillColor: 'rgba(210, 214, 222)',
                strokeColor: 'rgba(210, 214, 222, 1)',
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: [<?= $dadosgrafGeral[0]['desalojado'] ?>],
            },
        ]
    }

    new Chart(chartSituacao, {
        type: 'bar',
        data: {
            labels: areaChartData.labels,
            datasets: areaChartData.datasets,
            backgroundColor: 'rgba(151,187,205,0.2)',
            borderColor: 'rgba(151,187,205,1)',
            pointBackgroundColor: 'rgba(151,187,205,1)',

        },

        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 10
                        }
                    }]
            }
        }
    });


</script>