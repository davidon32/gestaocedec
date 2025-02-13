<?php include_once PATH . '/core/include.php'; ?>
<?php include_once "core/Model/indexModel.php"; ?>
<?php include_once "mod_ajuda/Model/indexModel.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPageSimples.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";
?>
<!-- =================== CORPO  ============================ -->
<?php include_once "template/page/corpoHeader.php"; ?>
<style>
    @media print {

        * {
            background-color: #836FFF;
        }

        #cabecalho {
            display: none;
        }


        .rodape {
            background-color: #C0C0C0;
        }

        hr.linha {
            border: 1px solid blue;
        }

        #div-icon {
            display: none;
        }

    }
</style>

<!-- Resumo de liberacoes -->
<div class="row">
    <div class="col-md-12 text-center">
        <a class='btn btn-info' href='index.php?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=ajuda&controller=relatorio&action=busca_resumog'>Voltar</a><br><br>
        <br>
        <p style="text-align:text-center">
        <h3> Resumo Liberações</h3>
        </p>
    </div>

    <?php
    $todos_liberados = isset($_POST['todos_liberados']) ? $_POST['todos_liberados'] : "";

    if ($todos_liberados == 1) {
        print "<div class='row'>";
        print "<div class='col-md-12'>";
        print "<h3><p class=\"text-danger font-weight-bold text-center\">";
        print "Obs: Este relatório está contabilizando os Materiais que por ventura estão Liberados, porém não foram retirados no Depósito.";
        print "</p></h3></div></div>";
    }

    ?>

    <div class="col-md-12">
        <canvas id="mat_liberado" height="100px"></canvas>
    </div>
    <br>
    <div class="col-md-12">

        <!-- Liberações Realizadas -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Liberações Realizadas/ Materiais Pagos (Entregues)</h3>
            </div>
            <div class="panel-body">
                <img src="/imageimage.jpg" alt="Image" class="img-responsive">
                <p><?= Ajuda::getMateriaisLiberadosEpagos($_POST); ?> / <?= Ajuda::getMateriaisPagos($_POST); ?></p>
            </div>
        </div>

        <!-- Materiais Pagos (Entregues) -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Materiais Pagos (Entregues)</h3>
            </div>
            <div class="panel-body">
                <img src="image.jpg" alt="Image" class="img-responsive">
                <p><?= Ajuda::getMateriaisPagos($_POST); ?></p>
            </div>
        </div>

        <!-- Liberações em Aberto (aguardando Retirada) -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Liberações em Aberto (aguardando Retirada)</h3>
            </div>
            <div class="panel-body">
                <img src="image.jpg" alt="Image" class="img-responsive">
                <p><?= Ajuda::getLiberacao($_POST); ?></p>
            </div>
        </div>

        <!-- Materiais Esperando Pagamento -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Materiais Esperando Pagamento</h3>
            </div>
            <div class="panel-body">
                <img src="image.jpg" alt="Image" class="img-responsive">
                <p><?= Ajuda::getMaterialEsperaPagto($_POST, 0); ?></p>
            </div>
        </div>

        <?php if (strlen($_POST['sel_evento']) == 0) { ?>
            <!-- Materiais Esperando Pagamento -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Materiais em Transito (Transferencia entre Depositos)</h3>
                </div>
                <div class="panel-body">
                    <img src="image.jpg" alt="Image" class="img-responsive">
                    <p><?= Ajuda::getMaterialTransito($_POST, 1); ?></p>
                </div>
            </div>
        <?php } ?>
    </div>

    <br>

</div>
<div class="col-md-12">
    <hr class="linha">
</div>



<!-- Total de Liberações Geral -->
<div class="row">
    <div class="col-md-3">

        <?php

        $dataInicial = isset($_POST['txtDtInicial']) ? $_POST['txtDtInicial'] : "";
        $dataFinal = isset($_POST['txtDtFinal']) ? $_POST['txtDtFinal'] : "";
        $id_municipio = isset($_POST['id_municipio']) ? (($_POST['id_municipio'] == 0) ? NULL : $_POST['id_municipio']) : NULL;

        $material = Unidade::getIdNome();

        /** total de liberacoes por material */
        print "<div class='col-md-12 text-center' style='background-color:#C0C0C0'><h4>Total de Liberações (Geral)</h4> Período : " . $dataInicial . " a " . $dataFinal . "</div>";

        print "<table class='table table-bordered table-condensed table-striped dataTable'>";
        $total_liberacao = 0;
        foreach ($material as $key => $value) {
            $total = Liberacao::totMaterialLiberado($value['id_unidade'], $_POST);
            if (!empty($total)) {
                print "<tr><td>". $value['id_unidade'] . "-"  . $value['nome'] . "</td><td class='text-center'>" . $total . "</td></tr>";
                $total_liberacao += $total;
            }
        }

        print "<tr><td class='rodape'>Total Itens</td><td class='text-center rodape'><b>" . $total_liberacao . "</b></td></tr>";

        print "</table>";
        ?>

    </div>

    <!-- Total liberações Chuva-->
    <?php
    /* lista os eventos que tenham liberacoes */
    $chuva = Material::materiaisLiberadosEvento('CHUVA');

    print "<div class='col-md-3'>";

    foreach ($chuva as $key1 => $value1) {
        $total_itens = 0;

        print "<div class='col text-center' style='background-color:#C0C0C0'><h4>Total Materiais Liberados Evento : " . 'CHUVA' . "</h4> - Período : " . $dataInicial . " a " . $dataFinal . "</div>";

        print "<table class='table table-bordered table-condensed table-striped'>";
        foreach ($material as $key => $value) {

            $tot = Liberacao::totMaterialLiberadoPorEvento($value['id_unidade'], $_POST, 'CHUVA');
            if ($tot > 0) {
                //var_dump(Produto::getProdutos($value['id_unidade'])['origem']);
                $total_itens += $tot;
                print "<tr><td>" . $value['id_unidade'] . "-" . $value['nome'] . "</td><td class='text-center'>" . $tot . "</td></tr>";
            }
        }
        print "<tr><td class='rodape'>Total Itens</td><td class='text-center rodape'><b>" . $total_itens . "</b></td></tr>";
        print "</table>";

    }
    print "</div>";
    ?>

    <!-- Total liberações SECA-->
    <?php
    /* lista os eventos que tenham liberacoes */
    $seca = Material::materiaisLiberadosEvento('SECA');

    print "<div class='col-md-3'>";

    foreach ($seca as $key1 => $value1) {
        $total_itens = 0;

        print "<div class='col text-center' style='background-color:#C0C0C0'><h4>Total Materiais Liberados Evento : " . 'SECA' . "</h4> - Período : " . $dataInicial . " a " . $dataFinal . "</div>";

        print "<table class='table table-bordered table-condensed table-striped'>";
        foreach ($material as $key => $value) {

            $tot = Liberacao::totMaterialLiberadoPorEvento($value['id_unidade'], $_POST, 'SECA');
            if ($tot > 0) {
                //var_dump(Produto::getProdutos($value['id_unidade'])['origem']);
                $total_itens += $tot;
                print "<tr><td>" . $value['id_unidade'] . "-" . $value['nome'] . "</td><td class='text-center'>" . $tot . "</td></tr>";
            }
        }
        print "<tr><td class='rodape'>Total Itens</td><td class='text-center rodape'><b>" . $total_itens . "</b></td></tr>";
        print "</table>";
    }
    print "</div>";
    ?>


    <!-- Total liberações COVID-->
    <?php
    /* lista os eventos que tenham liberacoes */
    $covid = Material::materiaisLiberadosEvento('COVID-19');

    print "<div class='col-md-3'>";

    foreach ($covid as $key1 => $value1) {
        $total_itens = 0;

        print "<div class='col text-center' style='background-color:#C0C0C0'><h4>Total Materiais Liberados Evento : " . 'COVID' . "</h4> - Período : " . $dataInicial . " a " . $dataFinal . "</div>";

        print "<table class='table table-bordered table-condensed table-striped'>";
        foreach ($material as $key => $value) {

            $tot = Liberacao::totMaterialLiberadoPorEvento($value['id_unidade'], $_POST, 'COVID-19');
            if ($tot > 0) {
                //var_dump(Produto::getProdutos($value['id_unidade'])['origem']);
                $total_itens += $tot;
                print "<tr><td>" . $value['id_unidade'] . "-" . $value['nome'] . "</td><td class='text-center'>" . $tot . "</td></tr>";
            }
        }
        print "<tr><td class='rodape'>Total Itens</td><td class='text-center rodape'><b>" . $total_itens . "</b></td></tr>";
        print "</table>";
    }
    print "</div>";
    ?>




</div>
<div class="col-md-12">
    <hr class="linha">
</div>

<!-- Liberações por municipio e por Evento-->
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">

        <?php


        ?>

        Expandir lista Municípios: <input type="checkbox" name="ck_expandir" id="ck_expandir">
        <!-- <div class='col-md-12'>
            <table class="table table-bordered">

                <tr><th class="col-md-8 text-center" colspan="2" style='background-color:#C0C0C0'>Liberações por Municípios e Evento :  <br>Período : <?= $_POST['txtDtInicial']; ?> a <?= $_POST['txtDtFinal']; ?></th></tr>
                <tr><th class="col-md-8 text-center" style='background-color:#C0C0C0'>Município</th><th class="col-md-4 text-center" style='background-color:#C0C0C0'>Qtd de Liberações</th></tr>
                <?php

                /* lista os eventos que tenham liberacoes */
                $evento = Material::materiaisLiberadosEvento(['CHUVA', 'SECA', 'COVID-19']);

                foreach ($evento as $key1 => $value1) {

                    $total_lib_por_mun_evento = 0;
                    # param nome do evento
                    $liberacoesPorEvento = Liberacao::liberacaoPorMunicipioPorEvento($value1, $_POST);

                    print "<div class='col-md-12 text-center' style='background-color:#C0C0C0'><h4>Total Materiais Liberados Evento : " . $value1['evento'] . "</h4> - Período : " . $dataInicial . " a " . $dataFinal . "</div>";

                    print "<table class='table table-bordered table-condensed table-striped'>";

                    foreach ($liberacoesPorEvento as $key => $value) {
                        print "<tr><td class='col-md-8'>" . Municipio::PegaNomeMunicipio($value['id_municipio']) . "</td><td class='col-md-4 text-center'>" . $value['qtd'] . "</td></tr>";
                        $total_lib_por_mun_evento += $value['qtd'];
                    }
                    print "<tr><td class='rodape'>Total Itens</td><td class='text-center rodape'><b>" . $total_lib_por_mun_evento . "</b></td></tr>";
                    print "</table>";
                }
                ?>
            </table> -->
        <hr class="linha">
    </div>
</div>
<div class="col-md-3">
</div>


<!-- Liberações por Municipio -->
<div class="row">
    <div class="col-md-12">
        <div class='col-md-12'>
            <table class="table table-bordered">
                <tr>
                    <th class="col-md-8 text-center" colspan="3" style='background-color:#C0C0C0'>Liberações por Municípios <br>Período : <?= $_POST['txtDtInicial']; ?> a <?= $_POST['txtDtFinal']; ?></th>
                </tr>
                <tr>
                    <th>#</th>
                    <th class="col-md-8 text-center" style='background-color:#C0C0C0'>Município</th>
                    <th class="col-md-4 text-center" style='background-color:#C0C0C0'>Qtd de Liberações</th>
                </tr>
                <?php

                $liberacoes = Liberacao::liberacaoPorMunicipio($_POST);

                $total_lib_por_mun = 0;

                foreach ($liberacoes as $key => $value) {
                    print "<tr>";
                    print "<td>" . ($key + 1) . "</td>";
                    print "<td class='col-md-8' style='background-color:#E6E6E6'>";
                    print "<a class='mostra' id='" . $value['id_municipio'] . "' title='Clique para ver os materiais'>" . Municipio::PegaNomeMunicipio($value['id_municipio']) . "</a>";
                    
                    print "<table class='table material' id='material" . $value['id_municipio'] . "' >";
                    print "<tr>";
                        print "<td colspan='3'>Materiais Liberados</td>";
                    print "</tr>";
                    print "<tr>";
                        print "<td>Nome</td>";
                        print "<td>Evento</td>";
                        print "<td>Qtd</td>";
                    print "</tr>";
                    
                    
                    $mat = Liberacao::totMaterialLiberadoMapa($value['id_municipio'], $_POST);
                    foreach ($mat as $key => $value1) {
                        
                        print "<tr>";
                            print "<td>" . $value1['nome'] . "</td>";
                            print "<td>" . $value1['evento'] . "</td>";
                            print "<td>" . $value1['qtd'] . "</td>";
                        print "</tr>";

                    }

                    print "</table>";
                    print "</td><td class='col-md-4 text-center' style='background-color:#E6E6E6'>" . $value['qtd'] . "</td></tr>";
                    $total_lib_por_mun += $value['qtd'];
                }

                ?>
                <tr>
                    <td colspan="2" style='background-color:#C0C0C0'>Total de Liberações</td>
                    <td class='text-center' style='background-color:#C0C0C0'><?= $total_lib_por_mun; ?></td>
                </tr>
            </table>
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

<script type="text/javascript">
    $(document).ready(function() {

        $(".material").hide();

        $("#ck_expandir").click(function(){

            
                $(".material").toggle();
            
        });

        $(".mostra").click(function() {

            var id = 'material' + $(this).attr('id');

            if ($("#" + id + "").is(":visible")) {
                $("#" + id + "").hide();
            } else {
                $("#" + id + "").show();
            }
        });



        new Chart(document.getElementById("mat_liberado"), {
            type: 'doughnut',
            data: {
                labels: ["Material Liberado", "Material Pago", "Liberações (Aguardando Retirada"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                    data: [<?= Ajuda::getMateriaisLiberadosEpagos($_POST) ?>, <?= Ajuda::getMateriaisPagos($_POST); ?>, <?= Ajuda::getLiberacao($_POST); ?>]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Liberações',
                    responsive: true,
                }
            }
        });

    });
</script>