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

<style>
    li { padding: 0!important}
</style>


<div id='continuar_sistema' class="col-md-6 text-left">
    <a class="btn btn-success btn-lg" href='index.php?token=<?= hash('sha256', md5(VERSAO) . "-" . time()) ?>&modulo=index&controller=index&action=menu' title="Clique aqui para acessar o Sistema !">
        Entrar
    </a>
</div>
<p id="espaco_menu"></p>
<div id='info_rapido' class="col-md-6 text-right">
    <a class="btn btn-success" title='Informações Rápidas' href='<?= FuncaoBase::geraLink("index", "index", "info") ?>'> Informações Rápidas</a>
</div>
<div class="col-md-12">
    <br>

    <div class="col-md-8">
        <?php
        $id_redec = $_COOKIE['seguranca']['id_rpm'];
        $ped_ajuda = H_pedido_pedidajuda_hModel::listaPedidosParaDespacho($id_redec);
        $titulo = "";

        if (count($ped_ajuda)) {
            if ($secao == "DLOG") {
                $titulo = "<legend>Pedidos Pendentes</legend><span> ( Pedidos Pendentes para Análise DLOG )</span>";
            } elseif ($secao == "CHEFIA") {
                $titulo = "<legend>Autorizador</legend><span> ( Pedidos pendentes de Autorização )</span>";
            } else {
                $titulo = "<legend>Pedidos Ajuda Humanitária para análise</legend><span> Visualização</span>";
            }
            $count = 0;
            print $titulo;
                //var_dump($secao);
            
            foreach ($ped_ajuda as $key => $pedido) {
                    
                
                $data_hoje = new DateTime(date('Y-m-d'));
                $data_pedido = new DateTime($pedido['data_entrada_sistema']);
                $dif = $data_hoje->diff($data_pedido);
                
                /* PEDIDO STATUS PARA ANALISE DLOG  */
                if ($secao == "DLOG" && $pedido['status'] == 1) {
                    $count++;
                    print "<ul class=\"todo-lis col-md-12\">
                            <li>
                                <span class=\"handle\">" . ($count) . ") - <i class=\"fa fa-ellipsis-v\"></i>
                                <i class=\"fa fa-ellipsis-v\"></i>
                                </span>
                                <span class=\"text\">
                                    <a style=\"text-decoration:none;\" href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'edit', array('id' => $pedido['id'], 'voltar' => 'idx_recente')) . "\" title='Despachar Pedido'>
                                    &nbsp;&nbsp;<img style=\"vertical-align:middle\" width='15px;' src=\"/core/imagem/pedido_cesta.png\">
                                    &nbsp;&nbsp;<span style='font-size:12px;'>
                                    <span style='font-weight:bold;font-style: italic;'>". Municipio::PegaNomeMunicipio($pedido['id_municipio'])."</span>
                                    Pedido AH Nº: " . $pedido['numero'] . "/" . substr($pedido['data_entrada_sistema'], 0, 4) . " - " . DataMysql::dataVisual($pedido['data_entrada_sistema']) . "</a>
                                </span>";
                                if($pedido['id_municipio'] != "7221"){
                                    print "<small class=\"label label-danger\"><i class=\"fa fa-clock-o\"></i> - Criado há " . $dif->days . "  dia(s)</small>";
                                }
                             print "
                            </li>
                          </ul>";
                 /* visualização dos demais usuarios do pedido em analise pelo DLOG*/
                }elseif($secao != "DLOG" && $pedido['status'] == 1) {
                    $count++;
                    print "<ul class=\"todo-lis col-md-12\">
                            <li>
                                <span class=\"handle\">" . ($count) . ") - <i class=\"fa fa-ellipsis-v\"></i>
                                <i class=\"fa fa-ellipsis-v\"></i>
                                </span>
                                <span class='text'>
                                    <a style=\"text-decoration:none;\" href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'view', array('id' => $pedido['id'], 'voltar' => 'idx_recente')) . "\" title='Despachar Pedido'>
                                    &nbsp;&nbsp;<img style=\"vertical-align:middle\" width='15px;' src=\"/core/imagem/pedido_cesta.png\">
                                    &nbsp;&nbsp;<span style='font-size:12px;'>
                                    <span style='font-weight:bold;font-style: italic;'>". Municipio::PegaNomeMunicipio($pedido['id_municipio'])."</span>
                                    Pedido AH Nº: " . $pedido['numero'] . "/" . substr($pedido['data_entrada_sistema'], 0, 4) . " - " . DataMysql::dataVisual($pedido['data_entrada_sistema']) . "</a>
                                </span>";
                    
                    if($pedido['id_municipio'] != "7221"){
                                    print "<small class=\"label label-danger\"><i class=\"fa fa-clock-o\"></i> - Criado há " . $dif->days . "  dia(s)</small>";
                                }
                                
                                //<small class=\"label label-danger\"><i class=\"fa fa-clock-o\"></i> - Criado há " . $dif->days . "  dia(s)</small>
                              print "
                            </li>
                          </ul>";
                
                    
                /* PEDIDOS EM ANALISE DIRETOR  */
                }elseif ($secao == "CHEFIA" && $pedido['status'] == 2) {
                    $count ++;
                    
                    print "<ul class=\"todo-lis col-md-12\">
                            <li>
                                <span class=\"handle\">" . ($count) . ") - <i class=\"fa fa-ellipsis-v\"></i>
                                <i class=\"fa fa-ellipsis-v\"></i>
                                </span>
                                <span class=\"text\">
                                    <a style=\"text-decoration:none;\" href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'edit', array('id' => $pedido['id'], 'voltar' => 'idx_recente')) . "\" title='Despachar Pedido'>
                                    &nbsp;&nbsp;<img style=\"vertical-align:middle\" width='15px;' src=\"/core/imagem/pedido_cesta.png\">
                                    &nbsp;&nbsp;<span style='font-size:12px;'>
                                    <span style='font-weight:bold;font-style: italic;'>". Municipio::PegaNomeMunicipio($pedido['id_municipio'])."</span>
                                    Pedido AH Nº: " . $pedido['numero'] . "/" . substr($pedido['data_entrada_sistema'], 0, 4) . " - " . DataMysql::dataVisual($pedido['data_entrada_sistema']) . "</a>
                                </span>
                                <small class=\"label label-danger\"><i class=\"fa fa-clock-o\"></i> - Criado há " . $dif->days . "  dia(s)</small>
                            </li>
                          </ul>";
                }
                /* STATUS PROVADO */
//                elseif ($secao != "CHEFIA" && $pedido['status'] == 3) {
//                    $count ++;
//                    print "<ul class=\"todo-lis\">
//                            <li>
//                                <span class=\"handle\">" . ($count) . ") - <i class=\"fa fa-ellipsis-v\"></i>
//                                <i class=\"fa fa-ellipsis-v\"></i>
//                                </span>
//                                <span class=\"text\">
//                                    <a style=\"text-decoration:none;\" href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'view', array('id' => $pedido['id'], 'voltar' => 'idx_recente')) . "\" title='Visualizar Pedido'>
//                                    &nbsp;&nbsp;<img style=\"vertical-align:middle\" width='15px;' src=\"/core/imagem/pedido_cesta.png\">
//                                    &nbsp;&nbsp;<span style='font-size:12px;'>
//                                    <span style='font-weight:bold;font-style: italic;'>". Municipio::PegaNomeMunicipio($pedido['id_municipio'])."</span>
//                                    Pedido AH Nº: " . $pedido['numero'] . "/" . substr($pedido['data_entrada_sistema'], 0, 4) . " - " . DataMysql::dataVisual($pedido['data_entrada_sistema']) . "</a>
//                                </span>
//                                <small class=\"label label-danger\"><i class=\"fa fa-clock-o\"></i> - Criado há " . $dif->days . "  dia(s)</small>
//                            </li>
//                          </ul>";
//                }
               elseif ($secao == "REDEC" && $pedido['status'] == 1) {
                   $count ++;
                    print "<ul class=\"todo-lis\">
                            <li>
                                <span class=\"handle\">" . ($count) . ") - <i class=\"fa fa-ellipsis-v\"></i>
                                <i class=\"fa fa-ellipsis-v\"></i>
                                </span>
                                <span class=\"text\">
                                    <a style=\"text-decoration:none;\" href=\"" . FuncaoBase::geraLink('ajuda', 'h_pedido_pedid', 'view', array('id' => $pedido['id'], 'voltar' => 'idx_recente')) . "\" title='Visualizar Pedido'>
                                    &nbsp;&nbsp;<img style=\"vertical-align:middle\" width='15px;' src=\"/core/imagem/pedido_cesta.png\">
                                    &nbsp;&nbsp;<span style='font-size:12px;'>
                                    <span style='font-weight:bold;font-style: italic;'>". Municipio::PegaNomeMunicipio($pedido['id_municipio'])."</span>
                                    Pedido AH Nº: " . $pedido['numero'] . "/" . substr($pedido['data_entrada_sistema'], 0, 4) . " - " . DataMysql::dataVisual($pedido['data_entrada_sistema']) . "</a>
                                </span>
                                <small class=\"label label-danger\"><i class=\"fa fa-clock-o\"></i> - Criado há " . $dif->days . "  dia(s)</small>
                            </li>
                          </ul>";
                    
                }
            
        
            }
        }
        ?>
    </div>
    <div class="col-md-4">
        <legend>Últimas Liberações MAH</legend>
<?php
$login = new Login();
$login->acessoLembrete($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito']);
$login->acessoLembreteTransito($_COOKIE['seguranca']['login'], $_COOKIE['seguranca']['id_deposito']);
$dash = new Dashboard();

/* periodo Chuvoso 2021 */
$dados_mah_chuva_2021 = Ajuda::liberacoesPeriodoChuva("2021");
$dados_mah_chuva_2021_qtd = Ajuda::QuantidadeMatePeriodoChuva("2021");

$total_chuva_mat = 0;
$quantidade_cesta_chuva = 0;
foreach ($dados_mah_chuva_2021_qtd as $key => $value) {
    $total_chuva_mat += $value['qtd'];
    if ($value['singular'] == 'CESTA') {
        $quantidade_cesta_chuva += $value['qtd'];
    }
}


/* periodo Estiagem 2021 */
$dados_mah_estiagem_2021 = Ajuda::liberacoesPeriodoEstiagem("2021");
$dados_mah_estiagem_2021_qtd = Ajuda::QuantidadeMatePeriodoEstiagem("2021");

$total_estiagem_mat = 0;
$quantidade_cesta_estiagem = 0;
foreach ($dados_mah_estiagem_2021_qtd as $key => $value) {
    $total_estiagem_mat += $value['qtd'];
    if ($value['singular'] == 'CESTA') {
        $quantidade_cesta_estiagem += $value['qtd'];
    }
}
?>
    </div>
    <!--
    <div class="col-md-4"></div>
    <!-- aJUDA HUMANITÁRIA -->
<!--    <div class="col-md-12">
        <br>
        <div class="alert alert-info" role="alert">nota: Os números abaixo relacionados a Ajuda Humanitária, são baseados nos atendimentos sobre o período de 01/10/2021 a 31/03/2022, para as liberações baseadas em decretos intempestivos, consulte o relatorio "Resumo de liberações" marque a opção "Resumo Distribuição de Materiais".</div>
        <p style="text-align:center">
        <legend>AJUDA HUMANITÁRIA</legend>
        </p>
        <div class='col-md-6'>

            <table class="table table-bordered">
                <tr>
                    <th colspan="2" class='text-center'>PERÍODO DE CHUVA 2021</th>
                </tr>
                <tr>
                    <td>MUNICÍPIOS ATENDIDOS</td>
                    <td><?= count($dados_mah_chuva_2021) ?></td>
                </tr>
                <tr>
                    <td>MATERIAIS DISTRIBUIDOS</td>
                    <td><?= $total_chuva_mat; ?></td>
                </tr>
                <tr>
                    <td>CESTA BÁSICAS</td>
                    <td><?= $quantidade_cesta_chuva; ?></td>
                </tr>
            </table>
        </div>
        <div class='col-md-6'>

            <table class="table table-bordered">
                <tr>
                    <th colspan="2" class='text-center'>PERÍODO DE ESTIAGEM 2021</th>
                </tr>
                <tr>
                    <td><a href='#' title='Clique aqui e veja quais municipios foram atenditos'>MUNICÍPIOS ATENDIDOS</a></td>
                    <td><?= count($dados_mah_estiagem_2021) ?></td>
                </tr>
                <tr>
                    <td>MATERIAIS DISTRIBUIDOS</td>
                    <td><?= $total_estiagem_mat; ?></td>
                </tr>
                <tr>
                    <td>CESTA BÁSICAS</td>
                    <td><?= $quantidade_cesta_estiagem; ?></td>
                </tr>
            </table>
        </div>
    </div>
     pmda 
    <div class="col-md-6">
        <p style="text-align:center">
        <legend>RESUMO PROCESSOS PMDA</legend>
        </p>
         quantidade por mes ano atual 
        <div class='col-md-6'>
            <legend>PMDA <?= date('Y') ?></legend>-->
<?php
$totalPmdaPorMes = dashboardModel::qtdPmdaMes(date('Y'));

/*print "<table class='table table-bordered'>";
print "<tr><th colspan='2' style='text-align:center'>PMDA ATENDIDO</th></tr>";
print "<tr><td style='text-align:center'>Mês</td><td>QTD</td></tr>";*/
foreach ($totalPmdaPorMes as $key => $value) {
    //print "<tr>";
    //print "<td>" . $value['mes'] . "</td>";
    //print "<td>" . $value['qtd'] . "</td>";
    //print "</tr>";
}
//print "</table>";
?>

        <!--</div>

         grafico por mes ano atual 
        <div class='col-md-6'>
            <legend>PMDA <?= date('Y') ?> Mês</legend>-->
<?php
//$dash->qtdPmdaPorMes("2021");
?>
        <!--</div>
    </div>
    <br>
    <div class='col-md-6'>
         linha 2 quantidade pmda todos anos 
        <div class='col-md-6'>
            <legend>PMDA ANOS ANTERIORES</legend>-->
<?php
//$totalPmda = dashboardModel::QtdPmdaAno();
/*print "<table class='table table-bordered'>";
print "<tr><th colspan='2' style='text-align:center'>PMDA ATENDIDO</th></tr>";
print "<tr><td style='text-align:center'>ANO</td><td>QTD</td></tr>";*/
//foreach ($totalPmda as $key => $value) {
//    print "<tr>";
//    print "<td>" . $value['ano'] . "</td>";
//    print "<td>" . $value['qtd'] . "</td>";
//    print "</tr>";
//}
//print "</table>";
?>
        <!--</div>

         grafico pmDA
        <div class='col-md-6'>
            <legend>PMDA Últimos Anos</legend>-->
<?php
//$dash->qtdPmda();
?>
       <!-- </div>
    </div>

    <div class="col-md-12 text-center">-->
<?php
//$dash->pmdaAno(date("Y"));
//$dash->atualizado();
//$dash->ajudaHumanitaria();
//$dash->pmdaAnoMes("2017");
//$dash->decreto();
?>
    <!--</div>

</div>-->
<div></div>
<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>
    $(document).ready(function () {

        if (checkmobile()) {
            $("#continuar_sistema").removeClass('text-left');
            $("#info_rapido").removeClass('text-right');

            $("#continuar_sistema").addClass('text-center');
            $("#info_rapido").addClass('text-center');
        }
        var email = '<?= $_COOKIE['seguranca']['email_rec'] ?>';
        if ((email.length > 0) && (email.match(/.com/))) {
            Swal.fire({
                icon: 'error',
                title: 'Atualização de E-mail necessária...!',
                width: 500,
                height: 400,
                text: 'Favor atualizar seu email, para um domínio institucional @mg.gov.br ou similar.',
                footer: '<a href=\'<?= FuncaoBase::geraLink("admin", "adm", "caduser", array("id" => $_COOKIE['seguranca']['idUser'])) ?>\'>Clique aqui acessar os dados cadatrais</a>'
            });
        }
    });


    var lineChartData = {
        labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Agos", "Set", "Out", "Nov", "Dez"],
        datasets: [{
                label: "Cesta",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [1,
                    5,
                    7,
                    10,
                    0,
                    15,
                    7
                ]
            },
            {
                label: "Kit Higiene",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [1, 10, 7, 40, 25, 17, 2]
            },
        ]

    }
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NF7X33LQ9N"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-NF7X33LQ9N');
</script>