<?php
include_once PATH . '/core/include.php';

$_funcaBase = new FuncaoBase();

$_compdec = new Compdec();

$_relatorioCompdec = new RelatorioComdec();

$_associacao = new Associacao();

$_regiao = new Regiao();

$_rb_filtro = isset($_REQUEST['rb_filtro']) ? utf8_decode($_REQUEST['rb_filtro']) : "";
$_sel_associacao = isset($_REQUEST['sel_associacao']) ? utf8_decode($_REQUEST['sel_associacao']) : "";
$_sel_regiao = isset($_REQUEST['sel_regiao']) ? utf8_decode($_REQUEST['sel_regiao']) : "";
$_sel_regiaoDC = isset($_REQUEST['sel_regiaoDC']) ? utf8_decode($_REQUEST['sel_regiaoDC']) : "";
$_btn_enviar = isset($_REQUEST['btn_enviar']) ? true : false;
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITULO; ?></title>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">

    <style>
        @media print {
            .imprimir {
                display: none;
            }
        }

        body {
            background: rgb(204, 204, 204);
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        page[size="A4"][layout="portrait"] {
            width: 29.7cm;
            height: 21cm;
        }

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
            }
        }

        .header {
            padding-top: 10px;
            text-align: center;
            border: 2px solid #ddd;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 80%;
        }

        table th {
            background-color: #e28651;
            color: white;
            text-align: center;
        }

        th,
        td {
            border: 1px solid #ddd;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #808080;
        }

        .nome {
            white-space: nowrap;
        }

        .dados {

            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center imprimir">
            <br><br>
            <?php
            $_funcaBase->vifs("volta", "?token=" . hash('sha256', md5(VERSAO) . date('dmY')) . "&ac=itn&modulo=compdec&controller=compdec&action=filtroRelatorio");
            print "&nbsp;&nbsp;&nbsp;";
            $_funcaBase->vifs("imprimir");
            ?>
            <!--<button class='btn btn-success' onclick="exportReportToExcel(this)">Exportar Excel</button>-->
            <br>
        </div>
        <div class="text-center">
            <br>
            <img src="/core/imagem/logo_novo.png" width="150px" />
            &nbsp;&nbsp;&nbsp;&nbsp;
            Coordenadoria Estadual de Defesa Civil de Minas Gerais
        </div>
        <div class="span12">
            <?php
            $compdecExistente = 0;
            $compdecInexistente = 0;

            $compdecAtiva = 0;
            $compdecDesativada = 0;

            $possuiNupdec = 0;
            $naoTemNupdec = 0;

            $possuiCartao = 0;
            $naoTemCartao = 0;

            $planoCont = 0;
            $naoTemPlano = 0;

            $mapeamento = 0;
            $naoTemMapeamento = 0;

            $capacitacao = 0;
            $naoTemCapacitacao = 0;



            if ($_btn_enviar) {

                //var_dump($_rb_filtro);
                //die();
                /* opção 0 - por associacoes */
                if ($_rb_filtro == "0") {
                    include_once 'rel_associacao.php';
                    /* opção 1 - de Endereço */
                } else if ($_rb_filtro == "1") {
                    include_once 'rel_endereco.php';

                    /* opcao 2 - por regiao do estado */
                } else if ($_rb_filtro == "2") {
                    include_once 'rel_regiao_estado.php';

                    /* opcao 3 - por compdec existente */
                } else if ($_rb_filtro == "3") {
                    $sel = $_POST['selExistente'];
                    include_once 'rel_compdec.php';

                    /* opcao 4 - por data de criação */
                } else if ($_rb_filtro == "4") {
                    include_once 'rel_dt_criacao.php';

                    # opcaso 5 - por regioes de desenvolvimento    
                } else if ($_rb_filtro == "5") {
                    include_once 'rel_regiao_des.php';
                    # resumo de compdecs    
                } else if ($_rb_filtro == "6") {

                    include_once 'rel_res_compdec.php';

                    $compdec = Compdec::DadosResumoCompdec();

                    //var_dump($compdec);

                    foreach ($compdec as $value) {

                        if (($value['com_const'] == 1) && ($value['com_ativa'] == 1)) {
                            $compdecExistente += 1;
                        }


                        if ($value['com_const'] == 0) {
                            $compdecInexistente += 1;
                        }



                        /* desativada */
                        if (($value['com_ativa'] == 0) && ($value['com_const'] == 1)) {
                            $compdecDesativada += 1;
                        }


                        if ($value['nudec'] == 1) {
                            $possuiNupdec += 1;
                        }


                        if ($value['cartao_pdc'] == 1) {
                            $possuiCartao += 1;
                        } else {
                            $naoTemCartao += 1;
                        }
                        if ($value['plano_cont'] == 1) {
                            $planoCont += 1;
                        } else {
                            $naoTemPlano += 1;
                        }
                        if ($value['mapeamento'] == 1) {
                            $mapeamento += 1;
                        } else {
                            $naoTemMapeamento += 1;
                        }
                        if ($value['capacitacao'] == 1) {
                            $capacitacao += 1;
                        } else {
                            $naoTemCapacitacao += 1;
                        }
                    }
                } else if ($_rb_filtro == "7") {
                    include_once 'rel_livro_compdec.php';
                    # opcao 8 lista mail
                } else if ($_rb_filtro == "8") {
                    include_once 'rel_lista_email.php';
                    #envio email pelo outlook    
                } else if ($_rb_filtro == "9") {
                    include_once 'rel_lista_email_outlook.php';
                } else if ($_rb_filtro == "10") {

                    include_once 'rel_regiao_DC.php';
                }
            } else {
                $_funcaBase->vifs('alerta', 'secao.php?secao=compdec&acao=filtroRel', "Escolha uma " . utf8_decode("Opção") . " para o filtro !");
            }
            ?>
        </div>
    </div>
    <script type="module" src="js/chartjs/Chart.js" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script type="text/javascript">
        Chart.register(ChartDataLabels);

        // compdec existentes;
        var ctx = document.getElementById("compdecExistente");
        var myChart = new Chart(ctx, {
            type: 'doughnut',

            data: {
                labels: ["Existente", "Sem Compdec"],
                datasets: [{
                    data: [<?= $compdecExistente . ", " . $compdecInexistente  ?>],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(242, 226, 100, 0.8)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(242, 226, 100, 0.8)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        align: 'end',
                        anchor: function(context) {
                            if ((context.chart.data.labels[context.dataIndex] % 2) === 1) {
                                return context.chart.data.position + 'end';
                            } else {
                                return 'end';
                            }
                        },
                        rotation: 0,
                        clamp: true,
                        backgroundColor: '#ccc',
                        borderRadius: 3,

                        color: function(context) {
                            //return context.dataset.backgroundColor;
                        },
                        font: function(context) {
                            var w = context.chart.width;
                            return {
                                size: w < 512 ? 12 : 14,
                                weight: '',
                            };;
                        },
                        formatter: function(value, context) {
                            var val = value / 853 * 100;
                            return val.toFixed(2) + "%";
                            //return context.chart.data.labels[context.dataIndex]+" : "+value;
                        }
                    },
                    legend: {
                        position: 'top' // Posições: 'top', 'bottom', 'left', 'right'
                    }
                }

            }
        });


        /* COMPDEC ATIVO */

        var ctx = document.getElementById("compdecInativa");
        var compdecAtivo = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Existente", "Sem Compdec"],
                datasets: [{
                    data: [<?= $compdecAtiva . ", " . $compdecDesativada; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        align: '',
                        anchor: '',
                        color: function(context) {
                            //return context.dataset.backgroundColor;
                        },
                        font: function(context) {
                            var w = context.chart.width;
                            return {
                                size: w < 512 ? 12 : 14,
                                weight: 'bold',
                            };
                        },
                        formatter: function(value, context) {
                            return context.chart.data.labels[context.dataIndex] + " : " + value;
                        }
                    }
                },
                    legend: {
                        position: 'top' // Posições: 'top', 'bottom', 'left', 'right'
                    }

            }
        });


        /* POSSUI NUPDEC 
         var ctx = document.getElementById("possuiNupdec");
         var myChart = new Chart(ctx, {
         type: 'pie',
         data: {
         labels: ["Possui Nupdec", "Não tem Nupdec"],
         datasets: [{
         label: '-',
         data: [<?= $possuiNupdec . ", " . $naoTemNupdec; ?>],
         backgroundColor: [
         'rgba(255, 99, 132, 0.2)',
         'rgba(54, 162, 235, 0.2)',                
         ],
         borderColor: [
         'rgba(255,99,132,1)',
         'rgba(54, 162, 235, 1)',
         ],
         borderWidth: 1
         }]
         },
         options: {
         legend: {
         
         },
         }
         });
         /* POSSUI CARTAO PROTECAO E DEFESA CIVIL
         var ctx = document.getElementById("possuiCartao");
         var myChart = new Chart(ctx, {
         type: 'pie',
         data: {
         labels: ["Possui Cartao", "Não tem Cartao"],
         datasets: [{
         label: '-',
         data: [<?= $possuiCartao . ", " . $naoTemCartao; ?>],
         backgroundColor: [
         'rgba(255, 99, 132, 0.2)',
         'rgba(54, 162, 235, 0.2)',                
         ],
         borderColor: [
         'rgba(255,99,132,1)',
         'rgba(54, 162, 235, 1)',
         ],
         borderWidth: 1
         }]
         },
         options: {
         legend: {
         
         },
         }
         });
         /* POSSUI MAPEAMENTO
         var ctx = document.getElementById("possuiMapeamento");
         var myChart = new Chart(ctx, {
         type: 'pie',
         data: {
         labels: ["Possui Mapeamento", "Não tem Mapeamento"],
         datasets: [{
         label: '-',
         data: [<?= $mapeamento . ", " . $naoTemMapeamento; ?>],
         backgroundColor: [
         'rgba(255, 99, 132, 0.2)',
         'rgba(54, 162, 235, 0.2)',                
         ],
         borderColor: [
         'rgba(255,99,132,1)',
         'rgba(54, 162, 235, 1)',
         ],
         borderWidth: 1
         }]
         },
         options: {
         legend: {
         
         },
         }
         });
         /* POSSUI CAPACITACAO
         var ctx = document.getElementById("possuiCapacitacao");
         var myChart = new Chart(ctx, {
         type: 'pie',
         data: {
         labels: ["Possui Capacitação", "Não tem Capacitação"],
         datasets: [{
         label: '-',
         data: [<?= $capacitacao . ", " . $naoTemCapacitacao; ?>],
         backgroundColor: [
         'rgba(255, 99, 132, 0.2)',
         'rgba(54, 162, 235, 0.2)',                
         ],
         borderColor: [
         'rgba(255,99,132,1)',
         'rgba(54, 162, 235, 1)',
         ],
         borderWidth: 1
         }]
         },
         options: {
         legend: {
         
         },
         }
         });
         /* POSSUI PLANO 
         var ctx = document.getElementById("possuiPlano");
         var myChart = new Chart(ctx, {
         type: 'pie',
         data: {
         labels: ["Possui Plano Contingência", "Não tem Plano"],
         datasets: [{
         label: '-',
         data: [<?= $planoCont . ", " . $naoTemPlano; ?>],
         backgroundColor: [
         'rgba(255, 99, 132, 0.2)',
         'rgba(54, 162, 235, 0.2)',                
         ],
         borderColor: [
         'rgba(255,99,132,1)',
         'rgba(54, 162, 235, 1)',
         ],
         borderWidth: 1
         }]
         },
         options: {
         legend: {
         
         },
         }
         });
         */
    </script>
</body>