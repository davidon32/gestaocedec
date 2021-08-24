<!-- Ajuda Humanitaria -->
<?php

var_dump($pmdaPorAnoMes);

/* PMDA por ano mes*/
foreach ($pmdaPorAnoMes as $anoMes){
    $anoMesPmda[] = $anoMes['mes'];
    $qtdMesPmda[] = $anoMes['qtd'];
}

?>
<br>
<div class="col-md-6">
    <legend>PMDA Por Ano Mes</legend>
    <canvas id="pmdaPorAnoMes" height="150" width="500"></canvas>
</div>

<script src='/js/jquery-1.8.3.js'></script>
<script>
    $(document).ready(function () {
        
    /* pmda por ano */
    var pmdaPorAno = {
        labels: <?=json_encode($anoMesPmda[0]);?>,
        datasets: [
            {
                label: "Processos PMDA {$anoPmda[0]{",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: <?=json_encode($anoMesPmda);?>,
            },
        ]
    }
    
    window.onload = function () {
        var pmdaAnoMes = document.getElementById("pmdaPorAnoMes").getContext("2d");
        window.myLine = new Chart(pmdaAnoMes, {type: 'line',
            data: pmdaPorAno,
            responsive: true});
    }
    
    
          
        
        
    });
    
</script>