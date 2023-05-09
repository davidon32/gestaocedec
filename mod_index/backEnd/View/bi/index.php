<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_index/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";
?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<?php
$secao = isset($_COOKIE['seguranca']['secao']) ? $_COOKIE['seguranca']['secao'] : "";
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
        <script>

            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
function drawChart() {
            var data = google.visualization.arrayToDataTable([

                    ['class Name', 'Students'],
                    ['123', 'jose'],
                    ]);
                    
            var options = {
            title: 'Number of Students according to their class',
                    pieHole: 0.5,
                    pieSliceTextStyle: {
                    color: 'black',
                    },
                    legend: 'none'
            };
            var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
            chart.draw(data, options);
}


</script>
<div class="col-md-3">
            <?php
//    foreach ($array as $key => $value) {
//        
//    };
            ?>

        </div>
        <div class="col-md-9">

            <div class="container-fluid">
                <div id="columnchart12" style="width: 100%; height: 500px;">-</div>
            </div>


        </div>

        <!-- =================== RODAPE CORPO ==================== -->
        <?php include_once "template/page/corpoRodape.php"; ?>
        <!-- =================== RODAPE  ======================== -->
        <?php include_once "template/page/rodape.php" ?>
        <?php include_once "template/page/barra_config_template.php"; ?>
        <!-- =============== HEADER HTML PAGE ================= -->
        <?php include_once "template/page/rodapePage.php"; ?>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
                        <script>
$(document).ready(function () {

                    google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([

            ['class Name', 'Students'],
            ['123', 'jose']],
            ]);
            var options = {
            title: 'Number of Students according to their class',
                    pieHole: 0.5,
                    pieSliceTextStyle: {
                    color: 'black',
                    },
                    legend: 'none'
            };
            var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
            chart.draw(data, options);
            }


});
       </script>

