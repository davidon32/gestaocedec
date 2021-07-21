

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

<?php
$secao = isset($_GET['an']) ? $_GET['an'] : "";

$id_pedido = isset($_GET['id']) ? $_GET['id'] : "";

$sigla = 'DRD';
if ($secao == 'analise_drd') {
    $label_secao = 'DRD - Diretoria de Redução de Desastre';
    $sigla_despacho = "DLOG";
    $despacho = 'analise_dlog';
    $status = 3;
} else if ($secao == 'analise_dlog') {
    $label_secao = 'Diretoria de Logistica';
    $sigla_despacho = "CORRD. ADJUNTO";
    $despacho = 'analise_coord';
    $status = 4;
} else if ($secao == 'analise_coord') {
    $label_secao = 'Coordenadoria Adjunda';
    $sigla_despacho = "Aprovação";
    $despacho = 'atendido';
    $status = 5;
}
?>

<legend id="">Analise Técnica Parecer : <span style='color:red'><?= $label_secao ?></span></legend>
<div class='row'>
    <div class="col-md-12">

        <br>
        <!-- redigir parecer -->
        <div class='col-md-12'>
            <button type="button" class="btn btn-primary" name="cadastro" id="cadastro" title="Redigir Parecer Despacho">Redigir Despacho</button><br><br>
        </div>

        <!-- secao tramit -->
        <div class='col-md-2'>
            <label id='lb_tramitar'>Tramitar Pedido </label>
            <select class='form form-control' name="sel_despacho" id="sel_despacho">
                <option value="" data-status="">Escolha uma Seção</option>
                <option value="analise_drd" data-status="2">Analise DRD</option>
                <option value="analise_dlog" data-status="3">Analise DLOG</option>
<?php
    
if ($secao != 'analise_coord') {
    print "<option value=\"analise_coord\" data-status=\"4\">Coordenador Adjunto</option>";
}

if ($secao == 'analise_coord') {
    print "<option value=\"aprovacao\" data-status=\"5\">Aprovação</option>";
}
?>
            

            </select>
        </div>
        <!-- tramitar pedido-->
        <label id='lb_tramitar'>&nbsp;</label><br>
        <button type="button" class="btn btn-warning" name="despachar" id="despachar" data-secao='<?= $secao ?>' title="Enviar para <?= $sigla_despacho ?>">Enviar</button>

    </div>
</div>






<form action="<?= FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", "gravar"); ?>" method="post" accept-charset="utf-8" name="frmH_pedido_an_tec" id="frmH_pedido_an_tec">


    <div class='row'>
        <div class='col-md-2'>
            <label>Data envio</label>
            <input type="text" class='form form-control' name='data_parecer' id='data_parecer' maxlength='' required >
        </div>
    </div>
    <div class='row'>
        <div class='col-md-12'>
            <label>Parecer Técnico</label> <span style="color: silver" id='caracteres'></span>
            <textarea class='form form-control' name='parecer' id='parecer' maxlength='65534' required rows="8"></textarea>
        </div>
    </div>

    <!-- seção -->
    <input type="hidden" class='form form-control' name='tramit_parecer' id='tramit_parecer' maxlength='14' required value='<?= $secao ?>' >

    <!-- id_pedido -->
    <input type="hidden" class='form form-control' name='id_pedido' id='id_pedido' maxlength='14' required value='<?= $id_pedido ?>' >


    <div class="col-md-6 text-left">
        <br>
<?php #<!-- despacho parecer --> ?>
        <input type="submit" class="btn btn-info" name="btnGravar" id="btnGravar" value="Gravar"><br><br>

    </div>
</form>
<div class="col-md-6 text-right">
    <br>
    <a class="btn btn-success" href="<?= FuncaoBase::geraLink("ajuda", "h_pedido_index", "index") ?>">Voltar</a>
</div>   


<br>
<br>
<div class="row">
    <div class="col-md-12">

<?php
$analises_tecnica = H_pedido_an_tecajuda_hModel::listAnalise($id_pedido);
$aprovacao = 'nao';
?>

        <br><legend> Parecer técnico <span style="font-style: italic"><?= $label_secao ?></span></legend>
        <table class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Analista</th>
                    <th>Parecer</th>
                    <th>Opções</th>
                </tr>
            </thead>
<?php
foreach ($analises_tecnica as $key => $an_drd) {

    if ($an_drd['tramit_parecer'] == $secao) {
        $aprovacao = (count($an_drd['tramit_parecer'])) > 0 ? 'sim' : 'nao';

        print "<tr>";
        print "<td>" . DataMysql::dataVisual($an_drd['data_parecer']) . "</td>";
        print "<td>" . Usuario::getNomeId($an_drd['id_usuario']) . "</td>";
        print "<td style='text-align: justify'>" . $an_drd['parecer'] . "</td>";
        print "<td>";
        if ($an_drd['id_usuario'] == $_COOKIE['seguranca']['idUser']) {
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", 'edit', array('id' => $an_drd['id_analise'], 'id_pedido' => $id_pedido, 'an' => $_GET['an'])) . "'><img src='/core/imagem/editar.png' title='Editar Perecer'></a>";
            print "<a href='" . FuncaoBase::geraLink("ajuda", "h_pedido_an_tec", 'delete', array('id' => $an_drd['id_analise'], 'id_pedido' => $id_pedido, 'an' => $_GET['an'])) . "'><img src='/core/imagem/delete.png' title='Deletar Parecer'></a>";
        } else {
            print "<img src='/core/imagem/status.png' title='Somente o usuario que Criou o parecer pode editá-lo !'>";
            //print "<a href='#'><img src='/core/imagem/revisao.png'title='Solicitar alteração'></a>";
        }
        print "</td>";
        print "</tr>";
    }
}
?>
        </table>

    </div>
</div>


<!-- =================== RODAPE CORPO ==================== -->
<?php include_once "template/page/corpoRodape.php"; ?>
<!-- =================== RODAPE  ======================== -->
<?php include_once "template/page/rodape.php" ?>
<?php include_once "template/page/barra_config_template.php"; ?>
<!-- =============== HEADER HTML PAGE ================= -->
<?php include_once "template/page/rodapePage.php"; ?>
<script>

    $(document).ready(function () {

        $("#frmH_pedido_an_tec").trigger("reset");
        $("#frmH_pedido_an_tec").hide();
        $("#lg_parecer").hide();


        $("#cadastro").click(function () {
            $("#frmH_pedido_an_tec").show();
            $("#lg_parecer").show();
            $("#lb_tramitar").hide();
            $("#sel_despacho").hide();
            $("#despachar").hide();
        });



        /* conta os caracteres */
        $("#caracteres").text($("#parecer").val().length + " / 65534 ( Caracteres restantes )");
        $("#parecer").keyup(function () {
            $("#caracteres").text($("#parecer").val().length + " / 65534 ( Caracteres restantes )");
        });


        /* tramitar / despachar */
        $("#despachar").click(function () {

            if($("#sel_despacho").val() != ""){

                var result = confirm('Deseja enviar para o despachante da '+$("#sel_despacho").val()+' ? ');
                
                var data_aprovacao = $("#sel_despacho").val() == 'aprovacao' ? '<?=date('Y-m-d')?>' : ""

                if (result) {

                    var formData = new FormData();
                    formData.append('id_pedido', '<?= $id_pedido ?>');
                    formData.append('tramit', $("#sel_despacho").val()); // destino
                    formData.append('origem', '<?=$secao;?>'); // origem
                    
                    formData.append('status', $("#sel_despacho").find(':selected').data('status'));
                    formData.append('data_aprovacao', data_aprovacao);
                    $.ajax({
                        url: '<?= FuncaoBase::geralink("ajuda", "h_pedido_an_tec", "tramitarParecer"); ?>',
                        type: 'POST',
                        data: formData,
                        processData: false, // tell jQuery not to process the data
                        contentType: false, // tell jQuery not to set contentType
                        success: function (response) {
                            //console.log(response);
                            Swal.fire('Documento Transmitido para <?= $sigla_despacho ?>  !').then(function () {
                                window.location.href = '<?= FuncaoBase::geralink("ajuda", "h_pedido_index", "index"); ?>';
                            });
                        },
                        error: function (e) {
                            //console.log(JSON.stringify(e));
                        }
                    });

                }
            }else {
                Swal.fire('Favor escolher uma Seção para Tramitar este Pedido !')
            }

        });




    });
</script>
