<!-- Ajuda Humanitaria -->
<?php

/* PMDA por ano*/
foreach ($pmdaPorAno as $ano){
    $anoPmda[] = $ano['data'];
    $qtdPmda[] = $ano['id_pmda'];
}

/* PMDA por Status*/
foreach ($pmdaPorStatus as $status){
    $statusPmda[] = $status['status'];
    $qtdStatus[] = $status['qtd'];
}

?>
<br>
<div class="col-md-6">
<legend>PMDA Por Ano</legend>
        <canvas id="pmdaPorAno" height="150" width="500"></canvas>
</div>


<legend>PMDA Por Status</legend>
<div class="col-md-6">
        <canvas id="pmdaPorStatus" height="150" width="500"></canvas>
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
        var ctx = document.getElementById("pmdaPorAno").getContext("2d");
        window.myLine = new Chart(ctx, {type: 'line',
            data: pmdaPorAno,
            responsive: true});
        
        var ctx1 = document.getElementById("pmdaPorStatus").getContext("2d");
        window.myLine = new Chart(ctx1, {type: 'line',
            data: pmdaPorStatus,
            responsive: true});
    }
    
    
    /* pmda Por Status */
    var pmdaPorStatus = {
        labels: <?=json_encode($statusPmda);?>,
        datasets: [
            {
                label: "Status PMDA",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: <?=json_encode($qtdStatus);?>,
            },
        ]
    }


        
        
        
    });
    
</script>