<!-- Ajuda Humanitaria -->
<?php

/* PMDA qtd por ano*/
foreach ($pmdaQtdPorAno as $ano){
    $anoPmda[] = $ano['ano'];
    $qtdPmda[] = $ano['qtd'];
}

?>
<br>
<div class="col-md-12">
    <p style='text-align:center'><legend>PMDA POR ANO</legend></p>
    <canvas id="pmdaQtdPorAno" height="180" width="500"></canvas>
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
        var pmdaQtdPorAno = document.getElementById("pmdaQtdPorAno").getContext("2d");
        window.myLine = new Chart(pmdaQtdPorAno, {type: 'line',
            data: pmdaPorAno,
            responsive: true});
    }
    
   
        
    });
    
</script>