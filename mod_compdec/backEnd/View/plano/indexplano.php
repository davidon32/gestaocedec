<?php include_once 'core/include.php'; ?>
<?php include_once 'core/Model/indexModel.php'; ?>
<?php include_once 'mod_compdec/Model/Model.php'; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/headerPage.php"; ?>
<!-- =================== HEADER ============================ -->
<?php include_once "template/page/header.php"; ?>
<!-- =================== MENU  ============================ -->
<?php //include_once "template/page/menu.php";?>
<!-- =================== CORPO  ============================ -->
<?php
include_once "template/page/corpoHeader.php";

$_relatorioCompdec = new RelatorioComdec();

$id_municipio = isset($_COOKIE['seguranca']['id_municipio']) ? $_COOKIE['seguranca']['id_municipio'] : "";


//Municipio com plano e com arquivo hospedado no SDc
$planos = $_relatorioCompdec->listPlano();


$comPlano = count($_relatorioCompdec->listaTodosPlanos());
$semPlano = count($_relatorioCompdec->relSemPlano());


$arrayComArquivoPlano = [];

foreach ($planos as $key => $plano) {
    if (file_exists("anexo/planoCont/" . $plano['file_plano'])) {
        $arrayComArquivoPlano[] = $plano['id_municipio'];
    }
}



$comArquivoPlano = array_unique($arrayComArquivoPlano, SORT_NUMERIC);
$semArquivoPlano = $comPlano - count($comArquivoPlano);


?>

<style>

    a span {
        color: orange;
        font-weight: bold;
    }

</style>
<div class='container'>

    <div class='col-md-12 text-center'>
        <a class="btn btn-success" href="?token=<?= hash('sha256', md5(VERSAO) . date('dmY')); ?>&ac=itn&modulo=index&controller=index&action=menu">Voltar</a><br>
        <br>
    </div>

    <!--Busca plano-->
<!--    <div class='col-md-6 p-3'>
        <label>Busca Plano</label>
        <input class="form form-control" type="text" name="SearchPlano" id="SearchPlano">
        <br>
        <button class="btn btn-primary">Pesquisar</button>
        <br>
        <br>
    </div>
<div class='col-md-6 p-3'></div>-->
    <div class='col-md-2 text-center'></div>
    <div class='col-md-4'>
<!--        <a href="#" class='' onClick="uploadModal()" title="Envio de Plano de Contingência"><img src="core/imagem/upload1.png" width="35px;" alt="Upload de Plano de Contingência"> Upload de Plano de Contigencia</a>-->
        <br>
        <br>
        <!--<a class="btn btn-primary" title="Busca Plano dce Contigencia" >Busca PC</a><br><br>-->
        <a class="" title="Relatorios" href="<?= FuncaoBase::geraLink("compdec", "plano", "listacomplano") ?>"><img width="40" src='core/imagem/relatorio.png'> Lista de Municípios <span>com</span> Plano de Contingencia</a><br><br>
        <a class="" title="Relatorios" href="<?= FuncaoBase::geraLink("compdec", "plano", "listasemplano") ?>"><img width="40" src='core/imagem/relatorio.png'> Lista de Municípios <span>sem</span> Plano de Contingencia</a><br><br>    
        <!--<a class="btn btn-primary" title="Relatorios" href="<?= FuncaoBase::geraLink("compdec", "plano", "listageral") ?>">Lista de <span>Todos</span> Municípios com Plano de Contingencia</a><br>-->

    </div>


    <div class="row">
        <!-- GRAFICO -->
        <div class='col-md-6 text-center'>
            <div id="piechart"></div>
        </div>

        <!-- GRAFICO2 -->
        <div class='col-md-6 text-center'>
            <div id="piechart2"></div>
        </div>
    </div>




    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Upload de Plano de Contingencia</h4>
                </div>
                <div class="modal-body">
                    <input type="file" name="filePlano" id="filePlano" class="form-control">
                    <br>
                    <span>Versão do Documento em caso de Alteração</span>
                    <select name="selVersao" id="selVersao" class="form-control">
                        <option value="0">Versão</option>
                        <?php
                        for ($index = 1; $index < 20; $index++) {
                            print "<option value='" . $index . "'>" . $index . "</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <div class="alert alert-danger">
                        OBS:
                        <li>
                            Os planos deverão estar no formato, Arquivos com Extensão PDF e DOC, DOCX até 2MB
                        </li>
                    </div>
                    <div class="alert alert-warning">
                        DICAS
                        <li>
                            <a href="https://smallpdf.com/pt/compressor-de-pdf">Comprimir arquivos PDF</a><br>
                        </li>
                        <li>
                            <a href="http://ptcomputador.com/Software/data-compression/112119.html">Comprimir Imagem em
                                Documento Word</a><br>
                        </li>

                    </div>

                    <input type="hidden" name="txtData" id="txtData" value="<?= date('Y-m-d h:i:s'); ?>">
                    <input type="hidden" name="txtIdMunicipio" id="txtIdMunicipio" value="<?= $id_municipio; ?>">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" name="btnUpload" id="btnUpload">Upload</button>
                </div>
            </div>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>

            $(document).ready(function () {

                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    
                    /* Chart 1*/
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Municipíos com plano', <?= $comPlano ?>],
                        ['Municipíos Sem Plano', <?= $semPlano ?>]
                    ]);

                    var options = {
                        title: 'Plano de Contingência Municípios Mineiros'
                    };

                    /* Chart 2 */
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);


                    var data1 = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Planos em Situação Regular', <?= count($comArquivoPlano) ?>],
                        ['Planos em Situação Irregular', <?= $semArquivoPlano ?>]
                    ]);

                    var options1 = {
                        title: 'Situação dos Planos Inseridos no Sistema'
                    };
                    var chart1 = new google.visualization.PieChart(document.getElementById('piechart2'));
                    chart1.draw(data1, options1);
                }


                /* Criar novo plano de contingencia */
                (function ($) {

                    novoPlano = function () {

                        if (confirm("Deseja Começar o preenchimento de um novo Plano de Contingência ?")) {

                            $.ajax({
                                url: 'mod_compdec/View/plano/process.php?v=<?= md5(VERSAO) ?>',
                                type: 'POST',
                                data: {
                                    identificador: "novoPlano",
                                    id_municipio: "<?= $id_municipio; ?>"
                                },

                                success: function (response) {
                                    console.log(response);
                                    if (response == "sucesso") {
                                        window.location.href =
                                                "?modulo=compdec&secao=plano&acao=planomenu&id=<?= $id_municipio; ?>";
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown, "-");
                                }


                            });
                        }

                        return false;

                    }

                })(jQuery);

                /* upload de plano de contingencia */
                (function ($) {

                    uploadModal = function () {
                        $("#myModal").modal('show');
                    }

                })(jQuery);


                /* Upload arquivo  */
                $('#btnUpload').on('click', function () {

                    var file_data = $('#filePlano').prop('files')[0];
                    var versao = $('#selVersao').val();
                    var dt = $('#txtData').val();
                    var id = $('#txtIdMunicipio').val();

                    var form_data = new FormData();

                    form_data.append('file', file_data);
                    form_data.append('identificador', 'upload')
                    form_data.append('id', id);
                    form_data.append('dt_upload', dt);
                    form_data.append('versao', versao);
                    //alert(form_data);                             
                    $.ajax({
                        url: 'mod_compdec/View/plano/process.php?v=<?= md5(VERSAO) ?>', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            alert(response);
                            $("#myModal").modal('hide');
                            window.location.reload();
                        }
                    });
                });


                (function ($) {
                    /* Remover o plano de Contingencia */
                    removerPlano = function (id_plano) {

                        if (confirm("Deseja realmente deletar este Plano de Contingencia ?\nProcesso sem volta !")) {

                            $.ajax({
                                url: 'mod_compdec/View/plano/process.php?v=<?= md5(VERSAO) ?>',
                                type: 'POST',
                                data: {
                                    identificador: "removerPlano",
                                    id_municipio: "<?= $id_municipio; ?>",
                                    id_plano: id_plano,
                                },

                                success: function (response) {
                                    console.log(response);
                                    if (response == "sucesso") {
                                        alert("Plano de Contingencia Deletado com Sucesso !");
                                        window.location.reload();

                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown, "-");
                                }


                            });
                        }

                        return false;

                    }

                })(jQuery);
            });
</script>
</body>

</html>