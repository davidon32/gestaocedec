<!-- Ajuda Humanitaria -->
<?php

/* PMDA por ano*/
foreach ($pmdaPorAno as $ano){
    $anoPmda[] = $ano['ano'];
    $qtdPmda[] = $ano['id_pmda'];
}

?>
<br>
<div class="col-md-6">
    <legend>PMDA Por Ano</legend>
    <canvas id="pmdaPorAno" height="150" width="500"></canvas>
</div>

<script src='/js/jquery-1.8.3.js'></script>
<script>
    $(document).ready(function () {
        
    /* pmda por ano */
    var pmdaPorAno = {
        labels: <?=json_encode($anoPmda);?>,
        datasets: [
            {
                label: "Processos PMDA",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: <?=json_encode($qtdPmda);?>,
            },
        ]
    }
    
    window.onload = function () {
        var pmdaAno = document.getElementById("pmdaPorAno").getContext("2d");
        window.myLine = new Chart(pmdaAno, {type: 'line',
            data: pmdaPorAno,
            responsive: true});
    }
    
    
          
        
        
    });
    
</script>