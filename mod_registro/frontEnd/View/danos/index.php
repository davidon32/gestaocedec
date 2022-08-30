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

<br>

<div class="row">
    <div class="col-md-12">
        <!-- Pedido Cesta -->
        <div class="col-md-6">
            
            <!--####################### PEDIDO DE AJUDA HUMANITARIO ###########################-->
                
            <form action="<?= FuncaoBase::geraLink('registro', 'index', 'desabrigado')?>" method="POST" name="frmRegistra" id='frmRegistro'>
                
                <label>Data de Lancamento</label>
                <input class='form form-control' type="date" name="dt_registro" id="dt_registro" required value="<?=date('Y-m-d')?>" max="<?= date('Y-m-d')?>">
                <br>
                <label>Números de Desabrigados :</label><br>
                <span>
                    <b>Desabrigado</b>: Pessoa cuja habitação foi afetada por dano ou ameaça de dano que necessita
                        de abrigo custeado pela prefeitura, ou seja, pessoa que saiu da sua residência
                        afetada para ser mantida em um abrigo temporário, ou sob aluguel social,
                        ou hospedagem custeados pela prefeitura.
                </span>
                <input class='form form-control' type="number" name="desabrigado" id="desabrigado" required >
                <br>
                <label>Números de Desalojados :</label><br>
                <span>
                    <b>Desalojado</b>: Pessoa que foi obrigada a abandonar temporariamente ou definitivamente sua
                        habitação, em função de evacuações preventivas, destruição ou avaria grave, decorrentes
                        do desastre, que não carece de abrigo custeado pela prefeitura, ou seja, pessoa que saiu
                        da sua residência afetada e se instalou na casa de amigos ou parentes.
                </span>
                <input class='form form-control' type="number" name="desalojado" id="desalojado" required >
                <br>
                <input class='btn btn-primary' type="submit" name="btnGravar" id="btnGravar" value="Gravar">
                
            </form>
         
        </div>


        <div class="col-md-6 text-center">
            <legend>Últimos Registros</legend>
            <?php
            $registro = new Registro;
            
            $registros = $registro->listaGeral($_COOKIE['seguranca']['id_municipio']);
            
            
            print "<table class='table table-condensed'>";
            print "<tr>";
            print "<th>Data Registro</th>";
            print "<th>Desabrigados</th>";
            print "<th>Desalojados</th>";
            print "</tr>";
          
            foreach ($registros as $key => $registro) {
                
                print "<tr>";
                print "<th>".date("d/m/Y", strtotime($registro['dt_desalojado']))."</th>";
                print "<th>{$registro['desalojado']}</th>";
                print "<th>{$registro['desabrigado']}</th>";
                print "</tr>";
               
            }
            print "</table>";?>
 
        </div>
        <div class="col-md-12 text-center">
            <a class='btn btn-success' href='<?= FuncaoBase::geraLink('index', 'index', 'menue')?>'>Voltar</a>
        </div>
        <div class="col-md-12 text-center">
            <div class="card-body">
                <div class="chart">
                <canvas id="barChart" style="height: 230px; width: 547px;" height="230" width="547"></canvas>
                </div>
            </div>
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

  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

     
    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Desabrigados',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Desalojados',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    
  })

</script>