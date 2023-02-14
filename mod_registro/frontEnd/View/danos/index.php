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

            <form action="<?= FuncaoBase::geraLink('registro', 'index', 'desabrigado') ?>" method="POST" name="frmRegistra" id='frmRegistro'>

                <label>Data de Lancamento</label>
                <input class='form form-control' type="date" name="dt_registro" id="dt_registro" required min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>">
                <br>
                <label>Números de Desabrigados :</label><br>
                <span>
                    <b>Desabrigado</b>: Pessoa cuja habitação foi afetada por dano ou ameaça de dano que necessita
                    de abrigo custeado pela prefeitura, ou seja, pessoa que saiu da sua residência
                    afetada para ser mantida em um abrigo temporário, ou sob aluguel social,
                    ou hospedagem custeados pela prefeitura.
                </span>
                <input class='form form-control' type="number" name="desabrigado" id="desabrigado" required value="0" >
                <br>
                <label>Números de Desalojados :</label><br>
                <span>
                    <b>Desalojado</b>: Pessoa que foi obrigada a abandonar temporariamente ou definitivamente sua
                    habitação, em função de evacuações preventivas, destruição ou avaria grave, decorrentes
                    do desastre, que não carece de abrigo custeado pela prefeitura, ou seja, pessoa que saiu
                    da sua residência afetada e se instalou na casa de amigos ou parentes.
                </span>
                <input class='form form-control' type="number" name="desalojado" id="desalojado" required  value="0" >
                <br>
                <input class='btn btn-primary' type="submit" name="btnGravar" id="btnGravar" value="Gravar">

            </form>

        </div>


        <div class="col-md-6 text-center">
            <legend>Últimos Registros</legend>
            <?php
            $registro = new Registro;

            $registros = $registro->listaGeral($_COOKIE['seguranca']['id_municipio']);
//            $registros = $registro->listaPorMunicipio_data($_COOKIE['seguranca']['id_municipio'], date('Y-m-d'));





            print "<table class='table table-condensed'>";
            print "<tr>";
            print "<th>Data Registro</th>";
            print "<th>Desabrigados</th>";
            print "<th>Desalojados</th>";
            print "<th>Opção</th>";
            print "</tr>";

            foreach ($registros as $key => $registro1) {


                print "<tr>";
                print "<td>" . date("d/m/Y", strtotime($registro1['dt_desalojado'])) . "</td>";
                print "<td>{$registro1['desabrigado']}</td>";
                print "<td>{$registro1['desalojado']}</td>";
                print "<td>";
                if ($registro1['dt_desalojado'] == date('Y-m-d')) {
                    print "<button type='button' name='editar'><img width='25' title='Editar valores' src='/core/imagem/editar.png'></button>";
                    print "<button type='button' name='salvar' data-id='{$registro1['id']}'><img width='25' title='Salvar Edição' src='/core/imagem/save.png'></button>";
                    print "</td>";
                } else {
                    print "-";
                }
                print "</tr>";
            }
            print "</table>";


            $gr_registros = $registro->listaPorAno($_COOKIE['seguranca']['id_municipio'], "2022");


            $gr_desabrigado = array();
            $gr_desalojado = array();

            foreach ($gr_registros as $key => $registro2) {
                $gr_desabrigado[] = $registro2['desabrigado'];
                $gr_desalojado[] = $registro2['desalojado'];
            }
            ?>
        </div>
        <div class="col-md-12 text-center">
            <a class='btn btn-success' href='<?= FuncaoBase::geraLink('index', 'index', 'menue') ?>'>Voltar</a>
        </div>
        <br>
        <br>
        <div class="col-md-12 text-center">
            <br>
            <br>
            <div class="col-md-6">
    <!--        <legend>Situação de Desabrigados e Desalojados <?= Municipio::PegaNomeMunicipio($_COOKIE['seguranca']['id_municipio']); ?></legend>-->
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" style="height: 230px; width: 547px;" height="230" width="547"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <div class="chart">
    <!--                <canvas id="barChart12" style="height: 230px; width: 547px;" height="230" width="547"></canvas>-->
                    </div>
                </div>
            </div>



        </div>

    </div>
    <?php
    $json_desabrigado = json_encode($gr_desabrigado);
    $json_desalojado = json_encode($gr_desalojado);

//var_dump($json_desalojado);
    ?>

    <!-- =================== RODAPE CORPO ==================== -->
    <?php include_once "template/page/corpoRodape.php"; ?>
    <!-- =================== RODAPE  ======================== -->
    <?php include_once "template/page/rodape.php" ?>
    <?php include_once "template/page/barra_config_template.php"; ?>
    <!-- =============== HEADER HTML PAGE ================= -->
    <?php include_once "template/page/rodapePage.php"; ?>
    <script>

        $("button[name='salvar']").hide();

        $("button[name='salvar']").click(function () {

            var desabrigado = $(this).parent().parent().find('td').find('input')[0].value;    
            var desalojado = $(this).parent().parent().find('td').find('input')[1].value;
            

            if (desalojado.length != 0 && desabrigado.length != 0) {

                var formData = new FormData();
                formData.append('id', $(this).data('id'));
                formData.append('desalojado', desalojado);
                formData.append('desabrigado', desabrigado);

                $.ajax({
                    url: '/mod_registro/frontEnd/View/danos/ajax.php',
                    type: 'POST',
                    data: formData,
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    success: function (response) {
                        if (response.trim() == 'sucesso') {
                            Swal.fire('Registro Editado com sucesso !').then(function () {
                                //$('#lista_despacho').load('/mod_ajuda/backEnd/View/ajuda_h/h_pedido_pedid/ajax_lista_despacho.php?id=' + id_pedido);
                                window.location.reload();
                            });
                        }
                    },
                    error: function (e) {
                        //console.log(JSON.stringify(e));
                    }
                });
            } else {
                alert('O campo Desabrigados e/ou Desalojados não pode estar em branco !');
            }
        })

        $("button[name='editar']").click(function () {
            var desabrigados = $(this).parent().parent().find('td')[1].innerHTML;
            var desalojados = $(this).parent().parent().find('td')[2].innerHTML;

            $(this).parent().parent().find('td')[1].innerHTML = "<input type='number' name='desabrigado' required value='" + desabrigados + "'>";
            $(this).parent().parent().find('td')[2].innerHTML = "<input type='number' name='desalojado' required value='" + desalojados + "'>";

            $("button[name='editar']").hide();
            $("button[name='salvar']").show();




        });

        $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */


            var areaChartData = {
                labels: [
                    'Janeiro',
                    'Fevereiro',
                    'Março',
                    'Abril',
                    'Maio',
                    'Junto',
                    'Julho',
                    'Agosto',
                    'Setembro',
                    'Outubro',
                    'Novembro',
                    'Dezembro'
                ],
                datasets: [
                    {
                        label: 'Desabrigados',
                        //backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: true,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: <?= $json_desabrigado ?>
                    },
                    {
                        label: 'Desalojados',
                        //backgroundColor     : 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: true,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: <?= $json_desalojado; ?>
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                            gridLines: {
                                display: false,
                            }
                        }],
                    yAxes: [{
                            gridLines: {
                                display: false,
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
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'line',
                data: barChartData,
                options: barChartOptions
            })


        })

    </script>