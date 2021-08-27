<!-- Ajuda Humanitaria -->
<?php

$dados =array();

$numMes = array();
$qtd = array(); 
$mes = array();
        
$baseMes = array(
'1'=>'Janeiro',
'2'=>'Fevereiro',
'3'=>'Marco',
'4'=>'Abril',
'5'=>'Maio',
'6'=>'Junho',
'7'=>'Julho',
'8'=>'Agosto',
'9'=>'Setembro',
'10'=>'Outubro',
'11'=>'Novembro',
'12'=>'Dezembro');

for ($i=0; $i<12;$i++){
    $dados[$i] = array('numMes'=>($i+1), 'qtd'=>'0', 'mes'=>$baseMes[($i+1)]);
    
    foreach ($pmdaPorAnoMes as $key => $value) {
        if($value['numMes'] == ($i+1)){
            $dados[$i] = array('numMes'=>($i+1), 'qtd'=>$value['qtd'], 'mes'=>$baseMes[($i+1)]);
        }
    }
}

foreach ($dados as $key => $value) {
    $numMes[] = $value['numMes'];
    $qtd[] = $value['qtd'];
    $mes[] = $value['mes'];
}


?>
<br>
<div class="col-md-12">
    <canvas id="Ct_pmdaPorMes" height="150" width="500"></canvas>
</div>

<script src='/js/jquery-1.8.3.js'></script>
<script>
    $(document).ready(function () {
        
    /* pmda do ano Mes */
    var pmdadoAnoMes = {
        /*labels: <?=json_encode($mes);?>,*/
        labels: ["0", "1"],
        datasets: [
            {
                label: "Processos PMDA ",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: <?=json_encode($qtd);?>,
            },
        ]
    }
    
    window.onload = function () {
        var Ct_pmdaPorMes = document.getElementById("Ct_pmdaPorMes").getContext("2d");
        window.myLine = new Chart(Ct_pmdaPorMes, {type: 'line',
            data: pmdadoAnoMes,
            responsive: true});
    }
  
    });
    
</script>